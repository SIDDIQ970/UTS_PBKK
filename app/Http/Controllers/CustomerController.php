<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return response()->json(Customer::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|unique:customers,customer_id',
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|min:6',
            'phone' => 'required|string',
            'address' => 'required|string'
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        $customer = Customer::create($data);

        return response()->json([
            'message' => 'Data telah berhasil ditambahkan',
            'data' => $customer
        ], 201);
    }

    public function show($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($customer, 200);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $customer->update($request->all());

        return response()->json([
            'message' => 'Data telah berhasil diupdate',
            'data' => $customer
        ]);
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $customer->delete();

        return response()->json(['message' => 'Data telah berhasil dihapus']);
    }
}
