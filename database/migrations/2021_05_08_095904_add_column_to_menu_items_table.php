<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->string('text_color')->nullable();
            $table->string('bg_color')->nullable();
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->string('footer_top_section_bg_color')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropColumn('text_color');
            $table->dropColumn('bg_color');
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('footer_top_section_bg_color');
        });
    }
}
