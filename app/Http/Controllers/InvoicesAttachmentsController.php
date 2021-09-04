<?php

namespace App\Http\Controllers;

use App\invoices_attachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoicesAttachmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request , [
            'file_name' => 'mimes:pdf,png,jpg,jpeg'
        ],[
            'file_name.mimes'=> 'صيغة المرفق يجب ان تكون pdf,png,jpg,jpeg '
        ]);

        $image = $request->file('file_name');
        $file_name = $image->getClientOriginalName();

        $attachments = new invoices_attachments();

        $attachments->file_name = $file_name ;
        $attachments->invoices_number = $request->invoices_number;
        $attachments->invoices_id = $request->invoice_id;
        $attachments->created_by = Auth::user()->name;
        $attachments ->save();

        // move file

        $imageName = $request->file_name->getClientOriginalName();
        $request->file_name->move(('Attachments/'. $request->invoices_number), $imageName);
        session()->flash('Add','تم أضافة المرفق');

        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\invoices_attachments  $invoices_attachments
     * @return \Illuminate\Http\Response
     */
    public function show(invoices_attachments $invoices_attachments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invoices_attachments  $invoices_attachments
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices_attachments $invoices_attachments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invoices_attachments  $invoices_attachments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_attachments $invoices_attachments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invoices_attachments  $invoices_attachments
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoices_attachments $invoices_attachments)
    {
        //
    }
}
