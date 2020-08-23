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
            $table->bigIncrements('id');
            $table->bigInteger('menu_id')->unsigned();
            $table->bigInteger('parent_id')->unsigned()->default(0);
            $table->bigInteger('type_id')->unsigned();
            $table->bigInteger('position')->unsigned();
            $table->string('label');
            $table->string('url');
            $table->json('attributes')->nullable();
            $table->boolean('external')->default(0);
            $table->timestamps();
            $table->foreign('menu_id')->references('id')->on('menus');
            $table->foreign('type_id')->references('id')->on('menu_item_types');
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
