@extends('admin.main')

@push('style')
    @vite(['resources/css/admin/ticketadd.css'])
@endpush

@section('container')
    <div class="=form">
        <form action="{{ url('ticket') }}" method="post">
            @csrf
            <label for="">Name</label>
            <input type="text" name="name" class="@error('name')
                is-invalid
            @enderror"
                autofocus value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <label for="">Price</label>
            <input type="text" name="price" class="@error('price')
            is-invalid
        @enderror"
                value="{{ old('price') }}">
            @error('price')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <label for="">Discount</label>
            <input type="text" name="discount" class="@error('discount')
            is-invalid
        @enderror"
                value="{{ old('discount') }}">
            @error('discount')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <label for="">Stock</label>
            <input type="text" name="stock" class="@error('stock')
            is-invalid
        @enderror"
                value="{{ old('stock') }}">
            @error('stock')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <label for="">Date</label>
            <input type="date" name="date" class="@error('date')
            is-invalid
        @enderror"
                value="{{ old('date') }}">
            @error('date')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <label for="">Due Date</label>
            <input type="date" name="duedate" class="@error('duedate')
            is-invalid
        @enderror"
                value="{{ old('duedate') }}">
            @error('duedate')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <button type="submit">Save</button>
        </form>
    </div>
@endsection
