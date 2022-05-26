<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSiteTopbarBgColorSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'site_top_bar_bg_color')){
                $table->string('site_top_bar_bg_color')->default('63E175')->after('description_two');
                $table->mediumText('header_top_title')->change();

            };
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['site_top_bar_bg_color']);
            $table->string('header_top_title')->change();
        });
    }
}
