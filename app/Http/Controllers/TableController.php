<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\TableOrder;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Customer;
use Carbon\Carbon;

class TableController
{
    public function index()
    {        
        $tables = Table::all();

        return view('checkout.table.index', ['tables' => $tables]);
    }

    public function edit(Table $table)
    {        
        return view('checkout.table.edit', ['table' => $table]);
    }

    public function update(Request $request, Table $table)
    {      
        $request->validate([
            'names.*' => 'required|string|max:255',
            'dates_of_birth.*' => 'required|date',
            'deluxe_menu' => 'nullable',
        ]);

        $order = Order::create([
            'type' => 'restaurant',
        ]);

        $tableOrder = TableOrder::create([
            'deluxe_menu' => $request['deluxe_menu'] ? true : false,
            'order_id' => $order->id,
            'table_id' => $table->id,
            'last_placed_round' => Carbon::now()->subMinutes(10),
        ]);

        $table->active_table_order_id = $tableOrder->id;
        $table->save();

        foreach ($request->names as $index => $name) {            
            $customer = Customer::create([
                'name' => $name,
                'date_of_birth' => $request->dates_of_birth[$index],
                'table_order_id' =>  $tableOrder->id,
            ]);            
        }

        return redirect()->route('table.index')->with('success', 'Tafel is geactiveerd');
    }
    
    public function close(Table $table)
    {      
        $tableOrder = $table->tableOrder;

        $table->active_table_order_id = NULL;
        $table->save();

        return redirect()->route('checkout.show', ['checkout' => $tableOrder->order])->with('success', 'Tafel ' . $table->id . ' is gesloten');
    }

    public function show(Table $table)
    {        
        if(!$table->tableOrder) return response()->json(['message' => 'tafel staat niet open'], 200);

        $categories = Category::has('products')
            ->with(['products' => function ($query) {
                $query->orderBy('display_number', 'asc');
            }])
            ->get();

        return view('restaurants.table.show', ['table' => $table, 'categories' => $categories]);
    }
    
    public function store(Request $request, $tableid)
    {      
        $table = Table::findOrFail($tableid);
        
        $tableOrder = $table->tableOrder;

        foreach($request->order as $productId => $quantity) {
            for ($i=0; $i < $quantity; $i++) {                  
                OrderProduct::create([
                    'order_id' => $tableOrder->order->id,
                    'product_id' => $productId,
                ]);
            }    
        }

        $tableOrder->last_placed_round = Carbon::now()->addHours(2);
        $tableOrder->round = $tableOrder->round += 1;
        $tableOrder->save();

        return redirect()->route('table.show', ['table' => $table])->with('success', 'Bestelling is geplaatst');
    }
    
    public function activeTableOverview()
    {        
        $tables = Table::whereNotNull('active_table_order_id')->get();

        return view('restaurants.table.index', ['tables' => $tables]);
    }
}
