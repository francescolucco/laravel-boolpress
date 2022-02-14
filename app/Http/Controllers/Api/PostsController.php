<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(){

        $posts = Post::with(['category', 'tags'])->paginate(5);
        $tags = Tag::all();
        $categories = Category::all();

        return response()->json(compact('posts', 'tags', 'categories'));
    }


    // 10 generazione json del singolo post in base allo slug
    public function show($slug){

        $post = Post::where('slug', $slug)->with(['category', 'tags'])->first();
        
        return response()->json($post);
    }
    
    // chiamo questa funzione getPostsByCategory perchè voglio che sia chiaro che prendo i post a partire dalla categorie. Cioè parto da una categoria e prendo i post che hanno quella categoria
    public function getPostsByCategory($slug_category){

        $category = Category::where('slug', $slug_category)->with('posts.tags')->first();

        $success = true;
        $error = '';

        if(!$category){
            $success = false;
            $error = 'Il post non esiste';
        }elseif($category && count($category['posts'])  === 0){
            $success = false;
            $error = 'Non esistono post per questa categoria';
        }

        return response()->json(compact( 'success', 'category', 'error'));

    }


    public function getPostsByTags($slug_tag){

        $tag = Tag::where('slug', $slug_tag)->with('posts.category')->first();

        $success = true;
        $error = '';

        if(!$tag){
            $success = false;
            $error = 'Il tag non esiste';
        }elseif($tag && count($tag['posts'])  === 0){
            $success = false;
            $error = 'Non esistono post per questo tag';
        }

        return response()->json(compact( 'success', 'tag', 'error'));

    }
}
