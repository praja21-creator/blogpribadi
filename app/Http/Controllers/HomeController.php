<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Tampilkan daftar semua artikel (beranda).
     */
    public function index()
    {
        $posts = Post::with('category')->orderByDesc('id')->get();

        return view('home', compact('posts'));
    }

    /**
     * Tampilkan detail satu artikel.
     */
    public function show($id)
    {
        $post = Post::with('category')->findOrFail($id);

        return view('post', compact('post'));
    }
}
