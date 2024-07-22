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

        $bankAccounts = BankAccount::latest()->get();

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
            'bankAccounts' => $bankAccounts,
        ]);
    }

    public function cancelOrder($id)
    {
        $order = Order::with('items')->find($id);
        if ($order) {
            foreach ($order->items as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->increment('stock', $item->quantity);
                }
            }
            $order->delete();
        }
        return redirect()->route('users.orders')->with('success', 'Pesanan berhasil dibatalkan');
    }

    public function payOrder(Request $request, $id)
    {
        $order = Order::find($id);
        if ($order) {
            $validatedData = $request->validate([
                'payment_proof' => 'required|image|mimes:jpg,jpeg,png',
            ]);

            $paymentProof = $validatedData['payment_proof'];
            $fileName = '/orders/payment_proof_' . time() . '.' . $paymentProof->getClientOriginalExtension();

            $paymentProofName = $paymentProof->storeAs('/public', $fileName);

            $order->update([
                'payment_proof' => $fileName,
                'status' => 'sudah_membayar',
            ]);

            return redirect()->route('users.orders')->with('success', 'Pembayaran berhasil diupload. Silakan tunggu verifikasi.');
        } else {
            return redirect()->route('users.orders')->with('error', 'Order tidak ditemukan.');
        }
    }

    public function detail($id)
    {
        $order = Order::find($id);
        $order->load('items.product', 'user'); // Load related order items and user

        return view('user.orders.show', compact('order'));
    }

    public function accept($id)
    {
        $order = Order::find($id);
        $order->update([
            'status' => 'selesai',
        ]);

        return redirect()->route('users.orders')->with('success', 'Pesanan telah diselesaikan.');
    }
}
