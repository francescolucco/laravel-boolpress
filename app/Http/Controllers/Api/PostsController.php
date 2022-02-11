<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(){

        $posts = Post::with(['category', 'tags'])->paginate(5);

        return response()->json($posts);
    }


    // 10 generazione json del singolo post in base allo slug
    public function show($slug){

        $post = Post::where('slug', $slug)->with(['category', 'tags'])->first();
        
        return response()->json($post);
    }
}
