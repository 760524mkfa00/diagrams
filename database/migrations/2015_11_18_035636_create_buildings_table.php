<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('building_name');
            $table->string('street');
            $table->string('town', 40);
            $table->string('postal', 10);
            $table->string('province', 40);
            $table->string('country', 40);
            $table->string('building_type', 40);
            $table->text('description');
            $table->string('telephone');
            $table->timestamps();
        });

        Schema::create('floors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('label')->nullable();
            $table->timestamps();
        });

        Schema::create('types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('label')->nullable();
            $table->timestamps();
        });

        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('building_id')->unsigned();
            $table->foreign('building_id')->references('id')->on('buildings')->onDelete('cascade');
            $table->integer('floor_id')->unsigned();
            $table->foreign('floor_id')->references('id')->on('floors')->onDelete('cascade');
            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
            $table->string('name', 40);
            $table->string('path');
            $table->string('filename', 40);
            $table->string('file_type');
            $table->timestamps();
        });

        Schema::create('pictures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('building_id')->unsigned();
            $table->foreign('building_id')->references('id')->on('buildings')->onDelete('cascade');
            $table->string('name');
            $table->string('path');
            $table->string('thumbnail_path');
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
        Schema::drop('plans');
        Schema::drop('pictures');
        Schema::drop('floors');
        Schema::drop('buildings');
    }
}
