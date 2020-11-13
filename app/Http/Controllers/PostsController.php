<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{

	/**
	 * Show list of blog posts
	 * 
	 * @return Response
	 */
	public function index()
	{
		return response()->json([
				'code' => 200,
				'message' => 'success',
				'posts' => Post::all()
			]);
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

			return response()->json([
					'code' => 404,
					'message' => 'Post not found.'
				], 404);

		}
		
		return response()->json([
				'message' => 'success',
				'post' => $post
			]);
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
			'title' => 'required|min:5',
			'body' => 'required|min:3',
		]);

		$post = Auth::user()->posts()->create($attributes);

		return response()->json([
				'message' => 'success',
				'post' => $post
			]);
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

		return response()->json([
				'message' => 'success',
				'post' => $post
			]);
	}

	/**
	* Delete the given blog post.
	*
	* @param int $id

	* @return Response
	*/
	public function destroy($postId)
	{
		try {
			
			$post = Post::findOrFail($postId)->delete();

		} catch (\Exception $e) {
			
			return response()->json([
					'code' => 422,
					'message' => 'Cannot process request.'
				], 422);

		}
	
		return response()->json([
				'code' => 202,
				'message' => 'success',
				'post' => $post
			]);
	}
}
