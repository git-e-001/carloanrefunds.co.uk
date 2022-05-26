<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->nullable()->constrained()->cascadeOnDelete();
            $table->longText('body')->nullable();
            $table->string('bg_color')->nullable();
            $table->string('bg_image')->nullable();
            $table->integer('order')->nullable();
            $table->boolean('status')->default(true)->nullable();
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
        Schema::dropIfExists('page_contents');
    }
}
