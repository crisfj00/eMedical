<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('patient_id',10);
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->string('doctor_id',9);
            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->text('consultation');
            $table->text('diagnosis');
            $table->boolean('state')->default(0); //0 if not responded 1 if yes
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
        Schema::dropIfExists('prescriptions');
    }
}
