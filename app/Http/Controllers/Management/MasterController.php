<?php
namespace App\Http\Controllers\Management;

use App\Models\Area;
use App\Models\Block;
use App\Models\Quarter;
use App\Models\Category;
use App\Models\Location;
use App\Models\Housetype;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\ServiceBuilding;
use App\Http\Controllers\Controller;

class MasterController extends Controller
{
    public function locations()
    {
        return Location::orderBy('name', 'ASC')->get(['id', 'name']);
    }

    public function areasOfALocation($location_id)
    {
        return Area::where('location_id', $location_id)->orderByRaw('LENGTH(name) ASC')->get(['id', 'name']);
    }

    public function housetypesOfAnArea($area_id)
    {
        return Housetype::where('area_id', $area_id)->orderByRaw('LENGTH(name) ASC')->get(['id', 'name']);
    }

    public function blocksOfAHousetype($housetype_id)
    {
        return Block::where('housetype_id', $housetype_id)->orderByRaw('LENGTH(name) ASC')->orderBy('name')->get(['id', 'name']);
    }

    public function housetypesOfALocation($location_id)
    {
        return Housetype::where('location_id', $location_id)->orderBy('name', 'ASC')->get(['id', 'name']);
    }

    public function quartersOfABlock($block_id)
    {
        return Quarter::where('block_id', $block_id)->where('status', 'Occupied')->orderBy('qtrno', 'ASC')->get(['id', 'qtrno']);
    }

    public function buildingsOfAnArea($area_id)
    {
        return ServiceBuilding::where('area_id', $area_id)->orderBy('name', 'ASC')->get(['id', 'name']);
    }

    public function categoriesOfASuperCategory($sup_cat_id)
    {
        return Category::where('sup_cat_id', $sup_cat_id)->orderBy('name', 'ASC')->get(['id', 'name']);
    }

    public function subcategoriesOfACategory($category_id)
    {
        return SubCategory::where('category_id', $category_id)->orderBy('name', 'ASC')->get(['id', 'name']);
    }
}
