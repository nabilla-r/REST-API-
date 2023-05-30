<?php

namespace App\Http\Controllers;

use App\Http\Resources\DrinkDetailResource;
use Illuminate\Http\Request;
use App\Models\Drink;
use App\Http\Resources\DrinkResource;
use Illuminate\Support\Facades\Auth;


class DrinkController extends Controller
{
    public function index()
    {
        $drinks = Drink::All();
        // return response()->json($drinks);
        return DrinkDetailResource::collection($drinks->loadMissing('write_orders'));
    }

    public function show($id)
    {
        $drinks = Drink::with('write_orders:id,username')->findOrFail($id);
        return new DrinkDetailResource($drinks);    
    }

    public function show2($id)
    {
        $drinks = Drink::findOrFail($id);
        return new DrinkDetailResource($drinks);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_drink' => 'required',
            'flavor' => 'required',
            'amount' => 'required', 
            'type_drink' => 'required'
        ]);

        //kode ini untuk mengambil data author yang login dan membuat drinkList baru
        $request['author'] = Auth::user()->id;

        //ini untuk menyimpan data drinkList ke database
        $drinks = Drink::create($request->all());
        return new DrinkDetailResource($drinks->loadMissing('write_orders'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name_drink' => 'required',
            'flavor' => 'required',
            'amount' => 'required', 
            'type_drink' => 'required'
        ]);

        $drinks = Drink::findOrFail($id);
        $drinks->update($request->all());

        return new DrinkDetailResource($drinks->loadMissing('write_orders'));
    }

    public function destroy($id)
    {
        $drinks = Drink::findOrFail($id);
        $drinks->delete();

        return new DrinkDetailResource($drinks->loadMissing('write_orders'));
    }
}
