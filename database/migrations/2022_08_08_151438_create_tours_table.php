<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('type_id');
            $table->integer('destination_id');
            $table->string('title');
            $table->string('slug');
            $table->string('image');
            $table->double('price')->nullable()->default(0);
            $table->string('duration', 100);
            $table->text('overview')->nullable();
            $table->text('include')->nullable();
            $table->text('departure')->nullable();
            $table->text('map')->nullable();
            $table->string('image_360')->nullable();
            $table->string('video')->nullable();
            $table->text('additional')->nullable();
            $table->tinyInteger('is_interested')->nullable()->default(1)->comment('1-normal, 2-interested');
            $table->tinyInteger('is_culture')->nullable()->default(1)->comment('1-normal, 2-culture');
            $table->tinyInteger('trending')->nullable()->default(1)->comment('1-show, 2-hide');
            $table->tinyInteger('status')->nullable()->default(1)->comment('1-show, 2-hide');
            $table->string('meta_title');
            $table->text('meta_description');
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
        Schema::dropIfExists('tours');
    }
}
