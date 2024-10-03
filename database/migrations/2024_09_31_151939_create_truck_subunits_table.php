<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('truck_subunits', function (Blueprint $table) {
            $table->increments('id');
            // $table->unsignedBigInteger('truck_id');
            $table->string('main_truck');
            $table->string('subunit');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->timestamps();
            // $table->foreign('truck_id')
            //     ->references('truck_subunit_id')
            //     ->on('trucks')
            //     ->onDelete('cascade')
            //     ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('truck_subunits');
    }
};