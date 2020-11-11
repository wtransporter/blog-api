<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
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

	/**
	 * Store given blog post
	 * 
	 * @param Request $request
	 * 
	 * @return Response
	 */
	public function store(Request $request)
	{
		$attributes = $this->validate($request,[
			'user_id' => 'required|integer|exists:users,id',
			'title' => 'required|min:5',
			'body' => 'required|min:3',
		]);

		$post = Post::create($attributes);

		return response()->json($post);
	}

	/**
	 * Update given blog post
	 * 
	 * @param Request $request
	 */
	public function update(Request $request)
	{
		$attributes = $this->validate($request,[
			'id' => 'required|integer|exists:posts',
			'title' => 'required|min:5',
			'body' => 'required|min:3',
		]);

		$post = Post::findOrFail($request->input('id'));
		$post->update($attributes);

		return response()->json($post);
	}
}
