<?php

use App\Models\Post;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;

class ManagePostsTest extends TestCase
{
    use DatabaseMigrations;
    
    /**
     * @test
     */
    public function test_user_can_get_all_blog_posts()
    {
        $response = $this->call('GET', '/api/posts');
        
        $this->assertEquals(200, $response->status());
    }

    /** @test */
    public function a_user_can_get_single_blog_post()
    {
        $post = Post::factory()->create();
        
        $response = $this->call('GET', '/api/post/'.$post->id);
        $this->assertEquals(200, $response->status());
    }


}
