<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFcOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fc_orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('order_no')->nullable();
            $table->date('order_date')->nullable();
            $table->decimal('debit_total')->nullable();
            $table->foreignId('company_id')->index();
            $table->foreignId('invoice_id')->index();
            $table->foreignId('user_id')->index();
            $table->json('info')->nullable();
            $table->enum('state',['init','open','closed','overdue'])->default('init');
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('fc_orders');
    }
}
