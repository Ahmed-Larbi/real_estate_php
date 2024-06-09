<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return response()->json(Post::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'size' => 'required|string|max:50',
            'name' => 'required|string|max:50',
            'address' => 'required|string|max:100',
            'image_url' => 'required|url|max:200',
            'phone_number' => 'required|string|max:20',
            'sell_or_rent' => 'required|string|in:sell,rent',
            'account_id' => 'required|exists:accounts,id'
        ]);

        $post = Post::create($request->all());

        return response()->json($post, 201);
    }

    public function show(Post $post)
    {
        return response()->json($post, 200);
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'name' => 'required',
            'sell_or_rent' => 'required',
            'account_id' => 'required|exists:accounts,id'
        ]);

        $post->update($request->all());
        return response()->json($post, 200);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Assuming 'name', 'address', and 'size' are the fields you want to search in
        $posts = Post::where('name', 'LIKE', "%{$query}%")
            ->orWhere('address', 'LIKE', "%{$query}%")
            ->orWhere('size', 'LIKE', "%{$query}%")
            ->get();

        return response()->json($posts);
    }



    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(null, 204);
    }
}

