<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\MSG91;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use App\Models\Profile;
use App\Models\Complaint;
use Illuminate\Support\Facades\DB;
use App\Models\Escalation;
use App\Models\SuperCategory;



class demo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:demo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $roles = Escalation::get();

        $config = array();

        foreach ($roles as $role) {
            // Level 1 escalation
            $obj = new \stdClass();
            $obj->department_id = $role->department_id;
            $obj->complaint_status = $role->complaint_status;
            $obj->escalated_days = $role->l1_escalation_days;
            $obj->role = $role->l1_escalation_role;
            $obj->role_id = Role::where('name', $role->l1_escalation_role)->value('id');
            $obj->contacts = $this->getMobileNumbersByRoleId($obj->role_id, $obj->department_id);
            array_push($config, $obj);

            // Level 2 escalation
            $obj = new \stdClass();
            $obj->department_id = $role->department_id;
            $obj->complaint_status = $role->complaint_status;
            $obj->escalated_days = $role->l2_escalation_days;
            $obj->role = $role->l2_escalation_role;
            $obj->role_id = Role::where('name', $role->l2_escalation_role)->value('id');
            $obj->contacts = $this->getMobileNumbersByRoleId($obj->role_id, $obj->department_id);
            array_push($config, $obj);

            // Level 3 escalation
            $obj = new \stdClass();
            $obj->department_id = $role->department_id;
            $obj->complaint_status = $role->complaint_status;
            $obj->escalated_days = $role->l3_escalation_days;
            $obj->role = $role->l3_escalation_role;
            $obj->role_id = Role::where('name', $role->l3_escalation_role)->value('id');
            $obj->contacts = $this->getMobileNumbersByRoleId($obj->role_id, $obj->department_id);
            array_push($config, $obj);
        }


        $ecalationArray = [];

        foreach($config as $conf){
            foreach($conf->contacts as $cont){
            $obj = new \stdClass();
            $obj->role = $conf->role;
            $obj->escalated_days = $conf->escalated_days;
            $obj->department_id = $conf->department_id;
            $obj->complaint_status = $conf->complaint_status;
            if($conf->complaint_status == 'Allocated'){
                $obj->complaints = DB::table('complaints')->where('sup_cat_id',$conf->department_id)->where('status',$conf->complaint_status)->where('updated_at', '<=', Carbon::now()->subDays($conf->escalated_days)->toDateTimeString())->count();
            }
            else{
                $obj->complaints = DB::table('complaints')->where('sup_cat_id',$conf->department_id)->where('status',$conf->complaint_status)->where('created_at', '<=', Carbon::now()->subDays($conf->escalated_days)->toDateTimeString())->count();
            }
            
                $obj->contact = $cont;
                $ecalationArray[] = $obj;

                $MSG91 = new MSG91();

                // $MSG91->sendDltSms('62385ab87f0231333a04e445', '91'.$phoneNumber, 'OTP', [123]); 
                $MSG91->sendDltSms('62385ab87f0231333a04e445', '91' . $phoneNumber, 'message', [$message]);

            }
        }

       dd($ecalationArray);

        $this->info('SMS sent successfully.');

    }

    

private function getMobileNumbersByRoleId($roleId, $departmentId)
{
    return DB::table('role_user')
        ->join('users', 'role_user.user_id', '=', 'users.id')
        ->join('profiles', 'users.id', '=', 'profiles.user_id')
        ->where('role_user.role_id', $roleId)
        ->where('profiles.department', $departmentId)
        ->pluck('users.mobileno')
        ->toArray();
}

// private function sendSMSToMobileNumbers($obj)
// {
//     $MSG91 = new MSG91();
    
//     foreach ($obj->mobile_numbers as $role => $mobileNumbers) {
//         foreach ($mobileNumbers as $phoneNumber) {
//             $message = "Sending SMS  Total Complaints: $obj->total_complaints Complaint Status: $obj->status";

            
//             // $MSG91->sendDltSms('62385ab87f0231333a04e445', '91'.$phoneNumber, 'OTP', [123]); 
//            $MSG91->sendDltSms('62385ab87f0231333a04e445', '91' . $phoneNumber, 'message', [$message]);

//             $this->info("$message to $phoneNumber");
//         }
//     }
// }
}
