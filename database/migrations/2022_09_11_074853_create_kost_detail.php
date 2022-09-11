<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKostDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kost_detail', function (Blueprint $table) {
            $table->id('id');
            $table->integer('kost_id');
            $table->string('name')->nullable();
            $table->string('room_type')->nullable();
            $table->text('description')->nullable();
            $table->text('room_spec')->nullable();
            $table->text('room_facility')->nullable();
            $table->text('bathroom_facility')->nullable();
            $table->text('others_facility')->nullable();
            $table->text('rules')->nullable();
            $table->integer('price')->nullable();
            $table->integer('promo_price')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('kost_detail');
    }
}
