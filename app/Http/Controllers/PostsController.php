<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Response;

class PostsController extends Controller
{

	/**
	 * Show list of blog posts
	 * 
	 * @return Response
	 */
	public function index()
	{
		return response()->json(Post::all());
	}

	/**
	 * Show single blog post
	 * 
	 * @param int $postId
	 * 
	 * @return Response
	 */
	public function show($postId)
	{   
		try {

			$post = Post::findOrFail($postId);

		} catch (\Exception $e) {

			return response()->json(['message' => 'Post not found.'], 404);

		}
		
		return response()->json($post);
	}
}
