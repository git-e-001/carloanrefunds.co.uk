<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('menu item name');
            $table->string('slug')->nullable();
            $table->string('module')->nullable();
            $table->string('icon')->nullable();
            $table->string('type')->nullable();
            $table->string('value')->nullable();
            $table->string('target')->nullable();
            $table->string('active_resolver')->nullable();
            $table->boolean('status')->default(false);
            $table->integer('order')->nullable();
            $table->foreignId('menu_id')->constrained('menus')->onDelete('cascade');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('menu_items');
    }
}
