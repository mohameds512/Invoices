<?php

namespace App\Http\Controllers;

use App\invoices;
use App\invoices_attachments;
use App\invoices_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use file;
use Illuminate\Filesystem\FilesystemAdapter;

class InvoicesDetailsController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function show(invoices_details $invoices_details)
    {
        //
    }

    public function getDetails($id)
    {
        $invoices = invoices::where('id' , $id)->first();

        $invoices_details = invoices_details::where('Invoices_id' , $id)->get();

        $invoices_attachments = invoices_attachments::where('invoices_id' , $id)->get();

        return view('invoices.invoices_Details',compact('invoices','invoices_details' , 'invoices_attachments'));

    }

    public function open_file($invoices_number , $file_name)
    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoices_number .'/'.$file_name);
        return response()->file($files);
    }


    public function get_file($invoices_number , $file_name)
    {
        $contents = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoices_number .'/'.$file_name);

        return response()->download($contents);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $attachment = invoices_attachments::findOrFail($request->file_id);
        $attachment->delete();
        Storage::disk('public_uploads')->delete($request->invoices_number.'/'.$request->file_name);
        session()->flash('delete','تم الحذف بنجاح');
        return back() ;

    }
}
