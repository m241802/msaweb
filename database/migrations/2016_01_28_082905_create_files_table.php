<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::create('files', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('slug')->unique();
            $table->string('size')->nullable();
            $table->string('type')->nullable();
            $table->text('destinationPath')->nullable();
            $table->text('excerpt')->nullable();
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
		Schema::drop('files');
	}

}
