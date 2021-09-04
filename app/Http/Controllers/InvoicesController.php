<?php

namespace App\Http\Controllers;

use App\Exports\Export_invoices;
use App\invoices;
use App\invoices_attachments;
use App\invoices_details;
use App\Notifications\AddInvoice;
use App\sections;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class InvoicesController extends Controller
{

    // function __construct()
    // {

    //     $this->middleware('permission: قائمة الفواتير' , ['only'=>['index']]);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = invoices::all();
        return view('invoices.invoices' , compact('invoices'));
    }

    public function invoices_PUP($value_status)
    {
        $invoices = invoices::where('value_status' , $value_status)->get();

        return view('invoices.invoices_PUP', compact(['invoices','value_status']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = sections::all();
        return view('invoices.add_invoices', compact('sections'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'invoices_number' => 'required',
            'invoices_date' => 'required|date',
            'Due_date' => 'required|date',
            'section_id' => 'required',
            'products' => 'required',
            'amount_collection' => 'required',
            'amount_commission' => 'required',
            'discount' => 'required',
        ]);

        invoices::create([
            'invoices_number' => $request->invoices_number,
            'invoices_date' => $request->invoices_date,
            'due_date' => $request->Due_date,
            'product' => $request->products,
            'section_id' => $request->section_id,
            'Amount_collection' => $request->amount_collection,
            'Amount_commission' => $request->amount_commission,
            'discount' => $request->discount,
            'rate_vat' => $request->rate_vat,
            'value_vat' => $request-> value_vat,
            'total' => $request->total,
            'note' => $request->note,
            'user' => Auth::user()->id,
            'value_status' => '2',
            'status' => 'غير مدفوعة' ,
        ]);

        $invoice_id = invoices::latest()->first()->id;

        invoices_details::create([
            'Invoices_id' => $invoice_id,
            'invoices_number' => $request->invoices_number,
            'product' => $request->products,
            'section' => $request->section_id,
            'value_status' => '2',
            'status' => 'غير مدفوعة' ,
            'note' => $request->note,
            'user' => Auth::user()->name,

        ]);

        if ($request->hasFile('attachment')) {

            $invoice_id = invoices::latest()->first()->id;
            $image = $request->file('attachment');
            $file_name = $image->getClientOriginalName();
            $invoices_number = $request->invoices_number;

            $attachment = new invoices_attachments();

            $attachment->file_name = $file_name;
            $attachment->invoices_number = $invoices_number;
            $attachment->created_by = Auth::user()->name;
            $attachment->invoices_id = $invoice_id;
            $attachment->save();

            // move file to the server

            $image_name = $request->attachment->getClientOriginalName();
            $request->attachment->move(('Attachments/'.$invoices_number), $image_name);

        }


        // to send mail notification
        // $user = User::first();

        // $user->notify(new AddInvoice($invoice_id));

        // Notification::send($user , new AddInvoice($invoice_id));

        session()->flash('Add','تم أضافة الفاتورة');
        return redirect('/invoices');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $invoice = invoices::where('id' , $id)->first();

        return view('invoices.status_update',compact('invoice'));
    }

    public function update_status(Request $request , $id)
    {

        $invoice = invoices::findOrFail($id);
        if ($request->status == 1 ) {

            $invoice->update([
                'status' => 'مدفوعة' ,
                'value_status' => $request->status,
            ]);
            invoices_details::create([
                'Invoices_id' => $request->invoice_id,
                'invoices_number' => $request->invoice_number,
                'product' => $request->product,
                'section' => $request->section_id,
                'status' => "مدفوعة",
                'value_status' => $request->status,
                'Payment_Date' => $request->Payment_Date,
                'note' => $request->note,
                'user' => auth()->user()->name,

            ]);

        } else {

            $invoice->update([
                'status' => 'مدفوعة جزئيا' ,
                'value_status' => $request->status,
            ]);
            invoices_details::create([
                'Invoices_id' => $request->invoice_id,
                'invoices_number' => $request->invoice_number,
                'product' => $request->product,
                'section' => $request->section_id,
                'status' => 'مدفوعة جزئيا',
                'value_status' => $request->status,
                'Payment_Date' => $request->Payment_Date,
                'note' => $request->note,
                'user' => auth()->user()->name,

            ]);

        }

        session()->flash('update_status');
        return redirect('/invoices');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $invoice = invoices::where('id' , $id)->first();
        $sections = sections::all();
        return view('invoices.edit_invoice', compact('invoice','sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $invoice = invoices::findOrFail($request->invoice_id);

        $invoice->update([
            'invoices_number'=>$request->invoices_number,
            'invoices_date'=>$request->invoices_date,
            'due_date'=>$request->Due_date,
            'section_id'=>$request->section_id,
            'product'=>$request->products,
            'Amount_collection'=>$request->amount_collection,
            'Amount_commission'=>$request->amount_commission,
            'discount'=>$request->discount,
            'rate_vat'=>$request->rate_vat,
            'value_vat'=>$request->value_vat,
            'total'=>$request->total,
            'note'=>$request->note,

        ]);

        session()->flash('edit','تم تعديل الفاتورة');
        return redirect('/invoices');
    }


    public function print_invoice( $id)
    {

        $invoice = invoices::findOrFail($id);
        return view('invoices.print_invoice', compact('invoice'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {


        $id = $request->invoice_id;
        $invoice = invoices::where('id',$id)->first();
        $attachs = invoices_attachments::where('invoices_id',$id)->first();

        if (!$request->id_page == 2) {

            if (!empty($attachs->invoices_number)) {

                Storage::disk('public_uploads')->deleteDirectory($attachs->invoices_number);

        }

        $invoice->forceDelete();
        session()->flash('delete_invoice');
        return redirect('/invoices');

        }else{

            $invoice->delete();
            session()->flash('Archive_invoice');
            return redirect('/Archive');
        }



    }

    public function export()
    {
        return Excel::download(new Export_invoices , 'قائمة الفواتير.xlsx');
        // return Excel::download(new Export_invoices , 'قائمة الفواتير.csv');


    }

    public function getProducts($id)
    {
        $products = DB::table('products')->where('section_id',$id)->pluck("product_name", "id" );

        return json_encode($products);
    }
}
