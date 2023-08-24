<?php
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            [
                'division_id'       =>  json_encode(['1','2']),
                'sup_cat_id'        =>  1,
                'name'      =>  'PLUMBER',
                'icons'     =>  'icon_1.png',
                'description'       =>  'Plumber works related complaints',
                'created_at'        =>  '2019-07-05 06:17:45',
                'updated_at'        =>  '2020-01-04 11:27:49'
            ],
            [
                'division_id'       =>  json_encode(['1','2']),
                'sup_cat_id'        =>  1,
                'name'      =>  'CARPENTER',
                'icons'     =>  'icon_2.png',
                'description'       =>  'Carpenter works related complaints',
                'created_at'        =>  '2019-07-05 06:18:45',
                'updated_at'        =>  '2020-01-04 11:32:47'
            ],
            [
                'division_id'       =>  json_encode(['1','2']),
                'sup_cat_id'        =>  1,
                'name'      =>  'PAINTER',
                'icons'     =>  'icon_3.png',
                'description'       =>  'Painter works related complaints',
                'created_at'        =>  '2019-07-05 06:17:45',
                'updated_at'        =>  '2020-01-15 07:05:54'
            ],
            [
                'division_id'       =>  json_encode(['1','2']),
                'sup_cat_id'        =>  1,
                'name'      =>  'MASON',
                'icons'     =>  'icon_4.png',
                'description'       =>  'Mason works related complaints',
                'created_at'        =>  '2020-01-04 11:35:40',
                'updated_at'        =>  '2020-01-04 11:35:40'
            ],
            [
                'division_id'       =>  json_encode(['1','2']),
                'sup_cat_id'        =>  1,
                'name'      =>  'OTHERS',
                'icons'     =>  'icon_5.png',
                'description'       =>  'Other works related complaints',
                'created_at'        =>  '2020-01-04 11:36:08',
                'updated_at'        =>  '2020-01-08 16:38:55'
            ],
            [
                'division_id'       =>  json_encode(['1','2']),
                'sup_cat_id'        =>  2,
                'name'      =>  'ELECTRICIAN',
                'icons'     =>  'icon_6.png',
                'description'       =>  'Electrician works related complaints.',
                'created_at'        =>  '2020-01-05 08:24:31',
                'updated_at'        =>  '2020-01-08 16:39:18'
            ],
            [
                'division_id'       =>  json_encode(['1','2']),
                'sup_cat_id'        =>  2,
                'name'      =>  'RO TECHNICIAN',
                'icons'     =>  'icon_11.png',
                'description'       =>  'Water Cooler repair related complaints',
                'created_at'        =>  '2020-01-18 20:16:16',
                'updated_at'        =>  '2020-01-18 20:16:16'
            ],
            [
                'division_id'       =>  json_encode(['1','2']),
                'sup_cat_id'        =>  3,
                'name'      =>  'SIGNAL & TELECOM ENGINEER',
                'icons'     =>  'icon_8.png',
                'description'       =>  'Signal & telecommunication related complaints',
                'created_at'        =>  '2020-01-18 19:52:25',
                'updated_at'        =>  '2020-01-18 19:52:25'
            ],
            [
                'division_id'       =>  json_encode(['1','2']),
                'sup_cat_id'        =>  3,
                'name'      =>  'OTHERS',
                'icons'     =>  'icon_9.png',
                'description'       =>  'Others signal & Telecommunication related complaints',
                'created_at'        =>  '2020-01-18 19:53:14',
                'updated_at'        =>  '2020-01-18 19:53:14'
            
            ],
            [
                'division_id'       =>  json_encode(['1','2']),
                'sup_cat_id'        =>  2,
                'name'      =>  'AC TECHNICIAN',
                'icons'     =>  'icon_10.png',
                'description'       =>  'Air Conditioner repair related complaints',
                'created_at'        =>  '2020-01-18 20:10:04',
                'updated_at'        =>  '2020-01-18 20:10:05'
            
            ],
            [
                'division_id'       =>  json_encode(['1','2']),
                'sup_cat_id'        =>  2,
                'name'      =>  'OTHERS',
                'icons'     =>  'icon_7.png',
                'description'       =>  'Other Electrical Related Complaints',
                'created_at'        =>  '2020-01-18 19:47:04',
                'updated_at'        =>  '2020-01-18 19:47:05'
            ]
        ];
        Category::insert($category);
    }
}