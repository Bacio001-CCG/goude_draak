<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\TableOrder;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\HelpRequest;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
        if(!$table->tableOrder) return redirect()->route('table.overview');

        $categories = Category::has('products')
            ->with(['products' => function ($query) {
                $query->orderBy('display_number', 'asc');
            }])
            ->get();

        $pastOrders = $table->tableOrder->order->orders_products->whereNotNull('round')->groupBy('round');

        return view('restaurants.table.show', ['table' => $table, 'categories' => $categories, 'pastOrders' => $pastOrders]);
    }
    
    public function paymentScreen(Table $table)
    {   
        $orderdProducts = $table->tableOrder->order->products; 
        $orderdProductsQuantities = [];
        
        foreach($orderdProducts as $product)
        {
            if (isset($orderdProductsQuantities[$product->id])) {
                $orderdProductsQuantities[$product->id]->quantity++;
            } else {
                $product->quantity = 1;
                $orderdProductsQuantities[$product->id] = $product;
            }
        }

        return view('restaurants.table.payment', ['table' => $table, 'orderdProducts' => $orderdProductsQuantities]);
    }

    public function helpScreen(Table $table)
    {   
        return view('restaurants.table.help', ['table' => $table]);
    }

    public function help(Request $request, Table $table)
    {
        $request->validate([
            'question' => 'nullable|string|max:255',
        ]);
          
        HelpRequest::create([
            'question' => $request->question,
            'table_order_id' => $table->tableOrder->id,
        ]);

        return redirect()->route('table.show', ['table' => $table])->with('success', 'Hulp verzoek is verzonden.');
    }
    
    public function completeHelpRequest(HelpRequest $helpRequest)
    {          
        $helpRequest->completed = true;
        $helpRequest->save();

        return redirect()->route('table.index')->with('success', 'Vraag is verholpen');
    }
    
    public function helpRequest(Table $table)
    {   
        return view('checkout.table.help', ['table' => $table]);
    }
    
    public function pay(Table $table)
    {                
        $transaction = Transaction::create([
            'price' => $table->tableOrder->order->products->sum('price'),
            'order_id' => $table->tableOrder->order->id,
        ]);

        $table->active_table_order_id = null;
        $table->save();

        $url = config('app.url') . '/review';
        $qrCode = QrCode::size(300)->generate($url);

        return view('restaurants.table.thankyoupage', ['qrCode' => $qrCode, 'url' => $url]);
    }
    
    public function store(Request $request, $tableid)
    {      
        $table = Table::findOrFail($tableid);
        
        $tableOrder = $table->tableOrder;
        $round = $tableOrder->round() + 1;
        $productCreated = false;

        foreach($request->order as $productId => $quantity) {
            for ($i=0; $i < $quantity; $i++) {                  
                OrderProduct::create([
                    'order_id' => $tableOrder->order->id,
                    'product_id' => $productId,
                    'round' => $round,
                ]);
                $productCreated = true;
            }    
        }

        if(!$productCreated) return redirect()->route('table.show', ['table' => $table])->with('error', 'Geen producten in de bestelling');

        $tableOrder->last_placed_round = Carbon::now()->addHours(2);
        $tableOrder->save();

        return redirect()->route('table.show', ['table' => $table])->with('success', 'Bestelling is geplaatst');
    }
    
    public function activeTableOverview()
    {        
        $tables = Table::whereNotNull('active_table_order_id')->get();

        return view('restaurants.table.index', ['tables' => $tables]);
    }
}
