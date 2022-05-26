<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerLenderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_lender', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->cascadeOnDelete();
            $table->foreignId('lender_id')->nullable()->constrained('lenders')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_lender');
    }
}
