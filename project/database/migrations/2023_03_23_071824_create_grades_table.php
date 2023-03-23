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
        Schema::create('grades', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('students_id')->index('students_id');
            $table->integer('quiz')->nullable();
            $table->integer('tugas')->nullable();
            $table->integer('absensi')->nullable();
            $table->integer('praktek')->nullable();
            $table->integer('uas')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('students_id')->references('id')->on('students')
                ->onDelete('cascade')
                ->onUpdate('cascade');            
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grades');
    }
};
