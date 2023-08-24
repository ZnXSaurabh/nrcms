<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{

    /**

     * Run the database seeds.

     *

     * @return void

     */

    public function run()

    {

        // 1. Super Admin

        $role_superadmin = new Role();

        $role_superadmin->name = "Super Admin";

        $role_superadmin->slug = Str::slug($role_superadmin->name, '-');

        $role_superadmin->description = "A user with Super Admin privilege";

        $role_superadmin->permissions = json_encode([

            'create-user' => true,

            'view-user' => true,

            'edit-user' => true,

            'delete-user' => true,

            'assign-roles' => true,

            'create-location' => true,

            'edit-location' => true,

            'delete-location' => true,

            'create-area' => true,

            'edit-area' => true,

            'delete-area' => true,

            'create-housetype' => true,

            'edit-housetype' => true,

            'delete-housetype' => true,

            'create-block' => true,

            'edit-block' => true,

            'delete-block' => true,

            'create-quarter' => true,

            'view-quarter' => true,

            'edit-quarter' => true,

            'delete-quarter' => true,

            'create-service-building' => true,

            'view-service-building' => true,

            'edit-service-building' => true,

            'delete-service-building' => true,

            'create-category' => true,

            'edit-category' => true,

            'delete-category' => true,

            'create-sub-category' => true,

            'edit-sub-category' => true,

            'delete-sub-category' => true,

        ]);

        $role_superadmin->save();



        // 2. Helpdesk

        $role_helpdesk = new Role();

        $role_helpdesk->name = "Helpdesk";

        $role_helpdesk->slug = Str::slug($role_helpdesk->name, '-');

        $role_helpdesk->description = "A user with helpdesk privilege";

        $role_helpdesk->permissions = json_encode([

            'create-user' => true,

            'view-user' => true,

            'edit-user' => true,

            'delete-user' => true,

            'create-complaint' => true,

            'view-complaint' => true,

        ]);

        $role_helpdesk->save();



        // 3. SSE

        $role_sse = new Role();

        $role_sse->name = "SSE";

        $role_sse->slug = Str::slug($role_sse->name, '-');

        $role_sse->description = "A user with SSE privilege";

        $role_sse->permissions = json_encode([

            'create-user' => true,

            'view-user' => true,

            'edit-user' => true,

            'delete-user' => true,

            'verify-user' => true,

            'create-complaint' => true,

            'view-complaint' => true,

            'mark-complaint' => true,

            'allocate-job' => true,

            'print-job-card' => true,

            'create-vendor' => true,

            'view-vendor' => true,

            'edit-vendor' => true,

            'delete-vendor' => true,

            'create-resource' => true,

            'view-resource' => true,

            'edit-resource' => true,

            'delete-resource' => true,

        ]);

        $role_sse->save();



        // 4. ADEN

        $role_aden = new Role();

        $role_aden->name = "ADEN";

        $role_aden->slug = Str::slug($role_aden->name, '-');

        $role_aden->description = "A user with ADEN privilege";

        $role_aden->permissions = json_encode([

            'view-user' => true,

            'view-complaint' => true,

        ]);

        $role_aden->save();



        // 5. DEN

        $role_den = new Role();

        $role_den->name = "DEN";

        $role_den->slug = Str::slug($role_den->name, '-');

        $role_den->description = "A user with DEN privilege";

        $role_den->permissions = json_encode([

            'view-user' => true,

            'view-complaint' => true,

        ]);

        $role_den->save();



        // 6. SDEN

        $role_sden = new Role();

        $role_sden->name = "SDEN";

        $role_sden->slug = Str::slug($role_sden->name, '-');

        $role_sden->description = "A user with SDEN privilege";

        $role_sden->permissions = json_encode([

            'view-user' => true,

            'view-complaint' => true,

        ]);

        $role_sden->save();



        // 7. User

        $role_user = new Role();

        $role_user->name = "User";

        $role_user->slug = Str::slug($role_user->name, '-');

        $role_user->description = "A user with User privilege";

        $role_user->permissions = json_encode([

            'create-complaint' => true,

            'view-complaint' => true,

            'feedback-complaint' => true,

        ]);

        $role_user->save();

    }

}

