<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestsController extends Controller
{
    public function testing()
    {
    	// $content = Storage::url('Gj5HSfJrp9QkQ14RuKc4rQYk8dh6MUm2TByFdvbI.png');
    	// $mod = Storage::lastModified($contents);
    	// $exists = Storage::disk('local')->exists('/cover-images/OfLmUwTDKjWcjYdq1BuUs1O0yci2BHMikQzKFfZZ.png');
    	// echo '<img src="'.$contents.'"/>';
    	// dd($exists);
    	// return content;
    	// $visibility = Storage::setVisibility('/cover-images/OfLmUwTDKjWcjYdq1BuUs1O0yci2BHMikQzKFfZZ.png', 'public');
    	// $final = Storage::getVisibility('/cover-images/OfLmUwTDKjWcjYdq1BuUs1O0yci2BHMikQzKFfZZ.png');

		// $files = Storage::allFiles('public');
  //   	return $files;
        return bcrypt('testing');
    }
}
