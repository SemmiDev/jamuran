<?php

namespace App\Http\Controllers;

use App\DataTables\CustomersDataTable;
use App\Models\User;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index(CustomersDataTable $dataTable)
    {
        return $dataTable->render('admin.customers.index');
    }

    public function show($id)
    {
        $customer = User::with('orders')->findOrFail($id);
        return view('admin.customers.show', [
            'customer' => $customer
        ]);
    }
}
