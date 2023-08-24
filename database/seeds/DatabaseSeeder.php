<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(LocationTableSeeder::class);
        $this->call(AreaTableSeeder::class);
        $this->call(BlockTableSeeder::class);
        $this->call(HouseTypeTableSeeder::class);
        $this->call(QuarterTableSeeder::class);
        $this->call(SuperCategoryTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(SubCategoryTableSeeder::class);
        $this->call(VandorTableSeeder::class);
        $this->call(ResourceTableSeeder::class);
    }
}