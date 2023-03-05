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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($cart)
                    @foreach ($cart as $id => $ticket)
                        <?php $subtotal[$id] = $ticket['price'] * $ticket['quantity']; ?>

                        <tr>
                            <td>{{ $ticket['name'] }}</td>
                            <td>{{ $ticket['price'] }}</td>
                            <td>
                                <div class="button-container">
                                    @if ($ticket['quantity'] > 1)
                                        <a href="/updatecart/{{ $id }}">-</a>
                                    @endif
                                    <input type="text" name="qty" class="qty" maxlength="1"
                                        value="{{ $ticket['quantity'] }}" class="input-text qty" />
                                    @if ($ticket['quantity'] < 4)
                                        <a href="/addtocart/{{ $id }}">+</a>
                                    @endif

                            </td>
                            <td>{{ $subtotal[$id] }}</td>
                            <td>
                                <a href="/deletecart/{{ $id }}">Delete</a>
                            </td>
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
        <a href="/">Back</a>
        <form action="/order" method="post">
            @csrf
            <button type="submit">Checkout</button>
        </form>
        @endif
    </div>
@endsection

@push('script')
@endpush
