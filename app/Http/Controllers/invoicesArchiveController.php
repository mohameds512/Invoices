<?php

namespace App\Http\Controllers;

use App\invoices;
use App\invoices_attachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class invoicesArchiveController extends Controller
{
    public function index()
    {
        $invoices = invoices::onlyTrashed()->get();
        return view('invoices.Archive_invoices' , compact('invoices'));
    }

    public function update(Request $request)
    {

        $id = $request->invoice_id;
        $invoices = invoices::withTrashed()->where('id' , $id)->restore();
        session()->flash('restored');
        return redirect('/invoices');
    }
    public function destroy(Request $request)
    {
        $id = $request->invoice_id;
        $invoices = invoices::withTrashed()->where('id' , $id)->first();
        $attachs = invoices_attachments::where('invoices_id' , $id)->first();
        Storage::disk('public_uploads')->deleteDirectory($attachs->invoices_number);
        $invoices->forceDelete();
        session()->flash('delete_invoice');
        return back();

    }
}
