<?php

namespace App\Http\Controllers;

use App\Exports\InventoryExport;
use App\Models\Inventory;
use App\Models\People;
use App\Models\Brand;
use App\Models\Area;
use App\Models\inventory_history;
use App\Models\TypeProduct;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Facade\FlareClient\Http\Response;
use SimpleSoftwareIO\QrCode\Facades\QrCode;



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
        $inventories = Inventory::with('people','area','brand','typeproduct')
        ->orderby('inventories.id','desc')->get();
        return view('inventory.index', compact('inventories'))
            ->with('i', (request()->input('page', 1) - 1));
    }



  
    public function pdf()
    {
        $inventories = Inventory::with('people','area','brand','typeproduct')
        ->where('active', '=', true)->get();
        $universities = University::find(1);
       $pdf = Pdf::loadView('inventory.pdf', ['inventories'=>$inventories, 'universities'=>$universities])->setPaper('a4', 'landscape');
       return $pdf->download('inventory.pdf');
    //return view('inventory.pdf', compact('inventories','universities'));
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
        $selectNoPlaca = '';
        if(!empty($request->noplaca) ){
            $selectNoPlaca = Inventory::select('noplaca')
            ->where('noplaca','=',$request->noplaca)->get()->count();
        }
        
        if($selectNoPlaca <= 0){
            $inventory = Inventory::create($request->all());
            $history = new inventory_history();
            $history->description = "Se creo el inventario";
            $history->created_at = now();
            $history->updated_at = now();
            $history->inventory_id = $inventory->id;
            $history->save();
            return redirect()->route('inventory.index')
                ->with('success', 'El registro del inventario fue creado');
        }else{
            $request->session()->flash('error', 'El NoPlaca ya existe en la base de datos.');
            return redirect()->back()->withInput();
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
        $inventory = Inventory::find($id);
        $histories = inventory_history::where('inventory_id','=',$id)->get();
        return view('inventory.show', compact('inventory', 'histories'));
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
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function printlabel($id)
    {
        $inventory = Inventory::find($id);
        $areas = Area::pluck('name', 'id');
        $typeproducts = TypeProduct::pluck('name', 'id');
        $qrcode = base64_encode(QrCode::format('svg')->size(55)->errorCorrection('H')->generate($inventory->noplaca));

        return Pdf::loadView('inventory.printlabel', compact('qrcode','areas', 'inventory', 'typeproducts'))->setPaper('a4', 'portrait')->stream('archivo.pdf');;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @param  \Illuminate\Http\Request $request
     */
    public function printlabelSelect(Request $request)
    {
        $inventory = Inventory::find($id);
        $areas = Area::pluck('name', 'id');
        $typeproducts = TypeProduct::pluck('name', 'id');
        $qrcode = base64_encode(QrCode::format('svg')->size(55)->errorCorrection('H')->generate($inventory->noplaca));

        return Pdf::loadView('inventory.printlabel', compact('qrcode','areas', 'inventory', 'typeproducts'))->setPaper('a4', 'portrait')->stream('archivo.pdf');;
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

        return redirect()->route('inventory.index')
            ->with('success', 'El registro del inventario fue actualizado');
    }

 
    public function delete($id)
    {
        $inventory = Inventory::find($id);
        if($inventory){
            $history = new inventory_history();
            $history->description = "Se elimino del inventario";
            $history->created_at = now();
            $history->updated_at = now();
            $history->inventory_id = $inventory->id;
            $history->save();
            
            $inventory->active = 0;
            $inventory->save();

        }
        return redirect()->route('inventory.index')
            ->with('success', 'El registro del inventario fue desactivado');
    }

}
