<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Loans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function(Blueprint $table){
            $table->engine="InnoDB";
            $table->bigIncrements('id');
            $table->text('description')->nullable();
            $table->boolean('active')->nullable()->default(true);
            $table->boolean('condition')->nullable()->default(false);
            $table->bigInteger('people_id')->unsigned();
            $table->foreign('people_id')->references('id')->on('peoples')->onDelete('cascade');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->date('estimated_date');
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
