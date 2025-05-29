<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function index()
    {
        return response()->json(Order::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|string|unique:orders,order_id',
            'customer_id' => 'required|string|exists:customers,customer_id',
            'order_date' => 'required|date',
            'total_amount' => 'required|numeric',
            'status' => 'required|string'
        ]);

        $order = Order::create($request->all());

        return response()->json([
            'message' => 'Data telah berhasil ditambahkan',
            'data' => $order
        ], 201);
    }

    public function show($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($order, 200);
    }

    public function update(Request $request, $id)
   {
        $request->validate([
            'customer_id' => 'required|string|exists:customers,customer_id',
            'order_date' => 'required|date',
            'total_amount' => 'required|numeric',
            'status' => 'required|string'
        ]);


        $order = Order::find($id);
        if (!$order) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $order->update($request->all());

        return response()->json([
            'message' => 'Data telah berhasil diupdate',
            'data' => $order
        ]);
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $order->delete();

        return response()->json(['message' => 'Data telah berhasil dihapus']);
    }
}
