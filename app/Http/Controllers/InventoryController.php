<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\People;
use App\Models\Brand;
use App\Models\Area;
use App\Models\TypeProduct;
use Illuminate\Http\Request;
use Peoples;

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
        $inventories = Inventory::paginate();

        return view('inventory.index', compact('inventories'))
            ->with('i', (request()->input('page', 1) - 1) * $inventories->perPage());
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
        $peoples = People::pluck('first_name', 'id');
        $areas = Area::pluck('name', 'id');
        $brands = Brand::pluck('name', 'id');
        $typeproducts = TypeProduct::pluck('name', 'id');
        return view('inventory.create', compact('inventory', 'peoples','areas','brands','typeproducts'));
    }


    public function autocompletePeople(Request $request)
    {
        return People::select('id','first_name')
        ->where('first_name', 'like', "%{$request->term}%")
        ->pluck('first_name');
    }

    public function getAutocomplete(Request $request){

        $search = $request->search;
  
        if($search == ''){
           $autocomplate = People::orderby('first_name','asc')->select('id','first_name')->limit(5)->get();
        }else{
           $autocomplate = People::orderby('first_name','asc')->select('id','first_name')->where('first_name', 'like', '%' .$search . '%')->limit(5)->get();
        }
  
        $response = array();
        foreach($autocomplate as $autocomplate){
           $response[] = array("value"=>$autocomplate->id,"label"=>$autocomplate->first_name);
        }
  
        echo json_encode($response);
        exit;
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
            ->with('success', 'Inventory created successfully.');
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

        return view('inventory.edit', compact('inventory'));
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
            ->with('success', 'Inventory updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $inventory = Inventory::find($id)->delete();

        return redirect()->route('inventories.index')
            ->with('success', 'Inventory deleted successfully');
    }
}
