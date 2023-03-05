<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
// use Illuminate\Http\Response;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Response;

use function Termwind\render;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $key = $request->key;

        if ($key) {
            $tickets = Ticket::where('name', 'like', "%$key%")
                ->orWhere('price', 'like', "%$key%")
                ->orWhere('stock', 'like', "%$key%")
                ->paginate(10);
        } else {
            $tickets = Ticket::orderBy('id')->paginate(10);
        }
        return view('admin.ticket')->with(['title' => 'ticket', 'page' => 'ticket', 'tickets' => $tickets]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ticketadd')->with(['title' => 'Ticket Create', 'page' => 'ticket']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->stock > 0) {
            $status = 1;
        } else {
            $status = 2;
        }

        if ($request->dicsount >= 0) {
            $discount = $request->discount;
        } else {
            $discount = 0;
        }

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'discount' => 'nullable|numeric',
            'date' => 'required|date|after:tomorrow',
            'duedate' => 'required|date|before:date'
        ]);

        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'discount' => $discount,
            'stock' => $request->stock,
            'date' => $request->date,
            'duedate' => $request->duedate,
            'status' => $status
        ];

        Ticket::create($data);
        $tickets = Ticket::paginate(5);
        Alert::success('Success', 'New Ticket Added!');
        return view('admin.ticket')->with(['title' => 'ticket', 'page' => 'ticket', 'tickets' => $tickets]);
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
        $data = Ticket::where('id', $id)->first();
        return view('admin.ticketedit')->with(['title' => 'ticket', 'page' => 'ticket', 'ticket' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->stock > 0) {
            $status = 1;
        } else {
            $status = 2;
        }

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'discount' => 'numeric',
            'date' => 'required|date|after:tomorrow',
            'duedate' => 'required|date|before:date'
        ]);

        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'discount' => $request->discount,
            'stock' => $request->stock,
            'date' => $request->date,
            'duedate' => $request->duedate,
            'status' => $status
        ];

        Ticket::where('id', $id)->update($data);
        $tickets = Ticket::paginate(5);
        Alert::success('Success', 'Ticket Updated!');
        return redirect('ticket');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Ticket::where('id', $id)->delete();
        Alert::success('Success', 'Ticket Deleted!');
        return redirect('ticket');
    }
}
