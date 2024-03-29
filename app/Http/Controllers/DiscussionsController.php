<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discussion;
use App\Reply;
use App\User;
use Notification;
use Auth;
use Session;

class DiscussionsController extends Controller
{
   public function create()
   {
       return view('discuss');
   }

   public function store()
   {    
       $r = request();
       $this->validate($r, [
            'channel_id' => 'required',
            'content' => 'required',
            'title' => 'required'
       ]);

       $discussion = Discussion::create([
        'content' => $r->content,
        'title' => $r->title,
        'channel_id' =>$r->channel_id,
        'user_id' =>Auth::id(),
        'slug' => str_slug($r->title)
       ]);

       Session::flash('success', 'Discussion created!');
       
       return redirect()->route('discussion', ['slug' => $discussion->slug]);
   }

   public function show($slug)
   {
        $d = Discussion::where('slug', $slug)->first();
        $best_answer = $d->replies()->where('best_answer', 1)->first();

        return view('discussions.show')
            ->with('d', $d)
            ->with('best_answer', $best_answer);
   }

   public function reply($id)
    {
        $d = Discussion::find($id);
        
        $reply = Reply::create([
            'user_id' => Auth::id(),
            'discussion_id' => $id,
            'content' => request()->reply
        ]);

        $reply->user->points += 25;
        $reply->user->save();
        
        $watchers = array();
        foreach($d->watchers as $watcher):
            array_push($watchers, User::find($watcher->user_id));
        endforeach;
        
        Notification::send($watchers, new \App\Notifications\NewReplyAdded($d));
        
        Session::flash('success', 'Replied to discussion.');
        return redirect()->back();
    }

    public function edit($slug)
    {
        return view('discussions.edit', ['discussion' => Discussion::where(
            'slug', $slug
        )->first()]);
    }

    public function update($id)
    {
        $this->validate(request(), [
            'content' => 'required'
        ]);

        $d = Discussion::find($id);

        $d->content = request()->content;

        $d->save();

        Session::flash('success', 'Discussion updated.');
        return redirect()->route('discussion', [ 'slug' => $d->slug ]);
    }
}
