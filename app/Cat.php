<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
	protected $table = 'cat';
	protected $primaryKey = 'id_cat';
	public $timestamps = false;

}
