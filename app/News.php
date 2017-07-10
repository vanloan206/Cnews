<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    protected $table 		= 'news';
    protected $primaryKey 	= 'id_news';
    public $timestamps 		= false;

    public static function getList() {
    	return DB::table('news as n')->join('cat as c', 'n.id_cat', '=', 'c.id_cat')
    			->join('users as u', 'n.id_user', '=', 'u.id')
    			->orderBy('id_news', 'DESC')
    			->select('*', 'n.name as name', 'c.name as cname')
    			->paginate(getenv('ROW_COUNT'));
    }
}
