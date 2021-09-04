<?php

namespace App\Http\Controllers;

use App\invoices;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $total = invoices::count();
        $paied_invoices = round((invoices::where('value_status' , 1)->count() / $total) * 100 , 2) ;
        $not_paied_invoices = round((invoices::where('value_status' , 3)->count() / $total) * 100 , 2);
        $par_paied_invoices = round((invoices::where('value_status' , 2)->count() / $total) * 100 , 2);

        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 150])
            ->labels(['الفواتير المدفوعة', 'الفواتير الغير مدفوعه', 'الفواتير المدفوعة جزئيا'])
            ->datasets([

                [
                    "label" => "  الفواتيرالمدفوعة ",
                    'backgroundColor' => ['#2ca458'],
                    'data' => [$paied_invoices]
                ],
                [
                    "label" => "الفواتير الغير مدفوعه",
                    'backgroundColor' => ['#b60f2b'],
                    'data' => [$not_paied_invoices]
                ],
                [
                    "label" => "الفواتير المدفوعة جزئيا'",
                    'backgroundColor' => ['#FF9032'],
                    'data' => [$par_paied_invoices]
                ]
            ])
            ->options([
                'legend' => [
                    'display' => true,
                    'labels' => [
                        'fontFamily' => 'cairo',
                        'fontStyle' => 'bold',
                        'fontSize' => 14
                    ]
                ]
            ]);


        $CircleChartjs = app()->chartjs
        ->name('pieChartTest')
        ->type('pie')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['الفواتير المدفوعة', 'الفواتير الغير مدفوعه', 'الفواتير المدفوعة جزئيا'])
        ->datasets([
            [
                'backgroundColor' => ['#2ca458', '#b60f2b','#FF9032'],
                'hoverBackgroundColor' => ['#2ca458', '#b60f2b','#FF9032'],
                'data' => [$paied_invoices, $not_paied_invoices, $par_paied_invoices]
            ]
        ])
        ->options([]);

        return view('home',compact('chartjs','CircleChartjs'));
    }
}
