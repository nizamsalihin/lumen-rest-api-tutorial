<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return Post::all();
    }
    public function store(Request $request)
    {
        try {
            $post = Post::create(
                [
                    'title' => $request->title,
                    'body' => $request->body,
                ]
            );

            if ($post)
                return response()->json([
                    'status' => 'success',
                    'message' => 'Post created Succesfully',
                ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->title = $request->title;
            $post->body = $request->body;
            $post->save();

            if ($post->wasChanged())
                return response()->json(['status' => 'success', 'message' => "post updated"]); //kalau status codenya 204, postman otoatis kira itu gk ad konten

            return response()->json(['status' => 'none', 'message' => 'please provide new data for the post in order to update old one']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);
            if ($post->delete())
                return response()->json(['status' => 'error', 'message' => 'post deleted sucessfully']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
