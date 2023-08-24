<?php

use App\Role;

use App\User;

use App\Models\Profile;

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder

{

    /**

     * Run the database seeds.

     *

     * @return void

     */

    public function run()

    {

        // Roles

        $role_superadmin = Role::find(1);

        $role_helpdesk = Role::find(2);

        $role_sse = Role::find(3);

        $role_aden = Role::find(4);

        $role_den = Role::find(5);

        $role_sden = Role::find(6);

        $role_user = Role::find(7);



        // Super Admin

        $superadmin = new User();

        $superadmin->name = "Super Admin";

        $superadmin->email = "info@giksindia.com";

        $superadmin->mobileno = "0000000000";

        $superadmin->password = bcrypt("Giks@123");

        $superadmin->is_account_verified = 1;

        $superadmin->is_mobile_verified = 1;

        $superadmin->save();

        $superadmin->roles()->attach($role_superadmin); 



        Profile::create([

            'user_id' => 1

        ]);



        // Helpdesk

        $helpdesk = new User();

        $helpdesk->name = "Helpdesk";

        $helpdesk->email = "help@giksindia.com";

        $helpdesk->mobileno = "9999999999";

        $helpdesk->password = bcrypt("Giks@123");

        $helpdesk->is_account_verified = 1;

        $helpdesk->is_mobile_verified = 1;

        $helpdesk->save();

        $helpdesk->roles()->attach($role_helpdesk); 



        Profile::create([

            'user_id' => 2

        ]);



        // SSE

        $sse = new User();

        $sse->name = "SSE";

        $sse->email = "sse@giksindia.com";

        $sse->mobileno = "1111111111";

        $sse->password = bcrypt("Giks@123");

        $sse->is_account_verified = 1;

        $sse->is_mobile_verified = 1;

        $sse->save();

        $sse->roles()->attach($role_sse); 



        Profile::create([

            'user_id' => 3

        ]);



        // ADEN

        $aden = new User();

        $aden->name = "ADEN";

        $aden->email = "aden@giksindia.com";

        $aden->mobileno = "2222222222";

        $aden->password = bcrypt("Giks@123");

        $aden->is_account_verified = 1;

        $aden->is_mobile_verified = 1;

        $aden->save();

        $aden->roles()->attach($role_aden); 



        Profile::create([

            'user_id' => 4

        ]);



        // DEN

        $den = new User();

        $den->name = "DEN";

        $den->email = "den@giksindia.com";

        $den->mobileno = "3333333333";

        $den->password = bcrypt("Giks@123");

        $den->is_account_verified = 1;

        $den->is_mobile_verified = 1;

        $den->save();

        $den->roles()->attach($role_den); 



        Profile::create([

            'user_id' => 5

        ]);



        // SDEN

        $sden = new User();

        $sden->name = "SDEN";

        $sden->email = "sden@giksindia.com";

        $sden->mobileno = "4444444444";

        $sden->password = bcrypt("Giks@123");

        $sden->is_account_verified = 1;

        $sden->is_mobile_verified = 1;

        $sden->save();

        $sden->roles()->attach($role_sden); 



        Profile::create([

            'user_id' => 6

        ]);



        // User

        $user = new User();

        $user->name = "User";

        $user->email = "user@giksindia.com";

        $user->mobileno = "5555555555";

        $user->password = bcrypt("Giks@123");

        $user->is_account_verified = 1;

        $user->is_mobile_verified = 1;

        $user->save();

        $user->roles()->attach($role_user); 



        Profile::create([

            'user_id' => 7

        ]);

    }

}

