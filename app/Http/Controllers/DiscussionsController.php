<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Discussion;
use App\Http\Requests\DiscussionRequest;
use App\Reply;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscussionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('discussions.index', [
             'discussions' => Discussion::filterByChannels()->paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('discussions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscussionRequest $request)
    {
    
        auth()->user()->discussions()->create([

            'title' => $request->title,
            'content' => $request->content,
            'channel_id' => $request->channel_id,
            'slug' => $request->title,
            'user_id' => Auth::id()
        ]);


        session()->flash('success', 'Discussion posted.');

        return redirect()->route('discussions.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Discussion $discussion)
    {
         
        return view('discussions.show', [

            'discussion' => $discussion
        ]);

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

    public function reply(Discussion $discussion ,Reply $reply) 
     {

        $discussion->markBest($reply);

        session()->flash('success', 'Marked as best reply.');

        return redirect()->back();

     }
}
