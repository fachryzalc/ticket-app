@extends('admin.main')

@push('style')
    @vite(['resources/css/admin/ticket.css'])
@endpush

@section('container')
    @include('sweetalert::alert')
    <div class="body">
        <div class="top">
        </div>
        <div class="middle">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Total</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = $transactions->firstItem(); ?>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <th scope="row" style="text-align: center">{{ $i }}</th>
                            <td>{{ $transaction->user->name }}</td>
                            <td>Rp. {{ number_format($transaction->total, 2, ',', '.') }}</td>
                            <td>{{ $transaction->status == 1 ? 'Approve' : 'Pending' }}</td>

                        </tr>
                        <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="bottom">
            {{ $transactions->withQueryString()->links() }}
        </div>
    </div>
@endsection
