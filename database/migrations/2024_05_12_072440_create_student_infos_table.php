<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_infos', function (Blueprint $table) {
            $table->id();
            $table->string('_name');
            $table->string('_email');
            $table->string('_mobile');
            $table->string('_district');
            $table->string('_location');
            $table->string('_eventdate');
            $table->tinyInteger('_paymentstatus')->nullable();
            $table->integer('_totalbill')->nullable();
            $table->string('_transactionid')->nullable();
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
        Schema::dropIfExists('student_infos');
    }
}
