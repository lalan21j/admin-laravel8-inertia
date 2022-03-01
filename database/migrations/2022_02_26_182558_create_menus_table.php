<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('label', 30);
            $table->string('icon', 50)->nullable(true);
            $table->string('url', 100)->nullable(true);
            $table->boolean('parent_node')->nullable(true);
            $table->smallInteger('menu_id')->nullable(true);
            $table->boolean('is_menu')->nullable(true);
            $table->string('description', 150)->nullable(true);
            $table->timestamps();

            $table->foreign('menu_id')->references('id')->on('menus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
