<?php 
namespace Models;
use \Illuminate\Database\Eloquent\Model as Model;

class Request extends Model
{
	public $timestamps = false;
    protected $table = 'requests';
    protected $guarded = ['id'];
}