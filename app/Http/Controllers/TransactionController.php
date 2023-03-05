<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {

        return response()
            ->view("admin.transaction", [
                "title" => "Ticket Reservation | Ticket",
                "page" => "transaction",
                "transactions" => Order::with(['orderdetails',  'user', 'transaction'])->paginate(10)
            ]);
    }

    public function myorders(): Response
    {
        $orders = DB::table('orders')->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('transactions', 'transactions.order_id', '=', 'orders.id')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->join('tickets', 'tickets.id', '=', 'order_details.ticket_id')
            ->where('orders.user_id', '=', Auth::user()->id)
            ->get();
        // dd($orders);
        return response()
            ->view("myorders", [
                "title" => "Ticket Reservation | My Orders",
                "page" => "order",
                "orders" => $orders
            ]);
    }

    public function approve($id)
    {
        DB::table('transactions')
            ->where('id', $id)
            ->update(['status' => 1]);

        return view("admin.transaction", [
            "title" => "Ticket Reservation | Ticket",
            "page" => "transaction",
            "transactions" => Order::with(['orderdetails',  'user', 'transaction'])->paginate(10)
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transaction = Transaction::where('id', '=', $id);

        dd($transaction);
        return redirect('transaction');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
