<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;

class ManagePostsTest extends TestCase
{
    use DatabaseMigrations;
    
    /**
     * @test
     */
    public function authenticated_user_can_get_all_blog_posts()
    {
        $this->signIn();
        $response = $this->call('GET', '/api/posts');

        $this->assertEquals(200, $response->status());
    }

    /**
     * @test
     */
    public function unauthenticated_user_may_not_get_all_blog_posts()
    {
        $response = $this->call('GET', '/api/posts');

        $this->assertEquals(401, $response->status());
    }

    /** @test */
    public function authenticated_user_can_get_single_blog_post()
    {
        $this->signIn();

        $post = Post::factory()->create([
                'title' => 'Test',
                'body' => 'Body',
            ]);
        
        $this->json('GET', '/api/post/'.$post->id)
            ->seeJson(['message' => 'success']);

    }

    /** @test */
    public function unauthenticated_user_may_not_see_single_blog_post()
    {
        $post = Post::factory()->create([
                'title' => 'Naslov',
                'body' => 'Body',
            ]);
        
        $response = $this->call('GET', '/api/post/'.$post->id);

        $this->assertEquals(401, $response->status());
    }

    /** @test */
    public function authenticated_user_can_update_a_blog_post()
    {
        $this->signIn();

        $originalPost = Post::factory()->create([
                'title' => 'Naslov',
                'body' => 'Body',
            ]);
        
        $this->json('GET', '/api/post/'.$originalPost->id)
            ->seeJson([
                'title' => 'Naslov'
            ]);

        $updatedPost = [
            'id' => $originalPost->id,
            'title' => 'Updated',
            'body' => 'Body',
        ];

        $this->CALL('PUT', '/api/post/', $updatedPost);

        $this->json('GET', '/api/post/'.$originalPost->id)
            ->seeJson([
                'title' => 'Updated'
            ]);
    }

    /** @test */
    public function unauthenticated_user_may_not_update_a_blog_post()
    {
        $originalPost = Post::factory()->create([
            'title' => 'Naslov',
            'body' => 'Body',
        ]);

        $updatedPost = [
            'id' => $originalPost->id,
            'title' => 'Updated',
            'body' => 'Body',
        ];

        $response = $this->CALL('PUT', '/api/post/', $updatedPost);

        $this->assertEquals(401, $response->status());

    }
}
