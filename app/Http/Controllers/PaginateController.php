<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PaginateController extends Controller
{
    public function __invoke()
    {
        $posts = Post::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('home', ['posts' => $posts]);
    }
}
