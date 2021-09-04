<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class invoices extends Model
{
    use softDeletes;
    protected $guarded = [];


    public function section()
    {
        return $this->belongsTo(sections::class);
    }

    public function invoice_detail()
    {
        return $this->belongsTo(invoices_details::class);
    }
}
