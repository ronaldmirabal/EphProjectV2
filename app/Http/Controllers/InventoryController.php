<?php

namespace App\Http\Controllers;

use App\Exports\InventoryExport;
use App\Models\Inventory;
use App\Models\People;
use App\Models\Brand;
use App\Models\Area;
use App\Models\TypeProduct;
use Illuminate\Http\Request;
use Peoples;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class InventoryController
 * @package App\Http\Controllers
 */
class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventories = Inventory::with('people','area','brand','typeproduct')->get();
        //$inventories = Inventory::paginate();

        return view('inventory.index', compact('inventories'))
            ->with('i', (request()->input('page', 1) - 1));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $inventory = new Inventory();
        $inventory->stock = 1;
        $inventory->user_id = Auth::user()->id;
        $peoples = People::pluck('first_name', 'id');
        $areas = Area::pluck('name', 'id');
        $brands = Brand::pluck('name', 'id');
        $typeproducts = TypeProduct::pluck('name', 'id');
        return view('inventory.create', compact('inventory', 'peoples','areas','brands','typeproducts'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function export() 
    {
        return Excel::download(new InventoryExport, 'inventario.xlsx');
    }

    public function autocompletePeople(Request $request)
    {
        //return People::select('id','first_name')
        //->where('first_name', 'like', "%{$request->term}%")
       // ->pluck('first_name');
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
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Inventory::$rules);

        $inventory = Inventory::create($request->all());

        return redirect()->route('inventories.index')
            ->with('success', 'El registro del inventario fue creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inventory = Inventory::find($id);

        return view('inventory.show', compact('inventory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inventory = Inventory::find($id);
        $peoples = People::pluck('first_name', 'id');
        $areas = Area::pluck('name', 'id');
        $brands = Brand::pluck('name', 'id');
        $typeproducts = TypeProduct::pluck('name', 'id');

        return view('inventory.edit', compact('inventory','peoples','areas','brands','typeproducts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Inventory $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        request()->validate(Inventory::$rules);

        $inventory->update($request->all());

        return redirect()->route('inventories.index')
            ->with('success', 'El registro del inventario fue actualizado');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $inventory = Inventory::find($id);
        if($inventory){
            $inventory->active = 0;
            $inventory->save();
        }
        return redirect()->route('inventories.index')
            ->with('success', 'El registro del inventario fue desactivado');
    }
}
