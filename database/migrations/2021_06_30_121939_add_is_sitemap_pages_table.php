<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsSitemapPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->boolean('is_sitemap')->default(false)->nullable()
            ->after('is_home');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('is_sitemap');
        });
    }
}
