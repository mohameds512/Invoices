<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices_attachments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('file_name',999);
            $table->string('invoices_number', 50);
            $table->string('created_by',999);
            $table->unsignedBigInteger('invoices_id')->nullable();
            $table->timestamps();

            $table->foreign('invoices_id')->references('id')->on('invoices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices_attachments');
    }
}
