<?php

namespace App\Http\Controllers;

use App\invoices;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        return view('reports.invoices_reports');
    }

    public function search(Request $request)
    {
        // return $request;
        $radio = $request->radio;

        if ($radio == 1 ) {




            if ($request->type && $request->start_at == '' && $request->end_at == '') {


                if ($request->type == 4 ) {

                    $invoices = invoices::select('*')->get();
                    $type = 'الكل';
                    return view('reports.invoices_reports' , compact('type'))->withDetails($invoices);
                }

                $invoices = invoices::select('*')->where('value_status' ,'=' , $request->type)->get();

                if ($request->type == 1) {
                    $type = 'الفواتير المدفوعه';
                } elseif($request->type == 2) {
                    $type = 'الفواتير الغير مدفوعه';
                }else{
                    $type = 'الفواتير المدفوعه جزئيل';
                }

                return view('reports.invoices_reports' , compact('type'))->withDetails($invoices);

            } else {

                $start_at = $request->start_at;
                $end_at = $request->end_at;
                if ($request->type == 1) {
                    $type = 'الفواتير المدفوعه';
                } elseif($request->type == 2) {
                    $type = 'الفواتير الغير مدفوعه';
                }else{
                    $type = 'الفواتير المدفوعه جزئيل';
                }
                $invoices = invoices::whereBetween('invoices_date' ,[$start_at , $end_at])
                ->where('value_status' ,'=' , $request->type)->get();

                return view('reports.invoices_reports' , compact('type','start_at' , 'end_at'))->withDetails($invoices);
            }

        } else {

            $invoices_number = $request->invoices_number;
            $invoices = invoices::select('*')->where('invoices_number', '=' , $invoices_number)->get();

            if ($request->type == 1) {
                $type = 'الفواتير المدفوعه';
            } elseif($request->type == 2) {
                $type = 'الفواتير الغير مدفوعه';
            }else{
                $type = 'الفواتير المدفوعه جزئيل';
            }

            return view('reports.invoices_reports' , compact('type'))->withDetails($invoices);
        }

    }
}
