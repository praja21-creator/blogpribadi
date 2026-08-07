<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Tampilkan daftar artikel.
     */
    public function index()
    {
        $posts = Post::with('category')->orderByDesc('id')->get();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Tampilkan form tambah artikel.
     */
    public function create()
    {
        $categories = Category::orderByDesc('id')->get();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Simpan artikel baru.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'content' => ['required', 'string'],
            'category_id' => ['nullable', 'exists:categories,id'],
        ]);

        Post::create($data + ['created_at' => now()]);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Artikel berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit artikel.
     */
    public function edit(Post $post)
    {
        $categories = Category::orderByDesc('id')->get();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Perbarui artikel.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'content' => ['required', 'string'],
            'category_id' => ['nullable', 'exists:categories,id'],
        ]);

        $post->update($data);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Hapus artikel.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }
}
