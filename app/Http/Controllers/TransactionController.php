<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Transaction::query();

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        $transactionsFromDB = $query->with('category')->latest()->get();

        $transactionsFromSession = Session::get('transactions', []);

        return response()->json([
            'transactions_from_db' => $transactionsFromDB,
            'transactions_from_session' => $transactionsFromSession
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'transaction_date' => 'required|date',
                'type' => 'required|in:income,expense',
                'category_id' => 'required|exists:categories,id',
                'amount' => 'required|numeric|min:0',
                'description' => 'required|string',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed!',
                'errors' => $e->errors()
            ], 400);
        }

        // Simpan data ke database
        $transaction = Transaction::create($validatedData);

        // Simpan data ke session
        $transactions = Session::get('transactions', []);
        $transactions[] = $transaction;
        Session::put('transactions', $transactions);

        return response()->json([
            'message' => 'added successfully!',
            'data' => $transaction
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $transaction = Transaction::with('category')->find($id);
        if (!$transaction) {
            return response()->json(['message' => 'transaction not found!'], 404);
        }
        return response()->json($transaction);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json(['message' => 'transaction not found!'], 404);
        }

        try {
            $validatedData = $request->validate([
                'transaction_date' => 'required|date',
                'type' => 'required|in:income,expense',
                'category_id' => 'required|exists:categories,id',
                'amount' => 'required|numeric|min:0',
                'description' => 'required|string',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed!',
                'errors' => $e->errors()
            ], 400);
        }

        $transaction->update($request->all());

        $transactions = Session::get('transactions', []);
        foreach ($transactions as $key => $sessionTransaction) {
            if (isset($sessionTransaction['id']) && $sessionTransaction['id'] == $id) {
                $transactions[$key] = $transaction->toArray();
                Session::put('transactions', $transactions);
                break;
            }
        }

        return response()->json([
            'message' => 'transaction updated successfully!',
            'data' => $transaction
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json(['message' => 'transaction not found!'], 404);
        }

        $transaction->delete();

        return response()->json(['message' => 'transaction successfully deleted!']);
    }
}
