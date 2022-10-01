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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('created_by');
            $table->float('total', 15, 3);
            $table->timestamp('paid_at')->nullable();
            $table->string('source');
            $table->longtext('remarks')->nullable();
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
        Schema::dropIfExists('invoices');
    }
};
