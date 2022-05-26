<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageButtonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_buttons', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->string('btn_text')->nullable();
            $table->string('btn_text_color')->nullable();
            $table->mediumText('btn_link')->nullable();
            $table->string('btn_border_color')->nullable();
            $table->string('btn_bg_color')->nullable();
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
        Schema::dropIfExists('page_buttons');
    }
}
