<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Ticket;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()
            ->view("cart", [
                "title" => "Ticket Reservation | Cart",
                "page" => 'cart',
                "cart" => session('cart')
            ]);
    }

    public function addToCart($id)
    {
        $ticket = Ticket::find($id);

        if (!$ticket) {
            abort(404);
        }

        $cart = session()->get('cart');
        $price = $ticket->price - $ticket->discount;

        // $data = DB::table('orders')
        //     ->join('order_details', 'orders.id', '=', 'order_details.order_id')
        //     ->where('order_details.ticket_id', '=', $ticket->id)
        //     ->where('orders.user_id', '=', Auth::user()->id)
        //     ->get('total_ticket');
        // $total_ticket[0] = 0;
        // dd($data);

        if (isset($cart[$id])) {
            $stock = $ticket->stock - $cart[$id]['quantity'];
            if ($cart[$id]['quantity'] <= 4 && $stock > 0 && $ticket->stock > 0) {
                $cart[$id]['quantity']++;
                $cart[$id]['subtotal'] = $cart[$id]['quantity'] * $cart[$id]['price'];
                session()->put('cart', $cart);

                $cart[$id] = [
                    "name" => $ticket->name,
                    "quantity" => 1,
                    "price" => $price,
                    "subtotal" => $price
                ];
                Alert::success('Success', 'Success add ' . $ticket->name . ' to cart');
                return redirect()->back();
            } else {
                Alert::error('Error', 'Max buy 4 | Stock not enough');
                return redirect()->back();
            }
        }
        $cart[$id] = [
            "name" => $ticket->name,
            "quantity" => 1,
            "price" => $price,
            "subtotal" => $price
        ];

        session()->put('cart', $cart);
        Alert::success('Success', 'Success add ' . $ticket->name . ' to cart');
        return redirect()->to('/cart');
    }

    public function updateCart($id)
    {
        $cart = session('cart');
        $oldcart = $cart[$id];
        unset($cart[$id]);
        if ($oldcart['quantity'] <= 1) {
            abort(404);
        }
        $quantity = $oldcart['quantity'] - 1;
        $cart[$id] = [
            "name" => $oldcart['name'],
            "quantity" => $quantity,
            "price" => $oldcart['price'],
            "subtotal" => $oldcart['price'] * $quantity
        ];
        session()->put('cart', $cart);
        Alert::success('Success', 'Success update cart');
        return redirect()->back();
    }

    public function deleteCart($id)
    {
        $cart = session('cart');
        unset($cart[$id]);

        session()->put('cart', $cart);
        Alert::success('Success', 'Success delete cart');
        return redirect()->back();
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
