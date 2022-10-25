<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\MusicCreater;
use App\Models\User;
use Illuminate\Http\Request;

class MusicController extends Controller
{

    /** Set permission methods */
//    public function __construct()
//    {
//        $this->middleware('auth');
//        $this->middleware('permission:create music',['only'=>['create','store']]);
//        $this->middleware('permission:edit music',['only'=>['edit', 'update']]);
//        $this->middleware('permission:delete music',['only'=>['delete','destroy']]);
//    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tracks = Music::all();
        return view('music.index',compact('tracks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users =  User::all();
        return view('music.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $track = new Music();
        $track->track = $request->track;
//        $track->cover_art = $request->cover_art;
        $track->save();
        $musicCreater = new MusicCreater();
        $musicCreater->user_id = $request->user_id;
        $musicCreater->music_id = $track->id;
        $musicCreater->save();

        return redirect()->route('music.index')->with('message','Nummer toegevoegd');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('music.show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('music.edit', compact('id'));
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


    public function delete(Music $music)
    {
        return view('music.delete',compact('music'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Music $music)
    {
        $music->delete();
        return redirect()->route('music.index')->with('message','nummer verwijderd');
    }
}
