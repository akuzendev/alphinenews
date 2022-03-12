<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('byuserid');
            $table->longText('content');
            $table->dateTime('date');
            $table->unsignedInteger('onarticleid');
            $table->integer('status');
            $table->unsignedInteger('authorizedbyid')->nullable()->unsigned();
            $table->dateTime('authorizeddate')->nullable();

            $table->foreign('byuserid')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('onarticleid')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('authorizedbyid')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
