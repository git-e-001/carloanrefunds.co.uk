<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->cascadeOnDelete();
            $table->foreignId('lender_id')->nullable()->constrained('lenders')->cascadeOnDelete();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->string('agreement_id')->nullable();
            $table->string('lender_name')->nullable();
            $table->date('date')->nullable();
            $table->decimal('capital')->nullable();
            $table->boolean('previously_claimed')->nullable();
            $table->boolean('single_repayment')->nullable();
            $table->integer('rollovers')->unsigned();
            $table->boolean('missed_payment_rollover_offered')->nullable();
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
        Schema::dropIfExists('loans');
    }
}
