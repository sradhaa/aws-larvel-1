<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;

use Illuminate\Http\Request;

use App\Models\BlogPost;

//use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//         //echo "hi";exit;
//         DB::connection()->enableQueryLog();

//         $posts = BlogPost::with('comments')->get();
//        // echo '<pre>';print_r($posts);exit;
// foreach($posts as $post){
//     foreach($post->comments as $comment){
// echo $comment->content;
//     }

// }
// dd(DB::getQueryLog());
//echo '<pre>';print_r(BlogPost::withCount('comments')->get());exit;
        return view(
            'posts.posts'
            ,['posts'=>  BlogPost::withCount('comments')->get()]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        //
     //   echo '<pre>';print_r(validated);exit;
///validation rule//
 $validated  = $request->validated();
$post = BlogPost::create($validated);
////

//echo '<pre>';print_r($validated);exit;

    //   $post =  new BlogPost();
   //    $post->title =$request->input('title');
   //    $post->content =$request->input('content');

   //using $validated method//
       //  $post->title =$validated['title'];
      //   $post->content =$validated['content'];
       //  $post->save();
      // echo '<pre>';print_r($post['content']);exit;
     //  dd($post->id);
     $request->session()->flash('status','Blog Post Created');
     return redirect()->route('posts.show',['post'=> $post]);
    }

    /**s
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // echo '<pre>';print_r($id);exit;
       // echo $id;
       //echo "hi";exit;
       $fadat= BlogPost::findOrFail($id);
     //  echo '<pre>';print_r($fadat);exit;
       return view('posts.show',['post'=>$fadat]);
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
       $fadat= BlogPost::findOrFail($id);
    //  echo '<pre>';print_r($fadat->title);
      return view('posts.edit',['post'=>$fadat]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {
       
        //
        $post = BlogPost::findOrFail($id);
        $validated  = $request->validated();
        $post->fill($validated);
        $post->save();

        $request->session()->flash('status' , 'Blog Post Was Updated !');
//echo '<pre>';print_r($post->title);exit;
        return redirect()->route('posts.show',['post'=> $post->id]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id ,Request $request)
    {
        //
       // dd($id);

       $post = BlogPost::findOrFail($id);
       $post->delete();
       $request->session()->flash('status' ,'Blog Post Deleted');
       return redirect()->route('posts.index');
    }
}
