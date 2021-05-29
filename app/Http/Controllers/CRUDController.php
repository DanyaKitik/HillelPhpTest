<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CRUDController extends Controller
{
    /** Delete */
    public function delete($id)
    {
        DB::table('post_tag')->where('post_id', $id)->delete();
        Post::where('id', $id)->delete();
        return redirect('/');
    }

    /** Update */
    public function find($id = null)
    {
        $post = Post::find($id);
        $post_tag = DB::table('post_tag')->where('post_id', $id)->select()->pluck('tag_id')->toArray();
        if (!auth()) {
            return redirect()->route('home');
        }
        return view('update', ['post' => $post, 'tags' => Tag::all(), 'post_tag' => $post_tag]);
    }

    public function update($id = null)
    {
        $post = Post::find($id);
        $post->title = request()->get('title');
        $post->description = request()->get('description');
        $post->save();
        DB::table('post_tag')->where('post_id', $id)->delete();
        if (\request()->get('tags') !== null) {
            foreach (\request()->get('tags') as $tag) {
                DB::table('post_tag')->insert(['post_id' => $post->id, 'tag_id' => $tag]);
            }
        }
        return redirect('/');
    }

    /** Create */
    public function form()
    {
        return view('create', ['tags' => Tag::all()]);
    }

    public function create()
    {
        $post = new Post();
        $post->user_id = auth()->user()->id;
        $post->title = request()->get('title');
        $post->description = request()->get('description');
        $post->save();
        if (\request()->get('tags') !== null) {
            foreach (\request()->get('tags') as $tag) {
                DB::table('post_tag')->insert(['post_id' => $post->id, 'tag_id' => $tag]);
            }
        }
        return redirect('/');
    }
}
