<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\match;
use Illuminate\Support\Facades\Storage;

class MatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matches =match::orderBy('created_at','desc')->paginate(10);
        return view('matches.index')->with('matches_',$matches);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('matches.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'team1'=>'required',
            'team2'=>'required',
            'cover_image1'=>'required|max:1999',
            'cover_image2'=>'required|max:1999',
            'day'=>'required',
            'time'=>'required',
            'date'=>'required',
            'league'=>'required',
        ]);


        if($request->hasFile('cover_image1')){

            $fileNameWithExt = $request->file('cover_image1')->getClientOriginalName();

            //name

            $name = pathinfo($fileNameWithExt,PATHINFO_FILENAME);

            //extension

            $extension = $request->file('cover_image1')->getClientOriginalExtension();

            //creating a name

            $fileNameToStore = $name.'_'.time().'.'.$extension;

            //upload image..

            $path = $request->file('cover_image1')->storeAs('public/cover_images',$fileNameToStore);
        }else{
            $fileNameToStore='noImage.jpg';
        }

        if($request->hasFile('cover_image2')){

            $fileNameWithExt2 = $request->file('cover_image2')->getClientOriginalName();

            //name

            $name2 = pathinfo($fileNameWithExt2,PATHINFO_FILENAME);

            //extension

            $extension2 = $request->file('cover_image2')->getClientOriginalExtension();

            //creating a name

            $fileNameToStore2 = $name2.'_'.time().'.'.$extension2;

            //upload image..

            $path2 = $request->file('cover_image2')->storeAs('public/cover_images',$fileNameToStore2);
        }else{
            $fileNameToStore2='noImage2.jpg';
        }

        //create post

        $match = new match;
        $match->team1= $request->input('team1');
        $match->team2= $request->input('team2');
        $match->time= $request->input('time');
        $match->date= $request->input('date');
        $match->day= $request->input('day');
        $match->league= $request->input('league');

        $match->logo1="null";
        $match->logo2="null";
        $match->cover_image1=$fileNameToStore;
        $match->cover_image2=$fileNameToStore2;

        $match->save();
        return \redirect('/matches')->with('success','Post Created ...');
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
        $post= match::find($id);
        return view('matches.edit')->with('post',$post);
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

        if($request->hasFile('cover_image1')){

            $fileNameWithExt = $request->file('cover_image1')->getClientOriginalName();

            //name

            $name = pathinfo($fileNameWithExt,PATHINFO_FILENAME);

            //extension

            $extension = $request->file('cover_image1')->getClientOriginalExtension();

            //creating a name

            $fileNameToStore = $name.'_'.time().'.'.$extension;

            //upload image..

            $path = $request->file('cover_image1')->storeAs('public/cover_images',$fileNameToStore);
        }

        if($request->hasFile('cover_image2')){

            $fileNameWithExt2 = $request->file('cover_image2')->getClientOriginalName();

            //name

            $name2 = pathinfo($fileNameWithExt2,PATHINFO_FILENAME);

            //extension

            $extension2 = $request->file('cover_image2')->getClientOriginalExtension();

            //creating a name

            $fileNameToStore2 = $name2.'_'.time().'.'.$extension2;

            //upload image..

            $path2 = $request->file('cover_image2')->storeAs('public/cover_images',$fileNameToStore2);
        }


        $match = match::find($id);

       
        if($request->input('team1')!=null)
            $match->team1= $request->input('team1');
        if($request->input('team2')!=null)    
            $match->team2= $request->input('team2');
        if($request->input('time')!=null)
            $match->time= $request->input('time');
        if($request->input('date')!=null)
            $match->date= $request->input('date');
        if($request->input('day')!=null)
            $match->day= $request->input('day');
        if($request->input('league')!=null)
            $match->league= $request->input('league');

        if($request->hasFile('cover_image1')){
            $match->cover_image1 = $fileNameToStore;
        }   
        
        if($request->hasFile('cover_image2')){
            $match->cover_image2 = $fileNameToStore2;
        }  
        $match->save();
        return \redirect('/matches')->with('success','Post Updated ...');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = match::find($id);

        if($post->cover_image1!='noimage.jpg'){

            Storage::delete('public/cover_images/'.$post->cover_image1);
        }

        if($post->cover_image2!='noimage2.jpg'){
            Storage::delete('public/cover_images/'.$post->cover_image2);
        }


        $post->delete();

        return \redirect('/matches')->with('success','Post Deleted ...');
    }
}
