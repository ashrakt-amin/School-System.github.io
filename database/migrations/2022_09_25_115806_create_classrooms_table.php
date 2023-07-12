<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassroomsTable extends Migration {

	public function up()
	{
		Schema::create('classrooms', function(Blueprint $table) {
			$table->id('id');
			$table->string('class_name');
			$table->bigInteger('grade_id')->unsigned();
			$table->timestamps();

		});
	}

	public function down()
	{
		Schema::drop('classrooms');
	}
}