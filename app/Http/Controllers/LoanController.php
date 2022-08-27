<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Models\loan;
use App\Models\loan_detail;
use App\Models\People;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = Loan::with('people','user', 'inventories')
        ->where('active', '=', true)
        ->orderby('loans.id','desc')->get();
        return view('loan.index', compact('loans'))
            ->with('i', (request()->input('page', 1) - 1));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function deliver($id)
    {
        $loan = loan::find($id);
        $loan->condition = true;
        $loan->update();
        return redirect()->route('loan.index');
    }

 /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $loan = new loan();
        $inventories = Inventory::all();
        $loan->user_id = Auth::user()->id;
        $loan->estimated_date = now();
        return view('loan.create',compact('loan','inventories'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $loan = Loan::create($request->all());
            $products = $request->input('products', []);
            $descriptions = $request->input('descriptions', []);
            for ($product=0; $product < count($products); $product++) { 
                if($products[$product] != ''){
                    $detail = loan_detail::insert([
                        'loans_id' => $loan->id,
                        'inventory_id' => $products[$product],
                        'description' => $descriptions[$product]
                    ]);
                }
            }
        } catch (\Exception $th) {
            return $th->getMessage();
        }
        
        
        return redirect()->route('loan.index')
                ->with('success', 'El registro del prestamo fue creado');
    }


     /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
    }

    public function destroy($id)
    {
       
    }




}
