<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->integer('current_address_id')->nullable();
            $table->string('title', 20)->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('middle_names')->nullable();
            $table->date('dob')->nullable();
            $table->boolean('is_loan_preview_name')->default(false)->nullable();
            $table->string('previous_first_name')->nullable();
            $table->string('previous_last_name')->nullable();
            $table->boolean('is_loan_preview_address')->default(false)->nullable();
            $table->string('telephone_home', 11)->nullable();
            $table->string('telephone_mobile', 11)->nullable();
            $table->string('telephone_work', 11)->nullable();
            $table->string('email', 191);
            $table->boolean('in_iva')->nullable();
            $table->boolean('in_dmp')->nullable();
            $table->boolean('should_be_aware')->nullable();
            $table->datetime('esigned_ts')->nullable();
            $table->datetime('potential_submit_ts')->nullable();
            $table->datetime('full_submit_ts')->nullable();
            $table->string('resume_token')->unique();
            $table->boolean('optin_email')->default(false);
            $table->boolean('optin_telephone')->default(false);
            $table->boolean('optin_sms')->default(false);
            $table->boolean('optin_post')->default(false);
            $table->string('utm_source')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('customers');
    }
}
