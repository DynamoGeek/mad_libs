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
        Schema::create('mad_lib_instance_parts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mad_lib_instance_id');
            $table->foreign('mad_lib_instance_id')->references('id')->on('mad_lib_instances');
            $table->unsignedBigInteger('mad_lib_part_id');
            $table->foreign('mad_lib_part_id')->references('id')->on('mad_lib_parts');
            $table->string('content')->nullable();
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
        Schema::dropIfExists('mad_lib_instance_parts');
    }
};
