<?php

namespace App\Http\Controllers;

use App\Models\TypePerson;
use Illuminate\Http\Request;

/**
 * Class TypePersonController
 * @package App\Http\Controllers
 */
class TypePersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typePeople = TypePerson::paginate();

        return view('type-person.index', compact('typePeople'))
            ->with('i', (request()->input('page', 1) - 1) * $typePeople->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typePerson = new TypePerson();
        return view('type-person.create', compact('typePerson'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(TypePerson::$rules);

        $typePerson = TypePerson::create($request->all());

        return redirect()->route('type-people.index')
            ->with('success', 'TypePerson created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $typePerson = TypePerson::find($id);

        return view('type-person.show', compact('typePerson'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $typePerson = TypePerson::find($id);

        return view('type-person.edit', compact('typePerson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TypePerson $typePerson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypePerson $typePerson)
    {
        request()->validate(TypePerson::$rules);

        $typePerson->update($request->all());

        return redirect()->route('type-people.index')
            ->with('success', 'TypePerson updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $typePerson = TypePerson::find($id)->delete();

        return redirect()->route('type-people.index')
            ->with('success', 'TypePerson deleted successfully');
    }
}
