<?php

namespace App\Http\Controllers;


use App\Post;
use App\User;
use App\Comment;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;



class PostController extends Controller
{

    public function index()
    {
        $groups  = Post::with(['comments', 'comments.user'])->paginate(PAGINATION_COUNT);
        return  response() -> json($groups);
    }

    public function add_post(Request $request)
    {
        $rules = [
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable',


        ];

        $validator =Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        POST::create([

            'title' => $request->title ,
            'description' => $request->description ,
            'image'=>$request->image,
            'author_id'=>auth()->user()->id

        ]);

        return response()->json(['message' => 'success']);

    }

    public function update_post(Request $request )
    {
        // validation request
        $rules = [
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable',
        ];

        $validator =Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json($validator->errors());
        }
        // check if post exists
        $post= Post::select('id','title','description' ,'image') -> find($request->id);

        if(!$post)
            return redirect() ->back();

        //update data
        $post -> update($request -> all());

        return response()->json(['message' => 'success']);
    }

    public function delete_post(Request $request)
    {
        $post=Post::find($request->id);
        if(!$post)
        return response()->json(['error' => 'failed']);
        $post->delete();

        return response()->json(['message' => 'success']);

    }


}
