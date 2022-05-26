<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDataTypeSeoMetaKeywordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seos', function (Blueprint $table) {
            $table->longText('page_keywords')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seos', function (Blueprint $table) {
            $table->string('page_keywords')->change();
        });
    }
}
