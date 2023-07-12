<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsTable extends Migration {

	public function up()
	{
		Schema::create('sections', function(Blueprint $table) {
			$table->id('id');
			$table->string('name');
			$table->string('status');
			$table->bigInteger('grade_id')->unsigned();
			$table->bigInteger('class_id')->unsigned();
			$table->timestamps();

		});
	}

	public function down()
	{
		Schema::drop('sections');
	}
}