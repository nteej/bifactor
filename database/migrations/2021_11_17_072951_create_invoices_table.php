<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->uuid('uuid')->unique();
            $table->integer('invoice_no');
            $table->date('due_date');
            $table->foreignId('customer_id')->index();
            $table->foreignId('company_id')->index();
            $table->decimal('total_amount');
            $table->json('info')->nullable();
            $table->enum('state',['init','open','paid','closed','overdue','write-off'])->default('init');
            $table->boolean('status')->default(0);
            $table->float('factoring')->default(10)->comment('Factoring ratio %:default 10%');
            $table->timestamps();
            $table->softDeletes();
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
