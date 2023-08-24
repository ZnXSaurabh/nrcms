<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Auth;
use App\Models\Complaint;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ComplaintExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $from;
    private $to;
    private $status;

    public function __construct(string $from ,string $to,string $status) 
    {
        $this->from = $from;
        $this->to = $to;
        $this->status = $status;
    }

    public function collection()
    {   
        $data= Complaint::whereIn('location_id', auth()->user()->locations()->get()->pluck('id'))->where('sup_cat_id', Auth::user()->profile->department)->where('status', $this->status)->where('created_at','>=',$this->from)->where('created_at','<=',$this->to)->orderBy('created_at', 'DESC')->select('id', 'comp_id', 'category_id', 'sub_category_id', 'status', 'created_at')->get();
        
        return $data;
    }
    
     public function headings() :array
    {
        return ['ID', 'Complaint ID', 'Category', 'Sub Category', 'Status', 'Date'];
    }
}
