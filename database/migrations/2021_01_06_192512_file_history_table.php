<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FileHistoryTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('file_history', function (Blueprint $table) {
			$table->increments('file_id');
			$table->string('file_name', 255);
			$table->string('file_path', 255);
			$table->string('file_type', 5);
			$table->string('file_size', 10);
			$table->tinyInteger('status', 1)->default(1);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('file_history');
	}
}
