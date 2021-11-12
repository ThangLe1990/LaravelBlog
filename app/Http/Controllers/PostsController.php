<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        return view('blog.index')
        ->with('posts', Post::orderBy('updated_at','DESC')->get() );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required',
            'description'   => 'required',
            'image'         => 'required:mines:jpg,png,jpeg|max:5048 ',
        ]);

        $newImageName = uniqid() . '-' . $request->title. '.' . $request->image->extension();
        
        $request->image->move(public_path('image'),$newImageName);

        Post::create ([
            'title'         => $request->input('title'),
            'description'   => $request->input('description'),
            'slug'          => Str::slug ($request->input('title'), '-'),
            'image_path'    => $newImageName,
            'user_id'       => auth()->user()->id
        ]);

        return redirect('/blog')->with('message', 'Your post has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return view('blog.show')->with('post', Post::where( 'slug', $slug)->first() );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        return view('blog.edit')->with('post', Post::where( 'slug', $slug)->first() );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'title'         => 'required',
            'description'   => 'required',
             
        ]);

       Post::where('slug', $slug)->update([
           'title'         => $request->input('title'),
            'description'   => $request->input('description'),
            'slug'          => Str::slug ($request->input('title'), '-'),
             
            'user_id'       => auth()->user()->id
        ]);

       return redirect('/blog')->with('message', 'Your post has been updated');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
          Post::where('slug', $slug)->delete();

        return redirect('/blog')->with('message', 'Your post has been deleted');  
    }
}