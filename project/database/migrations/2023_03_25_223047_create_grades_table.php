<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration
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
            $table->uuid('student_id')->index('student_id');
            $table->uuid('courses_id')->index('courses_id');
            $table->integer('quiz')->nullable();
            $table->integer('assignment')->nullable();
            $table->integer('attendance')->nullable();
            $table->integer('practice')->nullable();
            $table->integer('final_exam')->nullable();
            $table->integer('total_score')->nullable();
            $table->string('grade')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('student_id')->references('id')->on('students')
                ->onDelete('cascade')
                ->onUpdate('cascade');     
            $table->foreign('courses_id')->references('id')->on('courses')
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
}
