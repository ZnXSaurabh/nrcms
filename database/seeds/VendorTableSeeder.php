<?php

use App\Models\SSE\Vendor;
use Illuminate\Database\Seeder;

class VendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // dummy vendor

        $vendor = new Vendor();

        $vendor->division_id = 1;

        $vendor->location_id = 1;
        
        $vendor->area_id = 1;

        $vendor->name = "M/S Atlas Infra Structure.";

        $vendor->email = null;

        $vendor->mobile = "6396253928";

        $vendor->agreement_no = 'Accpt. No. 487/2/418(WA) 17/18 dt. 7/09/2018';

        $vendor->photo = 'photo_10.jpeg';

        $vendor->remarks = null;

        $vendor->save();
    }
}