<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\inventory_history;
use App\Models\InventoryTransfer;
use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

/**
 * Class InventoryTransferController
 * @package App\Http\Controllers
 */
class InventoryTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventoryTransfers = InventoryTransfer::paginate();

        return view('inventory-transfer.index', compact('inventoryTransfers'))
            ->with('i', (request()->input('page', 1) - 1) * $inventoryTransfers->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $inventoryTransfer = new InventoryTransfer();
        return view('inventory-transfer.create', compact('inventoryTransfer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(InventoryTransfer::$rules);
        DB::beginTransaction();
        try {
            $inventoryTransfer = InventoryTransfer::create($request->all());

            $history = inventory_history::create([
                'description' => "Se realizo un traspaso de inventario de la persona: ".$request->person_old. " a ".$request->person_new,
                'inventory_id' => $request->inventory_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $inventory = Inventory::find($request->inventory_id);
            $inventory->people_id = $request->people_id;
            $inventory->save();

            DB::commit();
            return redirect()->route('inventory-transfer.index')
            ->with('success', 'La transferencia de inventario se realizo con exito.');
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

        
    }



    public function autocompletePeople(Request $request)
    {
        try {
            $term = $request->get('term');
            $querys = People::where('first_name', 'LIKE', '%' . $term . '%')->get();
            $data = [];
            foreach ($querys as $querys) {
            $data[] = [
               'label' => $querys->first_name. " ".$querys->last_name ,
               'value' => $querys->id
            ];
            }
            return $data;
        } catch (\Throwable $th) {
            report($th);
        }
    }


   
    public function getPerson(Request $request)
    {
        $querys = People::where('id','=',$request->id)->get();
        $data = [];
        foreach ($querys as $querys) {
            $data[] = [
                'fullname' => $querys->first_name. " ". $querys->last_name,
            ];
        }
        echo json_encode($data);
    }


    public function autocompleteInventory(Request $request)
    {
        try {
            $term = $request->get('term');
            $querys = Inventory::where('noplaca','LIKE', '%' . $term . '%')
            ->orWhere('description' ,'LIKE', '%' . $term . '%')
            ->get();
            $data = [];
            foreach ($querys as $querys) {
            $data[] = [
               'label' => $querys->noplaca,
               'value' => $querys->id,
               'people_id'=> $querys->people_id
            ];
            }
            return $data;
        } catch (\Throwable $th) {
            report($th);
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inventoryTransfer = InventoryTransfer::find($id);

        return view('inventory-transfer.show', compact('inventoryTransfer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inventoryTransfer = InventoryTransfer::find($id);

        return view('inventory-transfer.edit', compact('inventoryTransfer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  InventoryTransfer $inventoryTransfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InventoryTransfer $inventoryTransfer)
    {
        request()->validate(InventoryTransfer::$rules);

        $inventoryTransfer->update($request->all());

        return redirect()->route('inventory-transfer.index')
            ->with('success', 'InventoryTransfer updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $inventoryTransfer = InventoryTransfer::find($id)->delete();

        return redirect()->route('inventory-transfer.index')
            ->with('success', 'InventoryTransfer deleted successfully');
    }
}
