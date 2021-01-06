<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model {

	protected $table = 'file_history';
	protected $primaryKey = 'file_id';
	protected $fillable = ['file_name', 'file_path'];
}
