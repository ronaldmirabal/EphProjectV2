<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\Position;
use App\Models\TypePeople;
use Illuminate\Http\Request;

/**
 * Class PeopleController
 * @package App\Http\Controllers
 */
class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peoples = People::with('typePeople','position')
        ->orderBy('peoples.id', 'desc')->get(); 


        return view('people.index', compact('peoples'))
            ->with('i', (request()->input('page', 1) - 1));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $people = new People();
        $typepeoples = TypePeople::pluck('name', 'id');
        $positions = Position::pluck('name', 'id');
        return view('people.create', compact('people', 'typepeoples', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(People::$rules);

        $people = People::create($request->all());

        return redirect()->route('people.index')
            ->with('success', 'La persona se creo correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $people = People::find($id);

        return view('people.show', compact('people'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $people = People::find($id);
        $typepeoples = TypePeople::pluck('name', 'id');
        $positions = Position::pluck('name', 'id');
        return view('people.edit', compact('people','typepeoples', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $people = People::findOrFail($id);
        request()->validate(People::$rules);

        $people->update($request->all());

        return redirect()->route('people.index')
            ->with('success', 'Los datos de la persona fueron actualizados correctamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $people = People::find($id)->delete();

        return redirect()->route('people.index')
            ->with('success', 'La persona fue eliminada correctamente');
    }
}
