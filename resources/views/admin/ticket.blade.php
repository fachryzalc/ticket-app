@extends('admin.main')

@push('style')
    @vite(['resources/css/admin/ticket.css'])
@endpush

@section('container')
    @include('sweetalert::alert')
    <div class="body">
        <div class="top">
            <div class="search">
                <form action="{{ url('ticket') }}" method="get">
                    <input type="text" name="key" type="search" value="{{ Request::get('key') }}"
                        placeholder="Search...">
                    <button type="submit"><i class="bi bi-search icon"></i></button>
                </form>
            </div>
            <a href="{{ route('ticket.create') }}"><i class="bi bi-plus icon"></i> New Ticket</a>
        </div>
        <div class="middle">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = $tickets->firstItem(); ?>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <th scope="row" style="text-align: center">{{ $i }}</th>
                            <td>{{ $ticket->name }}</td>
                            <td>Rp. {{ number_format($ticket->price, 2, ',', '.') }}</td>
                            <td>Rp. {{ number_format($ticket->discount, 2, ',', '.') }}</td>
                            <td>{{ $ticket->stock }}</td>
                            <td>{{ $ticket->date }}</td>
                            <td>{{ $ticket->status }}</td>
                            <td>
                                <a href="{{ url('ticket/' . $ticket->id . '/edit') }}" class="button edit">Edit</a>
                                <form class="d-inline" method="post" action="{{ url('ticket/' . $ticket->id) }}"
                                    onsubmit="return confirm('Sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="bottom">
            {{ $tickets->withQueryString()->links() }}
        </div>
    </div>
@endsection
