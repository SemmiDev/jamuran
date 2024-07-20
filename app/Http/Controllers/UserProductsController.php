<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\BankAccount;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ShippingCosts;
use Illuminate\Http\Request;

class UserProductsController extends Controller
{
    public function show($id)
    {
        $product = Product::with(['category'])->find($id);
        $addresses = Address::where('user_id', auth()->user()->id)->get();
        $shippingCosts = ShippingCosts::all();

        return view('user.products.show', [
            'product' => $product,
            'addresses' => $addresses,
            'shippingCosts' => $shippingCosts,
        ]);
    }

    public function checkout(Request $request, $id)
    {
        $product = Product::find($id);
        $amount = $product->price * intval($request->get('quantity'));
        $notes = $request->get("notes");
        $address = $request->get("address");
        $shippingCost = ShippingCosts::find($request->get('shippingCost'));

        $order = Order::create([
            'address' => $address,
            'buyer_id' => auth()->id(),
            'shipping_cost' => $shippingCost->shipping_cost,
            'total_price' => $amount + $shippingCost->shipping_cost,
            'notes' => $notes,
            'status' => 'belum_membayar',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $request->get('quantity'),
            'price' => $product->price,
        ]);

        $product->decrement('stock', $request->get('quantity'));
        return redirect()->route('users.orders')->with('success', 'Pemesanan berhasil dibuat, silahkan lakukan pembayaran');
    }

    public function orders(Request $request)
    {
        $belumMembayar = Order::with('items', 'items.product')->where('buyer_id', '=', auth()->user()->id)->where('status', '=', 'belum_membayar')->latest()->get();
        $sudahMembayar = Order::with('items', 'items.product')->where('buyer_id', '=', auth()->user()->id)->where('status', '=', 'sudah_membayar')->latest()->get();
        $verifikasi = Order::with('items', 'items.product')->where('buyer_id', '=', auth()->user()->id)->where('status', '=', 'verifikasi')->latest()->get();
        $dikirim = Order::with('items', 'items.product')->where('buyer_id', '=', auth()->user()->id)->where('status', '=', 'dikirim')->latest()->get();
        $selesai = Order::with('items', 'items.product')->where('buyer_id', '=', auth()->user()->id)->where('status', '=', 'selesai')->latest()->get();

        $totalBelumMembayar = $belumMembayar->count();
        $totalSudahMembayar = $sudahMembayar->count();
        $totalVerifikasi = $verifikasi->count();
        $totalDikirim = $dikirim->count();
        $totalSelesai = $selesai->count();

        return view('user.orders.index', [
            'belumMembayar' => $belumMembayar,
            'sudahMembayar' => $sudahMembayar,
            'verifikasi' => $verifikasi,
            'dikirim' => $dikirim,
            'belumMembayar' => $belumMembayar,
            'selesai' => $selesai,

            'totalBelumMembayar' => $totalBelumMembayar,
            'totalSudahMembayar' => $totalSudahMembayar,
            'totalVerifikasi' => $totalVerifikasi,
            'totalDikirim' => $totalDikirim,
            'totalSelesai' => $totalSelesai,
        ]);
    }
}
