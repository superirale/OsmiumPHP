<?php 
namespace Models;
use \Illuminate\Database\Eloquent\Model as Model;

class Artist extends Model
{
	public $timestamps = false;
    protected $table = 'artists';
    protected $guarded = ['id'];
}