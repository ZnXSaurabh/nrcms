<?php
use App\Models\SSE\Resource;
use Illuminate\Database\Seeder;

class ResourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // dummy Resource

        $resource = new Resource();

        $resource->division_id = 1;

        $resource->location_id = 1;
        
        $resource->vendor_id = 1;

        $resource->name = "M/S Atlas Infra Structure.";

        $resource->email = NULL;

        $resource->mobile = "8126273523";

        $resource->address = 'Pali Hill (Full address not available)';

        $resource->pfno = NULL;

        $resource->esi_no = NULL;
        
        $resource->sup_cat_id = 1;
        
        $resource->category_id = 1;
        
        $resource->sub_category_id = 1;
        
        $resource->photo = 'photo_10.jpeg';

        $resource->remarks = NULL;

        $resource->save();
    }
}
