@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Create Contact</h2>

    <div class="card p-3">
        <form action="{{ route('contacts.store') }}" method="POST">
            @include('contacts._form')

            <div class="d-flex gap-2">
                <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</div>
@endsection
