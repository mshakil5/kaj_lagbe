@extends('layouts.user')

@section('content')
<div class="row" id="basic-table">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Addresses</h4>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                 <a href="{{ route('additional-addresses.create') }}" class="btn btn-secondary mt-3 float-right btn-redish-hover">Create New</a>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Sl</th>
                            <th class="text-center">First Line</th>
                            <th class="text-center">Second Line</th>
                            <th class="text-center">Third Line</th>
                            <th class="text-center">Town</th>
                            <th class="text-center">Post Code</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($addresses as $key => $address)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">{{ $address->first_line }}</td>
                            <td class="text-center">{{ $address->second_line }}</td>
                            <td class="text-center">{{ $address->third_line }}</td>
                            <td class="text-center">{{ $address->town }}</td>
                            <td class="text-center">{{ $address->post_code }}</td>
                            <td class="text-center">
                                <a href="{{ route('additional-addresses.edit', $address->id) }}" class="btn btn-primary btn-sm btn-redish-hover">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <form action="{{ route('additional-addresses.destroy', $address->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-redish-hover" onclick="return confirm('Are you sure you want to delete this address?');">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-redish-hover {
        transition: background-color 0.3s ease;
    }

    .btn-redish-hover:hover {
        background-color: #dc3545;
        border-color: #dc3545;
    }
</style>
@endsection
