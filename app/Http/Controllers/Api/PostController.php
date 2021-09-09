<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Post;
Use App\Http\Resources\PostResource;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Post::all();
        //return PostResource::collection(Post::all());
        //return PostResource::collection(Post::paginate(20));

        // $posts=Post::when(request('category_id','') !='',function ($q){
        //   $q->where('category_id',request('category_id'));
        // })->paginate(20);
        // return PostResource::collection($posts);

        $sortField=\request('sort_field', 'created_at');
        if(!in_array($sortField,['id','title','body','created_at'])){
            $sortField = 'created_at';
        }
        $sortDirection=\request('sort_direction', 'desc');
        if(!in_array($sortDirection,['asc','desc'])){
            $sortDirection = 'desc';
        }
        $posts=Post::when(request('category_id','') !='',function ($q){
            $q->where('category_id',request('category_id'));
        })->orderBy($sortField,$sortDirection)
            ->paginate(10);
        return PostResource::collection($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}