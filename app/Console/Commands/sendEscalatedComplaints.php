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

class sendEscalatedComplaints extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-escalated-complaints';

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
        
        $config = [];
    
        foreach ($roles as $role) {
            for ($level = 1; $level <= 3; $level++) {
                $obj = new \stdClass();
                $obj->department_id = $role->department_id;
                $obj->complaint_status = $role->complaint_status;
                $obj->escalated_days = $role->{"l{$level}_escalation_days"};
                $obj->role = $role->{"l{$level}_escalation_role"};
                $obj->role_id = Role::where('name', $role->{"l{$level}_escalation_role"})->value('id');
                $obj->contacts = $this->getMobileNumbersByRoleId($obj->role_id, $obj->department_id);
                array_push($config, $obj);
            }
        }
    
        $ecalationArray = [];
    
        foreach ($config as $conf) {
            foreach ($conf->contacts as $cont) {
                $obj = new \stdClass();
                $obj->role = $conf->role;
                $obj->escalated_days = $conf->escalated_days;
                $obj->department_id = $conf->department_id;
                $obj->complaint_status = $conf->complaint_status;
    
                $obj->allocated_complaints = DB::table('complaints')
                    ->where('sup_cat_id', $conf->department_id)
                    ->where('status', $conf->complaint_status)
                    ->where('updated_at', '<=', Carbon::now()->subDays($conf->escalated_days)->toDateTimeString())
                    ->count();
    
                $obj->initiated_complaints = DB::table('complaints')
                    ->where('sup_cat_id', $conf->department_id)
                    ->where('status', $conf->complaint_status)
                    ->where('created_at', '<=', Carbon::now()->subDays($conf->escalated_days)->toDateTimeString())
                    ->count();
    
                $obj->contact = $cont;
                $obj->date = date('Y-m-d');
                $ecalationArray[] = $obj;
    
                $MSG91 = new MSG91();

                $MSG91->sendDltSms(
                    '6570509caf04d74712702171',
                    '91'.$cont,
                    'ESCALATION',
                    ["$conf->role", "$obj->date", "$obj->initiated_complaints", "$obj->allocated_complaints"]
                );

            }

          
        }
    
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
    
}
