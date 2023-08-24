<?php
use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class SubCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subCategory = [
            [
                'division_id'   =>  json_encode(['1','2']),
                'category_id'   =>  1,
                'icons'         =>  'icon_1.png',
                'name'          =>  'TAP LEAKAGE',
                'description'   =>  'Tap Leakage related complaints',
                'created_at'    =>  '2020-01-04 12:09:48',
                'updated_at'    =>  '2020-01-04 12:09:48'
            ],
            [
                'division_id'   =>  json_encode(['1','2']),
                'category_id'   =>  1,
                'icons'         =>  'icon_2.png',
                'name'          =>  'CISTERN NOT WORKING',
                'description'   =>  'Cistern works related complaints',
                'created_at'    =>  '2020-01-04 12:11:16',
                'updated_at'    =>  '2020-01-04 12:11:16'
            ],
            [
                'division_id'   =>  json_encode(['1','2']),
                'category_id'   =>  1,
                'icons'         =>  'icon_3.png',
                'name'          =>  'TANK LEAKAGE',
                'description'   =>  'Tank Leakage works related complaints',
                'created_at'    =>  '2020-01-04 12:12:55',
                'updated_at'    =>  '2020-01-04 12:12:55'
            ],
            [
                'division_id'   =>  json_encode(['1','2']),
                'category_id'   =>  1,
                'icons'         =>  'icon_4.png',
                'name'          =>  'NO WATER SUPPLY',
                'description'   =>  'Tank Leakage works related complaints',
                'created_at'    =>  '2020-01-04 12:18:18',
                'updated_at'    =>  '2020-01-04 12:24:40'
            ],
            [
                'division_id'   =>  json_encode(['1','2']),
                'category_id'   =>  1,
                'icons'         =>  'icon_5.png',
                'name'          =>  'PIPE LEAKAGE',
                'description'   =>  'Pipe Leakage works related complaints',
                'created_at'    =>  '2020-01-04 12:19:13',
                'updated_at'    =>  '2020-01-04 12:19:13'
            ],
            [
                'division_id'   =>  json_encode(['1','2']),
                'category_id'   =>  6,
                'icons'         =>  'icon_6.png',
                'name'          =>  'FAN NOT WORKING',
                'description'   =>  'Electrician works related complaints',
                'created_at'    =>  '2020-01-05 08:39:00',
                'updated_at'    =>  '2020-01-05 08:39:00'
            ],
            [
                'division_id'   =>  json_encode(['1','2']),
                'category_id'   =>  4,
                'icons'         =>  'icon_8.png',
                'name'          =>  'TILES & FLOOR REPAIR',
                'description'   =>  'Tiles and floor repairing related works',
                'created_at'    =>  '2020-01-15 07:35:19',
                'updated_at'    =>  '2020-01-15 23:00:34'
            ],
            [
                'division_id'   =>  json_encode(['1','2']),
                'category_id'   =>  1,
                'icons'         =>  'icon_9.png',
                'name'          =>  'SINK REPAIR',
                'description'   =>  'Sink Repair Related Complaint',
                'created_at'    =>  '2020-01-17 23:10:59',
                'updated_at'    =>  '2020-01-18 20:30:11'
            ],
            [
                'division_id'   =>  json_encode(['1','2']),
                'category_id'   =>  2,
                'icons'         =>  'icon_10.png',
                'name'          =>  'Door or Window Repair',
                'description'   =>  'Door or Window Repair related Complaints',
                'created_at'    =>  '2020-01-17 23:15:23',
                'updated_at'    =>  '2020-01-17 23:15:23'
            ],
            [
                'division_id'   =>  json_encode(['1','2']),
                'category_id'   =>  2,
                'icons'         =>  'icon_11.png',
                'name'          =>  'Door Lock Repair',
                'description'   =>  'Door or Window Repair Related Complaints',
                'created_at'    =>  '2020-01-17 23:16:53',
                'updated_at'    =>  '2020-01-17 23:16:53'
            ],
            [
                'division_id'   =>  json_encode(['1','2']),
                'category_id'   =>  3,
                'icons'         =>  'icon_12.png',
                'name'          =>  'Door & Window Paint',
                'description'   =>  'Door & Window paint related complaints',
                'created_at'    =>  '2020-01-17 23:27:05',
                'updated_at'    =>  '2020-01-17 23:27:05'
            ],
            [
                'division_id'   =>  json_encode(['1','2']),
                'category_id'   =>  3,
                'icons'         =>  'icon_13.png',
                'name'          =>  'Wall Paint & Putty',
                'description'   =>  'Wall Paint & Putty Related Complaints',
                'created_at'    =>  '2020-01-17 23:36:27',
                'updated_at'    =>  '2020-01-17 23:36:28'
            ],
            [
                'division_id'   =>  json_encode(['1','2']),
                'category_id'   =>  4,
                'icons'         =>  'icon_14.png',
                'name'          =>  'Ceiling Leakage',
                'description'   =>  'Ceiling Leakage Repair Related Complaints',
                'created_at'    =>  '2020-01-17 23:38:39',
                'updated_at'    =>  '2020-01-17 23:38:39'
            ],
            [
                'division_id'   =>  json_encode(['1','2']),
                'category_id'   =>  4,
                'icons'         =>  'icon_15.png',
                'name'          =>  'Plaster Damage',
                'description'   =>  'Plaster Damage Repair Related Complaints',
                'created_at'    =>  '2020-01-17 23:39:17',
                'updated_at'    =>  '2020-01-17 23:39:17'
            ],
            [
                'division_id'   =>  json_encode(['1','2']),
                'category_id'   =>  6,
                'icons'         =>  'icon_16.png',
                'name'          =>  'LIGHTS & FITTINGS',
                'description'   =>  'Light and fittings related complaints',
                'created_at'    =>  '2020-01-18 20:36:39',
                'updated_at'    =>  '2020-01-18 21:07:23'
            ],
            [
                'division_id'   =>  json_encode(['1','2']),
                'category_id'   =>  6,
                'icons'         =>  'icon_17.png',
                'name'          =>  'Geyser Repair',
                'description'   =>  'Geyser Repair related complaints',
                'created_at'    =>  '2020-01-18 20:42:16',
                'updated_at'    =>  '2020-01-18 20:42:16'
            ],
            [
                'division_id'   =>  json_encode(['1','2']),
                'category_id'   =>  6,
                'icons'         =>  'icon_18.png',
                'name'          =>  'WATER PUMP REPAIR',
                'description'   =>  'Water Pump repair related complaints',
                'created_at'    =>  '2020-01-18 20:44:13',
                'updated_at'    =>  '2020-01-18 20:44:13'
            ],
            [
                'division_id'   =>  json_encode(['1','2']),
                'category_id'   =>  7,
                'icons'         =>  'icon_19.png',
                'name'          =>  'Water Cooler Repair',
                'description'   =>  'Water cooler repair related complaints',
                'created_at'    =>  '2020-01-18 20:59:14',
                'updated_at'    =>  '2020-01-18 20:59:14'
            ],
            [
                'division_id'   =>  json_encode(['1','2']),
                'category_id'   =>  10,
                'icons'         =>  'icon_20.png',
                'name'          =>  'Air Conditioner Repair',
                'description'   =>  'Air Conditioner repair related complaints',
                'created_at'    =>  '2020-01-18 21:01:10',
                'updated_at'    =>  '2020-01-18 21:01:10'
            ],
            [
                'division_id'   =>  json_encode(['1','2']),
                'category_id'   =>  5,
                'icons'         =>  'icon_21.png',
                'name'          =>  'Other Civil Works',
                'description'   =>  'Other Civil Works related Complaint',
                'created_at'    =>  '2020-01-18 21:16:24',
                'updated_at'    =>  '2020-01-18 21:16:24'
            ],
            [
                'division_id'   =>  json_encode(['1','2']),
                'category_id'   =>  11,
                'icons'         =>  'icon_22.png',
                'name'          =>  'Other Electrical Works',
                'description'   =>  'Other Electrical Works Related Complaints',
                'created_at'    =>  '2020-01-18 21:17:50',
                'updated_at'    =>  '2020-01-18 21:17:50'
            ],
            [
                'division_id'   =>  json_encode(['1','2']),
                'category_id'   =>  9,
                'icons'         =>  'icon_23.png',
                'name'          =>  'Other S&T Works',
                'description'   =>  'Other Signal & Telecommunication works related complaints',
                'created_at'    =>  '2020-01-18 21:18:55',
                'updated_at'    =>  '2020-01-18 21:18:55'
            ],
            [
                'division_id'   =>  json_encode(['1','2']),
                'category_id'   =>  8,
                'icons'         =>  'icon_24.png',
                'name'          =>  'Internet Works',
                'description'   =>  'Internet works related complaints',
                'created_at'    =>  '2020-01-18 21:26:03',
                'updated_at'    =>  '2020-01-18 21:26:03'
            ],
            [
                'division_id'   =>  json_encode(['1','2']),
                'category_id'   =>  8,
                'icons'         =>  'icon_25.png',
                'name'          =>  'Printer Works',
                'description'   =>  'Printer works related complaints',
                'created_at'    =>  '2020-01-18 21:26:48',
                'updated_at'    =>  '2020-01-18 21:26:48'
            ],
            [
                'division_id'   =>  json_encode(['1','2']),
                'category_id'   =>  8,
                'icons'         =>  'icon_26.png',
                'name'          =>  'Computer Repair Works',
                'description'   =>  'Computer Repair Works Related Complaints',
                'created_at'    =>  '2020-01-18 21:29:02',
                'updated_at'    =>  '2020-01-18 21:29:02'
            ],
            [
                'division_id'   =>  json_encode(['1','2']),
                'category_id'   =>  8,
                'icons'         =>  'icon_27.png',
                'name'          =>  'Telephone Repair Works',
                'description'   =>  'Telephone Repair Works related Complaints',
                'created_at'    =>  '2020-01-18 21:30:00',
                'updated_at'    =>  '2020-01-18 21:30:00'
            ],
        ];
        SubCategory::insert($subCategory);
    }
}
