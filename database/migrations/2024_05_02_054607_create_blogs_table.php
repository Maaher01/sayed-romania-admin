<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('_title')->nullable();
            $table->string('_subtitle')->nullable();
            $table->string('_slug');
            $table->string('_image')->nullable();
            $table->longText('_description')->nullable();
            $table->string('_tags', 500)->nullable();
            $table->timestamp('_date')->nullable();
            $table->tinyInteger('_status');
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
        Schema::dropIfExists('blogs');
    }
}
