<?php


use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Testing\DatabaseMigrations;

class PostDbTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function authenticated_user_can_create_blog_post()
    {
        $user = User::factory()->create();

        $this->signIn($user);

        $post = $user->posts()->create([
            'title' => 'Naslov',
            'body' => 'Post body'
        ]);

        $response = $this->call('POST', '/api/posts', $post->toArray());

        $this->seeInDatabase('posts', [
                'id' => $post->id,
                'title' => 'Naslov',
                'body' => 'Post body'
            ]);

        $this->assertEquals(200, $response->status());
    }

}