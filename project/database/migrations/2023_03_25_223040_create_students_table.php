<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code', 50)->nullable(true);
            $table->string('name', 50)->nullable(true);
            $table->uuid('faculties_id')->index('faculties_id');
            $table->string('description', 191)->nullable();
            $table->enum('status', ['Y', 'N'])->nullable(true);
            $table->timestamps();

            // Foreign keys
            $table->foreign('faculties_id')->references('id')->on('faculties')
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
        Schema::dropIfExists('students');
    }
}
