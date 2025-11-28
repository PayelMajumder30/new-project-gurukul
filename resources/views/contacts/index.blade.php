@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Contacts</h2>

        @if(auth()->user()->isAdmin())
            <a href="{{ route('contacts.create') }}" class="btn btn-primary">New Contact</a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    @if(auth()->user()->isAdmin())
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $c)
                    <tr>
                        <td>{{ $c->name }}</td>
                        <td>{{ $c->email }}</td>
                        <td>{{ $c->phone }}</td>
                        <td>{{ $c->address }}</td>
                        @if(auth()->user()->isAdmin())
                        <td>
                            <a href="{{ route('contacts.edit', $c) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('contacts.destroy', $c) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this contact?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->user()->isAdmin() ? 5 : 4 }}" class="text-center">No contacts found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $contacts->links() }}
</div>
@endsection
