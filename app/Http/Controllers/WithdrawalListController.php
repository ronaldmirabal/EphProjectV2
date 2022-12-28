<?php

namespace App\Http\Controllers;

use App\Models\WithdrawalList;
use Illuminate\Http\Request;

/**
 * Class WithdrawalListController
 * @package App\Http\Controllers
 */
class WithdrawalListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $withdrawalLists = WithdrawalList::paginate();

        return view('withdrawal-list.index', compact('withdrawalLists'))
            ->with('i', (request()->input('page', 1) - 1) * $withdrawalLists->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $withdrawalList = new WithdrawalList();
        return view('withdrawal-list.create', compact('withdrawalList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(WithdrawalList::$rules);

        $withdrawalList = WithdrawalList::create($request->all());

        return redirect()->route('withdrawal-list.index')
            ->with('success', 'El motivo fue creado.');
    }

   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $withdrawalList = WithdrawalList::find($id);

        return view('withdrawal-list.edit', compact('withdrawalList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  WithdrawalList $withdrawalList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WithdrawalList $withdrawalList)
    {
        request()->validate(WithdrawalList::$rules);

        $withdrawalList->update($request->all());

        return redirect()->route('withdrawal-list.index')
            ->with('success', 'El motivo fue actualizado');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $withdrawalList = WithdrawalList::find($id)->delete();

        return redirect()->route('withdrawal-list.index')
            ->with('success', 'El motivo fue eliminado');
    }
}
