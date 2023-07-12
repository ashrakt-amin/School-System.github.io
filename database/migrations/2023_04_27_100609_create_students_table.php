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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->String('Date_Birth');
            $table->string('academic_year');
            $table->foreignId('gender_id')->constrained('genders')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('nationalitie_id')->constrained('nationalities')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('blood_id')->constrained('type_bloods')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('Grade_id')->constrained('grades')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('Classroom_id')->constrained('classrooms')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('section_id')->constrained('sections')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('parent_id')->constrained('my_parents')->cascadeOnUpdate()->cascadeOnDelete();
            $table->softDeletes();
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
        Schema::dropIfExists('students');
    }
};
