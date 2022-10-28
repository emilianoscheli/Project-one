<?php

namespace App;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Productos extends Eloquent
{
	protected $connection = 'mongodb';
	protected $collection = 'productos';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'title','description','price','status'
    ];

        // Relación
    public function user(){
    	return $this->belongsTo('App\User', 'user_id');
}
}