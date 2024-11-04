<?php

namespace App\Http\Controllers;

use App\Models\Post;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller implements HasMiddleware
{
    // public static function middleware()
    // {
    //     return [
    //         new Middleware('auth:sanctum', except: ['index', 'show'])
    //     ];
    // }

    // /**
    //  * Display a listing of the resource.
    //  */
    // public function index()
    // {
    //     $posts = Post::with('user')->get();

    //     return Post::all();
    // }
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', except: ['index', 'show'])
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all posts with associated user data
        $posts = Post::with('user')->get();
        return Post::with('user')->latest()->get();

        return Post::all();
        return $posts;
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     if (!auth()->user()->can('create post')) {
    //         abort(403, 'Unauthorized');
    //     }
    //  $fields= $request->validate([
    //     'title' => 'required|string|max:255',
    //     'description' => 'required',
    //     'price' => 'required|numeric',
    //     'location' => 'required|string|max:255',
    //     'area' => 'required|numeric',
    //     'type' => 'required|in:Residential,Agricultural',
    //     'image_url' => 'nullable|string|max:255',
    //     'user_id' => 'required|exists:users,id',
    //     'status' => 'in:active,inactive,sold',
    //     'category_id' => 'required|exists:categories,id',
    //     ]);
    //     $post = $request->user()->posts()->create($fields);
    //     // return  $post;
    //     return ['post' => $post, 'user' => $post->user];

    // }
    public function store(Request $request)
    {
        if (!auth()->user()->can('create post')) {
            abort(403, 'Unauthorized');
        }
    
        // $fields = $request->validate([
        //     'title' => 'required|string|max:255',
        //     'description' => 'required|string',
        //     'price' => 'required|numeric',
        //     'location' => 'required|string|max:255',
        //     'area' => 'required|numeric',
        //     'type' => 'required|in:Residential,Agricultural',
        //     'image_url' => 'nullable|string|max:255',
        //     'status' => 'in:active,inactive,sold',
        //     'category_id' => 'required|exists:categories,id',
        // ]);
        $fields = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'location' => 'required|string|max:255',
            'area' => 'required|numeric',
            'type' => 'required|in:Residential,Agricultural',
            'image_url' => 'nullable|string|max:255',
            'status' => 'in:active,inactive,sold',
            'category_id' => 'required|exists:categories,id',
            'type_of_property' => 'required|string|max:255', // 
            'habitable_area' => 'required|numeric',           // 
            'in_city' => 'required|boolean',                  // 
            'fees_included' => 'required|boolean',            // 
            'reference_number' => 'required|string|max:255',  // 
        ]);
    
        $fields['user_id'] = auth()->id(); // Automatically set user_id to the authenticated user's ID
    
        $post = Post::create($fields);
    
        return ['post' => $post, 'user' => $post->user];
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
         return ['post' => $post, 'user' => $post->user];
        return $post;
    }
    public function update(Request $request, Post $post)
    {
        if (!auth()->user()->can('edit post')) {
            abort(403, 'Unauthorized');
        }
        Gate::authorize('modify', $post);

        // $fields = $request->validate([
        //     'title' => 'sometimes|required|string|max:255',
        //     'description' => 'required',
        //     'price' => 'sometimes|required|numeric',
        //     'location' => 'sometimes|required|string|max:255',
        //     'area' => 'sometimes|required|numeric',
        //     'type' => 'sometimes|required|in:Residential,Agricultural',
        //     'image_url' => 'nullable|string|max:255',
        //     'status' => 'in:active,inactive,sold',
        //     'type_of_property' => 'sometimes|required|string|max:255', // N
        //     'habitable_area' => 'sometimes|required|numeric',          // N
        //     'in_city' => 'sometimes|required|boolean',                 // N
        //     'fees_included' => 'sometimes|required|boolean',           // N
        //     'reference_number' => 'sometimes|required|string|max:255', // N
        // ]);
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            // 'price'=> $request->price,
            'image'=> $request->image         

        ]);
        // $post->update($title);
        // $post->update($description);
        // $post->update($fields);
        return  $post;
        
    }
    public function destroy(Post $post)
    {
        if (!auth()->user()->can('delete post')) {
            abort(403, 'Unauthorized');
        }
        Gate::authorize('modify', $post);
        $post->delete();
        return['message' =>'the ost was delet' ];
    }
}