<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard admin dengan statistik.
     */
    public function index()
    {
        $postsCount = Post::count();
        $categoriesCount = Category::count();

        return view('admin.dashboard', compact('postsCount', 'categoriesCount'));
    }
}
