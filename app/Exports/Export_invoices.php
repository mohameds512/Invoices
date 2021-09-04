<?php

namespace App\Exports;

use App\invoices;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class Export_invoices implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return invoices::all();
        return invoices::select('invoices_number','invoices_date','due_date','Amount_collection',
            'Amount_commission','discount','note')->get();


    }
}
// class Export_invoices implements FromView{

//     public function view():view

//     {
//         $invoices = invoices::all();
//         return view('exports.invoices',compact('invoices'));
//     }
// }
