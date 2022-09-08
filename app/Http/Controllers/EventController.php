<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Event;
use App\Models\People;
use Illuminate\Http\Request;

class EventController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event = New Event();
        $classrooms = Classroom::pluck('name', 'id');
        return view('event.index', compact('classrooms', 'event'));
    }


     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       request()->validate(Event::$rules);
       $event = Event::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $event = Event::all();
        return response()->json($event);
    }


     /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $event = Event::find($id);
      //$event = Event::with('people')->where('id', '=', $id)->get();
      $data = [
        'success'=>true,
        'id'=> $event->id,
        'title' => $event->title,
        'start'=> $event->start,
        'end'=> $event->end,
        'description'=> $event->description,
        'classroom_id'=> $event->classroom_id,
        'people_id'=> $event->people_id,
        'people' => array(
            'first_name' => $event->people->first_name,
            'last_name' => $event->people->last_name,
        )
    ];
      return response()->json($data, 200, []);
    }


        /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
      $event = Event::find($id)->delete();
      return response()->json($event);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        request()->validate(Event::$rules);
        $event->update($request->all());
        return response()->json($event);
    }


}
