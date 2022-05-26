<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnsIntoCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->boolean('declared_bankrupt')->after('utm_source')->nullable()->default(false);
            $table->boolean('bankrupt_petition')->after('declared_bankrupt')->nullable()->default(false);
            $table->boolean('individual_voluntary_arrangement')->after('bankrupt_petition')->nullable()->default(false);
            $table->boolean('individual_voluntary_arrangement_approved')->after('individual_voluntary_arrangement')->nullable()->default(false);
            $table->boolean('debt_relief_order')->after('individual_voluntary_arrangement_approved')->nullable()->default(false);
            $table->boolean('arrangement_like')->after('debt_relief_order')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['declared_bankrupt', 'bankrupt_petition', 'individual_voluntary_arrangement', 'individual_voluntary_arrangement_approved', 'debt_relief_order', 'arrangement_like']);
        });
    }
}
