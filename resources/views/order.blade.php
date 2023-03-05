@extends('welcome')
@section('content')
    <?php
    $cart = session('cart');
    ?>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Ticket Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @if ($cart)
                    @foreach ($cart as $id => $ticket)
                        <?php $subtotal[$id] = $ticket['price'] * $ticket['quantity']; ?>
                        <tr>
                            <td>{{ $ticket['name'] }}</td>
                            <td>{{ $ticket['price'] }}</td>
                            <td>{{ $ticket['quantity'] }}</td>
                            <td>{{ $ticket['subtotal'] }}</td>
                        </tr>
                    @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Total</td>
                    <td><?= array_sum($subtotal) ?></td>
                </tr>
            </tfoot>
        </table>
        <a href="/cart">Back</a>
        <form action="/order" method="post">
            @csrf
            <button type="submit">Pay</button>
        </form>
        <a href="/order/store">Pay</a>
        </form>
        @endif
    </div>
@endsection
