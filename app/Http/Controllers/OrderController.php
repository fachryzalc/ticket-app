<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Ticket;
use App\Models\OrderDetail;
use App\Models\Transaction;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store()
    {
        $cart = session('cart');
        $subtotal = Arr::pluck($cart, 'subtotal');
        $order = Order::all();

        $data = [
            'id' => count($order) + 1,
            'user_id' => Auth::user()->id,
            'total' => array_sum($subtotal),
            'date' => date(now())
        ];

        Order::create($data);
        $order_id = DB::table('orders')
            ->latest()
            ->select('id')
            ->first();
        $order_id = $order_id->id;

        foreach ($cart as $k => $v) {
            $order_details = [
                'order_id' => $order_id,
                'ticket_id' => $k,
                'total_ticket' => $v['quantity']
            ];
            OrderDetail::create($order_details);

            DB::table('tickets')->where('id', $k)->decrement('stock', $v['quantity']);

            $q = DB::table('tickets')
                ->latest()
                ->select('stock')
                ->first();

            if ($q->stock == 0) {
                DB::table('tickets')
                    ->where('id', $k)
                    ->update(['status' => 0]);
            }
        }

        $transaction = [
            'order_id' => $order_id,
            'status' => 2
        ];

        Transaction::create($transaction);

        session()->forget('cart');
        return view("home", [
            "title" => "Ticket Reservation | Home",
            "page" => "home",
            "tickets" => Ticket::where('status', '=', 1)->get(),
            "expireds" => collect(Ticket::where('status', '=', 0)->get())
        ]);;
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
