<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use illuminate\Support\Str;

class EventController extends Controller
{

    public function __construct()
    {
        // only logged in users should be able to create and store an event
        $this->middleware('auth', ['only'=>[
            'create', 'store'
        ]]) ;   
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::where("start_at", ">=", now())
                        ->with(['user', 'tags'])
                        ->orderBy('start_at')
                        ->get();
        return response()->json($events, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // we will create the event 
        $event = Event::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->title,
            'premium' => $request->filled('premium'),
            'start-at' => $request->start_at,
            'ends_at' => $request->ends_at,
        ]);
        // create tags if any, then associate it to events
        if($request->tags){
            $this->createOrSyncTags($request, $event);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return $event;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $event->update($request->all());
        return response()->json($event, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(null, 204);
    }
}
