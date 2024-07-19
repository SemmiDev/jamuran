<?php

namespace App\Http\Controllers;

use App\DataTables\OrdersDataTable;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index(OrdersDataTable $dataTable)
    {
        return $dataTable->render('admin.orders.index');
    }

    public function create()
    {
        return view('admin.orders.create');
    }

    public function show($id)
    {
        $order = Order::find($id);
        $order->load('items.product', 'user'); // Load related order items and user

        return view('admin.orders.show', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::with(['user'])->find($id);

        return view('admin.orders.edit', [
            'order' => $order,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:belum_membayar,sudah_membayar,verifikasi,dikirim,selesai',
        ]);

        $order = Order::with(['user'])->find($id);
        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.orders', ['status' => request('status')])->with('success', 'Pemesanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->delete();
            return redirect()->route('admin.orders', ['status' => request('status')])->with('success', 'Pemesanan berhasil dihapus.');
        } else {
            return redirect()->route('admin.orders', ['status' => request('status')])->with('success', 'Pemesanan tidak ditemukan.');
        }
    }
}
