<?php
use App\Models\Area;
use Illuminate\Database\Seeder;

class AreaTableSeeder extends Seeder
{

    /**

     * Run the database seeds.

     *

     * @return void

     */

    public function run()
    {
        $areas = [
            [   
                'division_id'   =>  2,
                'location_id'   =>  1,
                'name'          =>  'Area-I',
                'description'   =>  'Area-I of PL Location',
                'created_at'    =>  '2019-09-25 08:06:46',
                'updated_at'    =>  '2019-09-25 08:06:46'
            ],
            [   
                'division_id'   =>  2,
                'location_id'   =>  2,
                'name'          =>  'Area-I',
                'description'   =>  'Area-I of BP Location',
                'created_at'    =>  '2019-09-25 08:06:46',
                'updated_at'    =>  '2019-09-25 08:06:46'
            ],
            [   
                'division_id'   =>  2,
                'location_id'   =>  3,
                'name'          =>  'Area-I',
                'description'   =>  'Area-I of MRU Location',
                'created_at'    =>  '2019-09-25 08:06:46',
                'updated_at'    =>  '2019-09-25 08:06:46'
            ],
            [
                'division_id'   =>  2,
                'location_id'   =>  4,
                'name'          =>  'Area-I',
                'description'   =>  'Area-I of CCG Location',
                'created_at'    =>  '2019-09-25 08:06:46',
                'updated_at'    =>  '2019-09-25 08:06:46'
            ],
            [
                'division_id'   =>  2,
                'location_id'   =>  5,
                'name'          =>  'Area-I',
                'description'   =>  'Area-I of BAMY Location',
                'created_at'    =>  '2019-09-25 08:06:46',
                'updated_at'    =>  '2019-09-25 08:06:46'
            ],
            [
                'division_id'   =>  2,
                'location_id'   =>  2,
                'name'          =>  'Area-II',
                'description'   =>  'Area-II of Badhwar Park (BP)',
                'created_at'    =>  '2019-09-29 03:05:08',
                'updated_at'    =>  '2019-09-29 03:05:08'
            ],
            [
                'division_id'   =>  2,
                'location_id'   =>  7,
                'name'          =>  'Area - I',
                'description'   =>  NULL,
                'created_at'    =>  '2020-01-07 23:43:08',
                'updated_at'    =>  '2020-01-07 23:43:08'
            ],
            [
                'division_id'   =>  2,
                'location_id'   =>  8,
                'name'          =>  'Area - I',
                'description'   =>  'Area-I of Pali Hill Location',
                'created_at'    =>  '2020-01-17 23:44:45',
                'updated_at'    =>  '2020-01-17 23:44:45'
            ],
            [
                'division_id'   =>  1,
                'location_id'   =>  1,
                'name'          =>  'AREA-1',
                'description'   =>  NULL,
                'created_at'    =>  '2018-07-02 20:39:11',
                'updated_at'    =>  '2018-07-02 20:39:11'
            ],
            [
                'division_id'   =>  1,
                'location_id'   =>  2,
                'name'          =>  'AREA-1',
                'description'   =>  NULL,
                'created_at'    =>  '2018-07-02 21:05:00',
                'updated_at'    =>  '2018-07-02 21:40:27'
            ],
            [
                'division_id'   =>  1,
                'location_id'   =>  3,
                'name'          =>  'AREA- 1',
                'description'   =>  NULL,
                'created_at'    =>  '2018-07-03 00:47:14',
                'updated_at'    =>  '2018-07-03 00:47:14'
            ],
            [
                'division_id'   =>  1,
                'location_id'   =>  4,
                'name'          =>  'AREA- 1',
                'description'   =>  NULL,
                'created_at'    =>  '2018-07-03 18:39:25',
                'updated_at'    =>  '2018-07-03 18:39:25'
            ],
            [
                'division_id'   =>  1,
                'location_id'   =>  5,
                'name'          =>  'AREA- I',
                'description'   =>  NULL,
                'created_at'    =>  '2018-07-03 19:17:36',
                'updated_at'    =>  '2018-07-03 19:17:36'
            ],
            [
                'division_id'   =>  1,
                'location_id'   =>  6,
                'name'          =>  'AREA- 1',
                'description'   =>  NULL,
                'created_at'    =>  '2018-07-03 21:05:14',
                'updated_at'    =>  '2018-07-03 21:05:14'
            ],
            [
                'division_id'   =>  1,
                'location_id'   =>  7,
                'name'          =>  'AREA- 1',
                'description'   =>  NULL,
                'created_at'    =>  '2018-07-04 00:56:12',
                'updated_at'    =>  '2018-07-04 00:56:12'
            ],
            [
                'division_id'   =>  1,
                'location_id'   =>  8,
                'name'          =>  'AREA- I',
                'description'   =>  'AREA- I OF THE ANAND VIHAR COLONY',
                'created_at'    =>  '2018-07-04 18:24:25',
                'updated_at'    =>  '2018-07-04 18:29:01'
            ],
            [
                'division_id'   =>  1,
                'location_id'   =>  9,
                'name'          =>  'AREA- I',
                'description'   =>  NULL,
                'created_at'    =>  '2018-07-04 18:25:11',
                'updated_at'    =>  '2018-07-04 18:25:11'
            ],
            [
                'division_id'   =>  1,
                'location_id'   =>  10,
                'name'          =>  'AREA- I',
                'description'   =>  'AREA- I OF THE STATE ENTRY ROAD',
                'created_at'    =>  '2018-07-04 18:26:43',
                'updated_at'    =>  '2018-07-04 18:28:07'
            ],
            [
                'division_id'   =>  1,
                'location_id'   =>  11,
                'name'          =>  'AREA- I',
                'description'   =>  NULL,
                'created_at'    =>  '2018-07-04 18:29:27',
                'updated_at'    =>  '2018-07-04 18:29:27'
            ],
            [
                'division_id'   =>  1,
                'location_id'   =>  12,
                'name'          =>  'AREA- I',
                'description'   =>  NULL,
                'created_at'    =>  '2018-07-04 18:34:30',
                'updated_at'    =>  '2018-07-04 18:34:30'
            ],
            [
                'division_id'   =>  1,
                'location_id'   =>  16,
                'name'          =>  'AREA- I',
                'description'   =>  'AREA I OF LODHI COLONY',
                'created_at'    =>  '2019-03-23 21:43:39',
                'updated_at'    =>  '2019-03-23 21:43:39'
            ],
            [
                'division_id'   =>  1,
                'location_id'   =>  13,
                'name'          =>  'AREA-I',
                'description'   =>  'Area I of Chankyapuri',
                'created_at'    =>  '2018-10-17 00:47:56',
                'updated_at'    =>  '2018-10-17 00:47:56'
            ],
            [
                'division_id'   =>  1,
                'location_id'   =>  14,
                'name'          =>  'AREA -I',
                'description'   =>  'AREA I of SEWA NAGAR',
                'created_at'    =>  '2019-02-26 20:08:23',
                'updated_at'    =>  '2019-02-26 20:08:23'
            ],
            [
                'division_id'   =>  1,
                'location_id'   =>  15,
                'name'          =>  'AREA-I',
                'description'   =>  'AREA I OF LAJPAT NAGAR RAILWAY COLONY',
                'created_at'    =>  '2019-03-01 20:25:41',
                'updated_at'    =>  '2019-03-01 20:25:41'
            ],
            [
                'division_id'   =>  1,
                'location_id'   =>  17,
                'name'          =>  'AREA- I',
                'description'   =>  'AREA I OF GULABI BAGH',
                'created_at'    =>  '2019-07-14 00:18:48',
                'updated_at'    =>  '2019-07-14 00:18:48'
            ],
            [
                'division_id'   =>  1,
                'location_id'   =>  18,
                'name'          =>  'AREA-I',
                'description'   =>  'AREA-I OF OKHLA LOCATION',
                'created_at'    =>  '2019-07-14 20:55:09',
                'updated_at'    =>  '2019-07-14 20:55:09'
            ],
            [
                'division_id'   =>  1,
                'location_id'   =>  19,
                'name'          =>  'AREA-I',
                'description'   =>  'AREA-I OF JUNGPURA LOCATION',
                'created_at'    =>  '2019-07-14 20:55:51',
                'updated_at'    =>  '2019-07-14 20:55:51'
            ],
            [
                'division_id'   =>  1,
                'location_id'   =>  20,
                'name'          =>  'AREA-I',
                'description'   =>  'AREA-I OF HNZM LOCATION',
                'created_at'    =>  '2019-07-14 20:56:28',
                'updated_at'    =>  '2019-07-14 20:56:28'
            ]
        ];
        Area::insert($areas);
    }
}