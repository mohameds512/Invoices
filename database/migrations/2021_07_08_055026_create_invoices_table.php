<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoices_number');
            $table->date('invoices_date');
            $table->date('due_date');   // تاريخ الاستحقاق
            $table->string('product');
            $table->unsignedBigInteger('section_id');
            $table->decimal('Amount_collection',8,2)->nullable();
            $table->decimal('Amount_commission',8,2);
            $table->decimal('discount');
            $table->string('rate_vat');  // نسبة الضريبة
            $table->decimal('value_vat', 8 , 2 );
            $table->decimal('total', 8 , 2 );
            $table->string('status',50);
            $table->integer('value_status');
            $table->text('note')->nullable();
            $table->string('user');
            $table->softDeletes();   //  بتأرشف البيانات الممسوحه ->create deleted_at
            $table->timestamps();

            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
