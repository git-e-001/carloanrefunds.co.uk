<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('page_title')->nullable();
            $table->longText('page_description')->nullable();
            $table->string('page_keywords')->nullable();
            $table->string('og_title')->nullable();
            $table->string('og_type')->nullable();
            $table->string('og_url')->nullable();
            $table->longText('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('twitter_title')->nullable();
            $table->string('twitter_site')->nullable();
            $table->string('twitter_card')->nullable();
            $table->longText('twitter_description')->nullable();
            $table->string('twitter_image')->nullable();
            $table->longText('page_scripts')->nullable();
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
        Schema::dropIfExists('seos');
    }
}
