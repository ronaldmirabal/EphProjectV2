<?php

namespace App\Http\Controllers;

use App\Models\RemoveInventory;
use App\Models\inventory_history;
use App\Models\Inventory;
use App\Models\WithdrawalList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/**
 * Class RemoveInventoryController
 * @package App\Http\Controllers
 */
class RemoveInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $removeInventories = RemoveInventory::with('inventories','withdrawallist', 'inventories.typeproduct')->get();

        $dd = $removeInventories;

        return view('remove-inventory.index', compact('removeInventories'))
            ->with('i', (request()->input('page', 1) - 1));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $removeInventory = new RemoveInventory();
        $removeInventory->user_id = Auth::user()->id;
        $removeInventory->date = Now();
        $inventory = Inventory::pluck('noplaca', 'id');
        $withdrawallist = WithdrawalList ::pluck('name', 'id');
        return view('remove-inventory.create', compact('removeInventory','inventory', 'withdrawallist'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(RemoveInventory::$rules);

        $removeInventory = RemoveInventory::create($request->all());
        $inventory = Inventory::find($request->inventory_id);
        $withdrawallist = WithdrawalList::find($request->withdrawallist_id);
        $history = new inventory_history();
            $history->description = "Se saco del inventario, Motivo: ".$withdrawallist->name;
            $history->created_at = now();
            $history->updated_at = now();
            $history->inventory_id = $inventory->id;
            $history->save();

            $inventory->active = 0;
            $inventory->save();

        return redirect()->route('remove-inventory.index')
            ->with('success', 'RemoveInventory created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $removeInventory = RemoveInventory::find($id);

        return view('remove-inventory.show', compact('removeInventory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $removeInventory = RemoveInventory::find($id);

        return view('remove-inventory.edit', compact('removeInventory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  RemoveInventory $removeInventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RemoveInventory $removeInventory)
    {
        request()->validate(RemoveInventory::$rules);

        $removeInventory->update($request->all());

        return redirect()->route('remove-inventories.index')
            ->with('success', 'RemoveInventory updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $removeInventory = RemoveInventory::find($id)->delete();

        return redirect()->route('remove-inventories.index')
            ->with('success', 'RemoveInventory deleted successfully');
    }
}
