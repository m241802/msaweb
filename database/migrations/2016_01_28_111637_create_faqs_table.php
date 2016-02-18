<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaqsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('faqs', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->text('content')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->boolean('published')->default(false);
            $table->timestamps();
        });
        Schema::create('faqs_file', function(Blueprint $table)
        {
            $table->integer('id_file');
            $table->integer('id_faqs');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('faqs');
		Schema::drop('faqs_file');
	}

}
