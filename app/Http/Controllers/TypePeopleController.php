<?php

namespace App\Http\Controllers;

use App\Models\TypePeople;
use Illuminate\Http\Request;

/**
 * Class TypePeopleController
 * @package App\Http\Controllers
 */
class TypePeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typePeoples = TypePeople::paginate();

        return view('type-people.index', compact('typePeoples'))
            ->with('i', (request()->input('page', 1) - 1) * $typePeoples->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typePeople = new TypePeople();
        return view('type-people.create', compact('typePeople'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(TypePeople::$rules);

        $typePeople = TypePeople::create($request->all());

        return redirect()->route('type-people.index')
            ->with('success', 'TypePeople created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $typePeople = TypePeople::find($id);

        return view('type-people.show', compact('typePeople'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $typePeople = TypePeople::find($id);

        return view('type-people.edit', compact('typePeople'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TypePeople $typePeople
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypePeople $typePeople)
    {
        request()->validate(TypePeople::$rules);

        $typePeople->update($request->all());

        return redirect()->route('type-peoples.index')
            ->with('success', 'TypePeople updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $typePeople = TypePeople::find($id)->delete();

        return redirect()->route('type-people.index')
            ->with('success', 'TypePeople deleted successfully');
    }
}
