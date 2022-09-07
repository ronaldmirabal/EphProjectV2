<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

/**
 * Class ClassroomController
 * @package App\Http\Controllers
 */
class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classrooms = Classroom::paginate();

        return view('classroom.index', compact('classrooms'))
            ->with('i', (request()->input('page', 1) - 1) * $classrooms->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classroom = new Classroom();
        return view('classroom.create', compact('classroom'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Classroom::$rules);

        $classroom = Classroom::create($request->all());

        return redirect()->route('classroom.index')
            ->with('success', 'El aula fue creada con exito.');
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classroom = Classroom::find($id);

        return view('classroom.edit', compact('classroom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Classroom $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {
        request()->validate(Classroom::$rules);

        $classroom->update($request->all());

        return redirect()->route('classroom.index')
            ->with('success', 'El aula fue actualizada con exito');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $classroom = Classroom::find($id)->delete();

        return redirect()->route('classroom.index')
            ->with('success', 'El aula fue eliminada con exito');
    }
}
