<?php

namespace App\Http\Controllers\API;

use App\Exports\OrdersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new OrderCollection(Order::with('customer:id,name')->latest()->paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $orderRequest)
    {
        $order = Order::create(['name' => $orderRequest->name, 'customer_id' => $orderRequest->customer_id]);

        $products = Product::find($orderRequest->products);
        $order->products()->attach($products);

        return response()->json(['status' => true, 'message' => 'order created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return new OrderResource($order->load('products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $orderRequest, Order $order)
    {
        $order->update( ['name' => $orderRequest->name, 'customer_id' => $orderRequest->customer_id] );

        $products = Product::find($orderRequest->products);
        $order->products()->sync($products);

        return response()->json(['status' => true, 'message' => 'order updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json(['status' => true, 'message' => 'order deleted successfully']);
    }

    /**
     * Search the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search = $request->input('search');

        $result = Order::where('name', 'like', '%'.$search.'%')->orWhereHas('customer', function ($query) use ($search){
            return $query->where('name', 'like', '%'.$search.'%');
        })->paginate(5);

        return new OrderCollection($result->load('customer'));
    }

    /**
     * Export the resource.
     *
     */
    public function export() 
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }
}
