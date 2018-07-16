<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Snack;

class SnackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $snacks = Snack::availableSnacks()->get()->toArray();
        return response()->json([
            'results' => $snacks
        ]);
    }
    public function create()
    {
        return view('create');
    }

    // returns out of stock snacks
    public function needsRefill()
    {
        $match = [
            ['is_available', '=', 0],
        ];

        $snacks = Snack::where($match)->orderBy('name')->get();
        return response()->json([
            'results' => $snacks
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate(request(), [
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric'
        ]);
        $Snack = new Snack();
        $Snack->name = $request->get('name');
        $Snack->price = $request->get('price');
        $Snack->quantity = $request->get('quantity');
        $Snack->is_available = ($Snack->quantity > 0) ? 1 : 0;
       // dd($Snack);
        $Snack->save();

        return redirect('snacks')->with('success','Snack has been updated');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $snack = Snack::find($id);
        return view('edit',compact('snack'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Snack = Snack::find($id);
        $this->validate(request(), [
            'name' => 'required',
            'price' => 'required|numeric'
        ]);
        $Snack->name = $request->get('name');
        $Snack->price = $request->get('price');
        $Snack->quantity = $request->get('quantity');
        $Snack->is_available = ($Snack->quantity > 0) ? 1 : 0;
        $Snack->save();

        return redirect('snacks')->with('success','Snack has been updated');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Snack = Snack::find($id);
        $Snack->delete();
        return redirect('snacks')->with('success','Snack has been  deleted');
    }
}
