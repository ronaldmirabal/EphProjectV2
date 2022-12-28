<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemoveInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remove-inventories', function(Blueprint $table){
            $table->engine="InnoDB";
            $table->bigIncrements('id');
            $table->string('description')->nullable();
            $table->bigInteger('inventory_id')->unsigned();
            $table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('cascade');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('date');
            $table->bigInteger('withdrawallist_id')->unsigned();
            $table->foreign('withdrawallist_id')->references('id')->on('withdrawal-list')->onDelete('cascade');
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
        //
    }
}
