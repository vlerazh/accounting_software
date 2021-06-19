<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ItemsExport;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return view('sales.items.index')->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('sales.items.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'unique|required',
            'sales_price' => 'required|gt:0',
            'purchase_price' => 'reuqired|gt:0',
            'total_quantity' => 'required|gt:0',
            'category_id' => 'required'
        ]);
        $item = Item::create([
            'name' => $request->input('name'),
            'sales_price' => $request->input('sales_price'),
            'purchase_price' => $request->input('purchase_price'),
            'total_quantity' => $request->input('total_quantity'),
            'category_id' => $request->input('category_id'),
           
        ]);

        return redirect('/items');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return response()->json(['item' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $categories = Category::where('id','!=', $item->category_id)->get();
        return view('sales.items.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $this->validate($request, [
            'name' => 'unique|required',
            'sales_price' => 'required|gt:0',
            'purchase_price' => 'reuqired|gt:0',
            'total_quantity' => 'required|gt:0',
            'category_id' => 'required'
        ]);
        
        $item->update([
            'name' => $request->input('name'),
            'sales_price' => $request->input('sales_price'),
            'purchase_price' => $request->input('purchase_price'),
            'total_quantity' => $request->input('total_quantity'),
            'category_id' => $request->input('category_id')
        ]);

        return redirect('/items');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect('/items');
    }
    public function export() 
    {
        return Excel::download(new ItemsExport, 'items.xlsx');
    }

    public function all(){
        
        return Item::all();
    }
}
