<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Annotations\PostsCrudAnnotationController;
use App\Models\AbstractModels\SwooleCacheTrait;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    use SwooleCacheTrait;
    public function __construct()
    {
        /**
         * @var PostsCrudAnnotationController
         * @return JsonResponse
         */
    }
    public function index()
    {
        $Posts = SwooleCacheTrait::rememberSwooleForever('posts', function () {
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
        SwooleCacheTrait::forgetSwoole('posts');
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
        SwooleCacheTrait::forgetSwoole('posts');
        return response()->json([
            "message" => "The post has been updated successfully",
            "Post" => $Post
        ], 200);
    }

    public function destroy(Post $Post)
    {
        $Post->delete();
        SwooleCacheTrait::forgetSwoole('posts');
        return response()->json([
            "message" => "The post has been deleted successfully",
            "Post" => null
        ], 200);
    }
}
