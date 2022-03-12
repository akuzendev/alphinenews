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
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title');
            $table->string('subtitle');
            $table->integer('catergory');
            $table->integer('status');
            $table->longText('thumbnail');
            $table->unsignedInteger('byuserid')->unsigned();
            $table->longText('content');
            $table->dateTime('date');
            $table->unsignedInteger('authorizedbyid')->nullable()->unsigned();
            $table->dateTime('authorizeddate')->nullable();

            $table->foreign('byuserid')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('authorizedbyid')->references('id')->on('users')->onDelete('cascade');
            //$table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
