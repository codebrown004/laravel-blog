<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $fillable = [
        'title', 'body', 'cover_image',
  ];

   public function user()
   {

   		return $this->belongsTo('App\User');
   
   }

   public function comments()
   {

		return $this->hasMany(Comment::class); //eq App\Comment
  
   }




   public function addComment($body)
    {
    	$this->comments()->create(compact('body')); //it automatically populate post_id because of relation. $this->comments() return all data comments data.

    	// Comment::create([
    	// 	'body'    => $body,
    	// 	'post_id' => $this->id
    	// ]);

    }
}
