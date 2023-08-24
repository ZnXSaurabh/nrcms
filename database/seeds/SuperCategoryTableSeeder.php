<?php
use App\Models\SuperCategory;
use Illuminate\Database\Seeder;

class SuperCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superCategory = [
            [
                'division_id'   =>  json_encode(['1','2']),
                'name'          =>  'Civil',
                'icons'         =>  'icon_1.png',
                'description'   =>  'Civil category',
                'created_at'    =>  '2020-01-04 10:41:19',
                'updated_at'    =>  '2020-01-04 10:41:19'
            ],
            [
                'division_id'   =>  json_encode(['1','2']),
                'name'          =>  'Electrical',
                'icons'         =>  'icon_2.png',
                'description'   =>  'Electrical category',
                'created_at'    =>  '2020-01-04 10:41:51',
                'updated_at'    =>  '2020-01-04 10:41:51'
            ],
            [
                'division_id'   =>  json_encode(['1','2']),
                'name'          =>  'S&T',
                'icons'         =>  'icon_3.png',
                'description'   =>  'S&T category',
                'created_at'    =>  '2020-01-04 10:42:26',
                'updated_at'    =>  '2020-01-04 10:42:26'
            ]
        ];
        SuperCategory::insert($superCategory);
    }
}