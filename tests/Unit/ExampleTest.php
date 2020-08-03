<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Post;

class ExampleTest extends TestCase
{

	use RefreshDatabase; //undoes everything db transactions.
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        // $this->assertTrue(true);
        // $this->get('/')->assertSee('Posts');

        $first = factory(Post::class)->create();
        $second = factory(Post::class)->create([
        	'created_at' => \Carbon\Carbon::now()->subMonth()
        ]);

        $post = Post::archives();

        // $this->assertCount(2, $post);
        // dd($post);

        $this->assertEquals([
        	[
        		'year' => $first->created_at->format('Y'),
        		'month' => $first->created_at->format('F'),
        		'published' => 1
			],
			[
        		'year' => $second->created_at->format('Y'),
        		'month' => $second->created_at->format('F'),
        		'published' => 1
			]        
        ],$post);
    }
}
