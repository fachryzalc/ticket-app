@extends('welcome')

@section('content')
    @foreach ($orders as $order)
        {{-- dd($order->user_id); --}}
    @endforeach
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Ticket Name</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @if ($orders)
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->total }}</td>
                            <td>{{ $order->status == 1 ? 'Approve' : 'Pending' }}</td>
                            <td></td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
        @endif
    </div>
@endsection
