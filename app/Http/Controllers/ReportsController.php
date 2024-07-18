<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        $reportType = $request->get('report-type');
        $startDate = Carbon::parse($request->input('start-date'))->startOfDay();
        $endDate = Carbon::parse($request->input('end-date'))->endOfDay();

        return view('admin.reports.index');
    }

    public function generate(Request $request)
    {
        $reportType = $request->get('report-type');
        $startDate = Carbon::parse($request->input('start-date'))->startOfDay();
        $endDate = Carbon::parse($request->input('end-date'))->endOfDay();

        if ($reportType == "STOCK_REPORT") {
            $reportData = $this->generateStockReport($startDate, $endDate);
            return view('admin.reports.stock-report', compact('reportData', 'startDate', 'endDate'));
        } else if ($reportType == "SALES_REPORT") {
            $reportData = $this->generateSalesReport($startDate, $endDate);
            return view('admin.reports.sales-report', compact('reportData', 'startDate', 'endDate'));
        }

        return view('admin.reports.index');
    }

    private function generateStockReport($startDate, $endDate)
    {
        $reportData = Product::with(['orderItems' => function ($query) use ($startDate, $endDate) {
            $query->whereHas('order', function ($query) use ($startDate, $endDate) {
                $query->where('status', 'selesai') // Filter hanya order dengan status "selesai"
                    ->whereBetween('created_at', [$startDate, $endDate]);
            });
        }])->get()->map(function ($product) {
            $sold = $product->orderItems->sum('quantity');
            $initialStock = $product->stock + $sold;
            return [
                'product_name' => $product->product_name,
                'owner_name' => $product->owner_name,
                'jumlah_awal' => $initialStock,
                'terjual' => $sold,
                'sisa_stok' => $product->stock,
            ];
        });

        return $reportData;
    }


    private function generateSalesReport($startDate, $endDate)
    {
        $salesData = OrderItem::whereHas('order', function ($query) use ($startDate, $endDate) {
            $query->where('status', 'selesai') // Filter hanya order dengan status "selesai"
                ->whereBetween('created_at', [$startDate, $endDate]);
        })
            ->with(['product' => function ($query) {
                $query->select('id', 'product_name', 'owner_name'); // Memilih kolom yang diperlukan dari produk
            }])
            ->selectRaw('product_id, sum(quantity) as jumlah_terjual, sum(price * quantity) as harga_terjual')
            ->groupBy('product_id')
            ->get();

        return $salesData;
    }
}
