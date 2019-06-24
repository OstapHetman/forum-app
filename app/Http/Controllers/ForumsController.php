<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discussion;
use App\Channel;
use Auth;
use Illuminate\Pagination\Paginator;

class ForumsController extends Controller
{
    public function index()
    {
        switch(request('filter')) {
            case 'me':
                $results = Discussion::where('user_id', Auth::id())->paginate(3);
                break;
            case 'solved':
                $answ = array();
                foreach(Discussion::all() as $d)
                {
                    if($d->hasBestAnswer()) {
                        array_push($answ, $d);
                    }
                }
                $results = new Paginator($answ, 3);
                break;
            case 'unsolved':
                $unansw = array();
                foreach(Discussion::all() as $d)
                {
                    if(!$d->hasBestAnswer()) {
                        array_push($unansw, $d);
                    }
                }
                $results = new Paginator($unansw, 3);
                break; 
            default:
                $results = Discussion::orderBy('created_at', 'desc')->paginate(3);
                break;
        };
        
        return view('forum', ['discussions' => $results]);
    }

    public function channel($slug)
    {
        $channel = Channel::where('slug', $slug)->first();

        return view('channel')->with('discussions', $channel->discussions()->paginate(5));
    }
}
