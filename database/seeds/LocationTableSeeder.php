<?php
use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationTableSeeder extends Seeder
{

    /**

     * Run the database seeds.

     *

     * @return void

     */

    public function run()
    {

        $locations = [
            [
                'division_id'   =>  2,
                'name'          =>  'Lower Parel (LP)',
                'description'   =>  NULL,
                'isActive'      =>  '0',
                'created_at'    =>  '2019-09-25 08:00:01',
                'updated_at'    =>  '2019-09-25 08:00:01'
            ],
            [
                'division_id'   =>  2,
                'name'          =>  'Badhwar Park (BP)',
                'description'   =>  NULL,
                'isActive'      =>  '0',
                'created_at'    =>  '2019-09-25 08:00:01',
                'updated_at'    =>  '2019-09-25 08:00:01'
            ],
            [
                'division_id'   =>  2,
                'name'          =>  'Matunga (MRU)',
                'description'   =>  NULL,
                'isActive'      =>  '0',
                'created_at'    =>  '2019-09-25 08:00:01',
                'updated_at'    =>  '2019-09-25 08:00:01'
            ],
            [
                'division_id'   =>  2,
                'name'          =>  'Churchgate (CCG)',
                'description'   =>  NULL,
                'isActive'      =>  '0',
                'created_at'    =>  '2019-09-25 08:00:01',
                'updated_at'    =>  '2019-09-25 08:00:01'
            ],
            [
                'division_id'   =>  2,
                'name'          =>  'Bandra (BAMY)',
                'description'   =>  NULL,
                'isActive'      =>  '0',
                'created_at'    =>  '2019-09-25 08:00:01',
                'updated_at'    =>  '2019-09-25 08:00:01'
            ],
            [
                'division_id'   =>  2,
                'name'          =>  'Mumbai Central (MMCT)',
                'description'   =>  'Mumbai Central',
                'isActive'      =>  '0',
                'created_at'    =>  '2020-01-07 23:42:27',
                'updated_at'    =>  '2020-01-07 23:42:56'
            ],
            [
                'division_id'   =>  2,
                'name'          =>  'Pali Hill (PH)',
                'description'   =>  'Pali Hill (Bandra)',
                'isActive'      =>  '1',
                'created_at'    =>  '2020-01-17 23:44:01',
                'updated_at'    =>  '2020-01-17 23:44:01'
            ],
            [
                'division_id'   =>  1,
                'name'          =>  'P K ROAD',
                'description'   =>  'P K ROAD location of Railway Accommodation in Northern Railways.',
                'isActive'      =>  '1',
                'created_at'    =>  '2018-07-02 20:33:02',
                'updated_at'    =>  '2018-07-02 20:38:35'
            ],
            [
                'division_id'   =>  1,
                'name'          =>  'SARDAR PATEL MARG',
                'description'   =>  'SARDAR PATEL MARG location of Railway Accommodation in Northern Railways.',
                'isActive'      =>  '1',
                'created_at'    =>  '2018-07-02 21:04:39',
                'updated_at'    =>  '2018-07-02 21:04:39'
            ],
            [
                'division_id'   =>  1,
                'name'          =>  'CHELMSFORD ROAD',
                'description'   =>  'SARDAR PATEL MARG location of Railway Accommodation in Northern Railways.',
                'isActive'      =>  '1',
                'created_at'    =>  '2018-07-03 00:47:03',
                'updated_at'    =>  '2018-07-03 00:47:03'
            ],
            [
                'division_id'   =>  1,
                'name'          =>  'SAROJINI NAGAR',
                'description'   =>  'THIS AREA IS FOR THE  QUARTERS OF THE RAILWAY ACCOMODATION',
                'isActive'      =>  '1',
                'created_at'    =>  '2018-07-03 18:37:57',
                'updated_at'    =>  '2018-07-03 18:38:24'
            ],
            [
                'division_id'   =>  1,
                'name'          =>  'TILAK BRIDGE',
                'description'   =>  'TILAK BRIDGE RAILWAYS ACCOMMODATION FOR EMPLOYEES',
                'isActive'      =>  '1',
                'created_at'    =>  '2018-07-03 19:16:55',
                'updated_at'    =>  '2018-07-03 19:16:55'
            ],
            [
                'division_id'   =>  1,
                'name'          =>  'SAN MARTIN MARG',
                'description'   =>  'SAN MARTIN MARG RAILWAYS ACCOMMODATION FOR EMPLOYEES',
                'isActive'      =>  '1',
                'created_at'    =>  '2018-07-03 21:04:50',
                'updated_at'    =>  '2018-07-03 21:04:50'
            ],
            [
                'division_id'   =>  1,
                'name'          =>  'BASANT LANE',
                'description'   =>  'BASANT LANE RAILWAYS ACCOMMODATION FOR EMPLOYERS',
                'isActive'      =>  '1',
                'created_at'    =>  '2018-07-04 00:56:01',
                'updated_at'    =>  '2018-07-18 18:10:48'
            ],
            [
                'division_id'   =>  1,
                'name'          =>  'ANAND VIHAR',
                'description'   =>  'ALL RAILWAY ACCOMMODATION IN ANAND VIHAR ARE STORED IN THIS LOCATION',
                'isActive'      =>  '0',
                'created_at'    =>  '2018-07-04 18:21:40',
                'updated_at'    =>  '2018-07-04 18:21:40'
            ],
            [
                'division_id'   =>  1,
                'name'          =>  'PUNJABI BAGH',
                'description'   =>  'PUNJABI BAGH LOCATION OF RAILWAY ACCOMMODATION',
                'isActive'      =>  '1',
                'created_at'    =>  '2018-07-04 18:22:16',
                'updated_at'    =>  '2018-07-04 18:22:16'
            ],
            [
                'division_id'   =>  1,
                'name'          =>  'STATE ENTRY ROAD',
                'description'   =>  'STATE ENTRY ROAD BASED OFFICER ACCOMMODATION IS COVERED IN THIS LOCATION',
                'isActive'      =>  '1',
                'created_at'    =>  '2018-07-04 18:22:53',
                'updated_at'    =>  '2018-07-04 18:22:53'
            ],
            [
                'division_id'   =>  1,
                'name'          =>  'SHAKUR BASTI',
                'description'   =>  'ALL HOUSES OF SHAKUR BASTI LOCALITY ARE STORED IN THIS LOCATION',
                'isActive'      =>  '1',
                'created_at'    =>  '2018-07-04 18:23:40',
                'updated_at'    =>  '2018-07-04 18:23:40'
            ],
            [
                'division_id'   =>  1,
                'name'          =>  'QUEENS ROAD',
                'description'   =>  'QUEENS ROAD RAILWAY ACCOMMODATION',
                'isActive'      =>  '0',
                'created_at'    =>  '2018-07-04 18:34:14',
                'updated_at'    =>  '2018-07-04 18:34:14'
            ],

            [
                'division_id'   =>  1,
                'name'          =>  'CHANKYAPURI',
                'description'   =>  'CHANKYAPURI LOCALITY OF THE RAILWAYS EMPLOYEES AND OFFICER ACCOMMODATION.',
                'isActive'      =>  '1',
                'created_at'    =>  '2018-10-17 00:47:18',
                'updated_at'    =>  '2018-10-17 00:47:18'
            ],
            [
                'division_id'   =>  1,
                'name'          =>  'SEWA NAGAR',
                'description'   =>  'SEWA NAGAR COLONY OF THE RAILWAY ACCOMMODATION',
                'isActive'      =>  '1',
                'created_at'    =>  '2019-02-26 20:07:58',
                'updated_at'    =>  '2019-02-26 20:07:58'
            ],
            [
                'division_id'   =>  1,
                'name'          =>  'LAJPAT NAGAR',
                'description'   =>  'LAJPAT NAGAR COLONY OF RAILWAY ACCOMMODATION',
                'isActive'      =>  '1',
                'created_at'    =>  '2019-03-01 20:25:13',
                'updated_at'    =>  '2019-03-01 20:25:13'
            ],
            [
                'division_id'   =>  1,
                'name'          =>  'LODHI COLONY',
                'description'   =>  'LODHI COLONY RAILWAY ACCOMMODATION',
                'isActive'      =>  '1',
                'created_at'    =>  '2019-03-23 21:43:13',
                'updated_at'    =>  '2019-03-23 21:43:13'
            ],
            [
                'division_id'   =>  1,
                'name'          =>  'GULABI BAGH',
                'description'   =>  'GULABI BAGH LOCATION UNDER NIZZAMUDDIN',
                'isActive'      =>  '1',
                'created_at'    =>  '2019-07-14 00:18:26',
                'updated_at'    =>  '2019-07-14 00:18:26'
            ],
            [
                'division_id'   =>  1,
                'name'          =>  'OKHLA',
                'description'   =>  'OKHLA OF NORTHEN RAILWAY',
                'isActive'      =>  '1',
                'created_at'    =>  '2019-07-14 20:50:06',
                'updated_at'    =>  '2019-07-14 20:50:06'
            ],
            [
                'division_id'   =>  1,
                'name'          =>  'JUNGPURA',
                'description'   =>  'JUNGPURA OF NORTHEN RAILWAY',
                'isActive'      =>  '1',
                'created_at'    =>  '2019-07-14 20:51:16',
                'updated_at'    =>  '2019-07-14 20:51:16'
            ],
            [
                'division_id'   =>  1,
                'name'          =>  'HNZM',
                'description'   =>  'HNZM LOCATION NORTHEN RAILWAY',
                'isActive'      =>  '1',
                'created_at'    =>  '2019-07-14 20:52:18',
                'updated_at'    =>  '2019-07-14 20:52:18'
            ]
        ];
        Location::insert($locations);
    }

}