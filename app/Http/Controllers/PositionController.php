<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

/**
 * Class PositionController
 * @package App\Http\Controllers
 */
class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = Position::paginate();

        return view('position.index', compact('positions'))
            ->with('i', (request()->input('page', 1) - 1) * $positions->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $position = new Position();
        return view('position.create', compact('position'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Position::$rules);

        $position = Position::create($request->all());

        return redirect()->route('position.index')
            ->with('success', 'El cargo fue creado.');
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $position = Position::find($id);

        return view('position.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Position $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        request()->validate(Position::$rules);

        $position->update($request->all());

        return redirect()->route('position.index')
            ->with('success', 'El cargo fue actualizado.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $position = Position::find($id)->delete();

        return redirect()->route('position.index')
            ->with('success', 'El cargo fue eliminado.');
    }
}
