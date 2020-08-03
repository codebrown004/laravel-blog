<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function scopeFilter($query, $ar)
    {
      if($month = $ar['month'])
      {
          $query->whereMonth('created_at', Carbon::parse($month)->month);
      }

      if($year = $ar['year'])
      {
          $query->whereYear('created_at', Carbon::parse($year)->year);
      }
    }
}
