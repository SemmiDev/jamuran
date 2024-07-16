<?php

namespace App\Http\Controllers;

use App\DataTables\BankAccountsDataTable;
use App\Models\BankAccount;
use Illuminate\Http\Request;

class BankAccountsController extends Controller
{
    public function index(BankAccountsDataTable $dataTable)
    {
        return $dataTable->render('admin.bank_accounts.index');
    }

    public function create()
    {
        return view('admin.bank_accounts.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'account_number' => 'required|numeric',
        ]);

        // Create a new bank account with the provided name
        BankAccount::create([
            'name' => $request->input('name'),
            'account_number' => $request->input('account_number'),
        ]);

        // Redirect back with a success message
        return redirect()->route('admin.bank_accounts')->with('success', 'Nomor Rekening berhasil dibuat.');
    }

    public function edit($id)
    {
        $bankAccount = BankAccount::find($id);
        return view('admin.bank_accounts.edit', [
            'bankAccount' => $bankAccount,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'account_number' => 'required|numeric',
        ]);

        // Find the bank account by ID
        $bankAccount = BankAccount::find($id);

        // Check if the bank account exists
        if ($bankAccount) {
            // Update the bank account with the provided name
            $bankAccount->update([
                'name' => $request->input('name'),
                'account_number' => $request->input('account_number'),
            ]);

            // Redirect back with a success message
            return redirect()->route('admin.bank_accounts')->with('success', 'Nomor Rekening berhasil diperbarui.');
        } else {
            // Redirect back with an error message
            return redirect()->route('admin.bank_accounts')->with('error', 'Nomor Rekening tidak ditemukan.');
        }
    }

    public function destroy($id)
    {
        // Find the bank account by ID
        $bankAccount = BankAccount::find($id);

        // Check if the bank account exists
        if ($bankAccount) {
            // Delete the bank account
            $bankAccount->delete();

            // Redirect back with a success message
            return redirect()->route('admin.bank_accounts')->with('success', 'Nomor Rekening berhasil dihapus.');
        } else {
            // Redirect back with an error message
            return redirect()->route('admin.bank_accounts')->with('success', 'Nomor Rekening tidak ditemukan.');
        }
    }
}
