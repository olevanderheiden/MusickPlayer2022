<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\MusicCreater;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use const http\Client\Curl\AUTH_ANY;

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
            if (Auth::user() and Auth::user()->rank == 1) {
                $tracks = Music::all();
            } else {
                $tracks = Music::select('*')
                    ->where("state", "=", true)
                    ->get();
            }

            return view('music.index', compact('tracks'));
        }

    /**
     * Display a listing of the resource. That match the search result
     *
     * @return \Illuminate\Http\Response
     */
        public function search(Request $request)
        {

            if (Auth::user() and Auth::user()->rank == 1)
            {
                $tracks = Music::select('*')
                    ->where("track",'like','%'.$request->search.'%')
                    ->get();
            }
            else
            {
                $tracks = Music::select('*')
                    ->where("state", "=", true)
                    ->where("track",'like','%'.$request->search.'%')
                    ->get();
            }
                return view('music.index', compact('tracks'));

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
//        dd($request->file('cover')->extension());
//        $request->validate([
//            'title'=>'required',
//            'user'=>'required',
//            'cover' => 'required|mimes:pdf,jpg,JPG,png,PNG,jpeg,JPEG|max:2048',
//            'track'=>'required|mimes:mp3,flac,wav,MP3,FLAC,WAV|max:100000',
//        ]);
        $track = new Music();
        $track->track = $request->title;
//        $request->file('cover')->move('public/covers',$request->file('cover')->hashName());
//        $request->file('track')->move('public/tracks',$request->file('track')->hashName());
        $track->user_id = $request->user_id;
        $track->cover_file_path = $request->file('cover')->hashName();
        $track->file_path = $request->file('track')->hashName();
        $track->save();
//
        return redirect()->route('music.index')->with('message','Nummer toegevoegd');
    }

    /**
     * Display the specified resource.
     *
     * @param  Music  $track
     * @return \Illuminate\Http\Response
     */
    public function show(Music $music)
    {
        return view('music.show', compact('music'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Music $music)
    {
        if ( Auth::user() and Auth::user()->rank === 1 or $music->user_id === Auth::user()->id ) {
            $users = User::all();
            return view('music.edit', compact('music', 'users'));
        }
        else
        {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Music $track)
    {
        $track->track = $request->title;
        $track->duration = $request->duration;
        $track->user_id = $request->user_id;
        $track->update();

        return redirect()->route('music.index')->with('message', 'Track geupdate');
    }


    public function delete(Music $music)
    {
        if ( Auth::user() and Auth::user()->rank === 1 or $music->user_id === Auth::user()->id ) {
            return view('music.delete', compact('music'));
        }
        else
        {
            abort(404);
        }

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
    public function state(Music $music)
    {
        if ( Auth::user() and Auth::user()->rank === 1 or $music->user_id === Auth::user()->id ) {
        if ($music->state == true)
        {
            $music->state = false;
        }
        else
        {
            $music->state = true;
        }
        $music->save();
        return redirect()->route('music.index')->with('message','status gewijzigd');
        }
        else
        {
            abort(404);
        }
    }
}
