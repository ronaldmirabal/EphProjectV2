<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Inventories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function(Blueprint $table){
            $table->engine="InnoDB";
            $table->bigIncrements('id');
            $table->integer('stock')->nullable()->default(1);
            $table->string('model', 100)->nullable();
            $table->string('serial', 20)->nullable();
            $table->string('description')->nullable();
            $table->string('noplaca', 20)->nullable();
            $table->string('color', 20)->nullable();
            $table->string('size', 20)->nullable();
            $table->boolean('active')->nullable()->default(true);
            $table->bigInteger('people_id')->unsigned();
            $table->bigInteger('brand_id')->unsigned();
            $table->bigInteger('area_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('type_product_id')->unsigned();
            $table->timestamps();


            $table->foreign('people_id')->references('id')->on('peoples')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('type_product_id')->references('id')->on('type_products')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
