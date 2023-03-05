@extends('admin.main')

@push('style')
    @vite(['resources/css/admin/ticketedit.css'])
@endpush

@section('container')
    <div class="form">
        <form action="{{ url('ticket/' . $ticket->id) }}" method="post">
            @csrf
            @method('PUT')
            <label for="">Name</label>
            <input type="text" name="name" class="@error('name')
                is-invalid
            @enderror"
                autofocus value="{{ old('name') ? old('name') : $ticket->name }}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <label for="">Price</label>
            <input type="text" name="price" class="@error('price')
            is-invalid
        @enderror"
                value="{{ old('price') ? old('price') : $ticket->price }}">
            @error('price')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <label for="">Stock</label>
            <input type="text" name="stock" class="@error('stock')
            is-invalid
        @enderror"
                value="{{ old('stock') ? old('stock') : $ticket->stock }}">
            @error('stock')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <label for="">Date</label>
            <input type="date" name="date" class="@error('date')
            is-invalid
        @enderror"
                value="{{ old('date') ? old('date') : $ticket->date }}">
            @error('date')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <label for="">DueDate</label>
            <input type="duedate" name="duedate" class="@error('dueduedate')
            is-invalid
        @enderror"
                value="{{ old('duedate') ? old('duedate') : $ticket->duedate }}">
            @error('duedate')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <a href="{{ url('ticket') }}">Back</a>
            <button type="submit">Save</button>
        </form>
    </div>
@endsection
