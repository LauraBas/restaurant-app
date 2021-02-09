<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;
use App\Http\Resources\DishResource;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dishes = Dish::all();
        return  DishResource::collection($dishes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:200',
            'price' => 'required|numeric',
        ]);
        $dish = Dish::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
        ]);
        return new DishResource($dish);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dish = Dish::findOrFail($id);
        return new DishResource($dish);
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
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:200',
            'price' => 'required|numeric',
        ]);
        $dishToUpdate = Dish::findOrFail($id);
        $dishToUpdate->update($request->all());

        return new DishResource($dishToUpdate);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dishToDelete = Dish::findOrFail($id);
        if($dishToDelete->delete())
        {
            return response()->json([], 204);
        }        

    }
}
