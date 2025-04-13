<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function home()
    {
        $data = [
            'page' => 'dashboard'
        ];
        return view("home", $data);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'page' => 'transaction'
        ];
        return view("transaction", $data);
    }

    public function getData()
    {
        $response = Http::get('http://127.0.0.1:8000/api/transactions');
        $data = $response->json();

        return response()->json([
            'data' => $data['transactions_from_db']
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'page' => 'new_transaction'
        ];
        return view("newTransaction", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'page' => 'transaction',
            'id' => $id
        ];

        return view("editTransaction", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
