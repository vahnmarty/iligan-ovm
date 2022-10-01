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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('user_id');
            $table->string('virtual_id')->nullable();
            $table->string('official_id')->nullable();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('name_extension')->nullable();
            $table->string('nickname')->nullable();
            $table->unsignedBigInteger('barangay_id');
            $table->string('purok');
            $table->string('street_address')->nullable();
            $table->string('cellphone');
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->date('date_of_birth');
            $table->string('place_of_birth')->nullable();
            $table->string('religion')->nullable();
            $table->string('sex')->nullable();
            $table->string('civil_status');
            $table->string('primary_education', 500)->nullable();
            $table->string('secondary_education', 500)->nullable();
            $table->string('tertiary_education', 500)->nullable();
            $table->string('occupation', 500)->nullable();
            $table->string('company', 500)->nullable();
            $table->string('emergency_contact_person')->nullable();
            $table->string('emergency_contact_number')->nullable();
            $table->string('receiving_person')->nullable();
            $table->date('date_registered')->nullable();
            $table->unsignedBigInteger('created_by');
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
        Schema::dropIfExists('people');
    }
};
