<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Annotations\PostsCrudAnnotationController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function __construct()
    {
        /**
         *@var PostsCrudAnnotationController
         *@return JsonResponse
         */
    }
    public function index()
    {

        $Posts =Cache::rememberForever('posts',function () {
            return Post::all();
        });
        return response()->json([
            "message" => "Here is the list of posts",
            "Post" => $Posts
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "errors" => $validator->errors()->toJson()

            ], 422);
        }
        $Post = Post::create($request->all());
        Cache::forget('posts');
        return response()->json([
            "message" => "The post has been created successfully",
            "Post" => $Post
        ], 201);
    }

    public function show(Request $request, Post $Post)
    {
        return response()->json([
            "message" => "Here is the post you are looking for",
            "Post" => $Post
        ], 200);
    }

    public function update(Request $request, Post $Post)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "errors" => $validator->errors()->toJson()

            ], 422);
        }
        $Post->update($request->all());
        Cache::forget('posts');
        return response()->json([
            "message" => "The post has been updated successfully",
            "Post" => $Post
        ], 200);
    }

    public function destroy(Post $Post)
    {
        $Post->delete();
        Cache::forget('posts');
        return response()->json([
            "message" => "The post has been deleted successfully",
            "Post" => null
        ], 200);
    }
}
