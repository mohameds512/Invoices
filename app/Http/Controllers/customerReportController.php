<?php

namespace App\Http\Controllers;

use App\invoices;
use App\sections;
use Illuminate\Http\Request;

class customerReportController extends Controller
{
    public function index()
    {
        $sections = sections::all();
        return view('reports.customer_reports',compact('sections'));
    }

    public function search(Request $request)
    {
        if ($request->section_id && $request->products && $request->start_at == '' && $request->end_at == '') {

            $invoices = invoices::select('*')->where('section_id', '=' ,$request->section_id )->where('product' , '=',$request->products)->get();
            $sections = sections::all();

            $invoices_sec = invoices::where('section_id', '=' ,$request->section_id )->first();
            $section_name = $invoices_sec->section->section_name;
            $product = $request->products;

            return view('reports.customer_reports' , compact('sections','section_name' , 'product'))->withDetails($invoices);

        } else {

            $start_at = $request->start_at;
            $end_at = $request->end_at;
            $invoices_sec = invoices::where('section_id', '=' ,$request->section_id )->first();
            $section_name = $invoices_sec->section->section_name;
            $product = $request->products;
            $sections = sections::all();

            $invoices = invoices::whereBetween('invoices_date' ,[$start_at , $end_at])
                ->where('section_id', '=' ,$request->section_id )
                ->where('product' , '=',$request->products)->get();
                return view('reports.customer_reports' , compact('sections','section_name' , 'product', 'start_at','end_at'))->withDetails($invoices);
        }


    }
}

