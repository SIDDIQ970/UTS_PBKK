<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;


class OrderItemController extends Controller
{
    public function index()
    {
        return response()->json(OrderItem::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|string|unique:order_items,id',
            'order_id' => 'required|string|exists:orders,order_id',
            'product_id' => 'required|string|exists:products,product_id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|integer|min:0'
        ]);

        $orderItem = OrderItem::create($request->all());

        return response()->json([
            'message' => 'Data telah berhasil ditambahkan',
            'data' => $orderItem
        ], 201);
    }

    public function show($id)
    {
        $orderItem = OrderItem::find($id);
        if (!$orderItem) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($orderItem, 200);
    }

    public function update(Request $request, $id)
    {
        $orderItem = OrderItem::find($id);
        if (!$orderItem) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $request->validate([
            'order_id' => 'required|string|exists:orders,order_id',
            'product_id' => 'required|string|exists:products,product_id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|integer|min:0'
        ]);

        $orderItem->update($request->all());

        return response()->json([
            'message' => 'Data telah berhasil diupdate',
            'data' => $orderItem
        ]);
    }

    public function destroy($id)
    {
        $orderItem = OrderItem::find($id);
        if (!$orderItem) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $orderItem->delete();

        return response()->json(['message' => 'Data telah berhasil dihapus']);
    }
}
