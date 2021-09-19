<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Support\MessageBag
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
             $request->all(),
            [
                'title' => 'required',
                'body' => 'required'
            ]
        );

        if ($validator->fails())
        {
            return [
                'status' => false,
                'message' => $validator->messages()
            ];
        }

        $post = Post::create([
           'title' => $request->title,
           'body' => $request->body,
        ]);

        return [
            'status' => true,
            'post' => $post
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function show($id)
    {
        $post = Post::query()->find($id);

        if (!$post){
            return response()->json([
                'status' => false,
                'message' => 'Post not found'
            ])->setStatusCode(404);
        }

        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return array|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::query()->find($id);

        if (!$post)
        {
            return [
                'status' => false,
                'message' => 'Post not found'
            ];
        }

        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'body' => 'required'
            ]
        );

        if ($validator->fails())
        {
            return [
                'status' => false,
                'message' => $validator->messages()
            ];
        }

        $post->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return [
            'status' => true,
            'post' => "Post {$post->id} updated"
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array
     */
    public function destroy($id)
    {
        $post = Post::query()->find($id);

        if (!$post)
        {
            return [
                'status' => false,
                'message' => 'Post not found'
            ];
        }
        $post->delete();


        return [
            'status' => true,
            'post' => "Post deleted"
        ];

    }
}
