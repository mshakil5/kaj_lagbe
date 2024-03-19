@extends('layouts.user')

@section('content')
<div class="row" id="basic-table">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Job History</h4>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Sl</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">Invoice</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($works as $key => $work)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">{{ $work->date }}</td>
                            <td class="text-center">{{ $work->name }}</td>
                            <td class="text-center">{{ $work->email }}</td>
                            <td class="text-center">{{ $work->phone }}</td>
                            <td style="text-align: center">
                                @if ($work->invoice)
                                    <a href="{{ route('show.invoice', $work->id) }}" class="btn btn-secondary">
                                        Invoice
                                    </a>
                                @else
                                    No Invoice
                                @endif
                            </td>
                            <td class="text-center">
                                @if (!$work->invoice)
                                    <span>
                                        @if ($work->status == 1)
                                            Completed
                                        @elseif ($work->status == 2)
                                            Cancelled
                                        @else
                                            Processing
                                        @endif
                                    </span>
                                @endif

                            </td>
                            <td class="text-center">
                                @if (!$work->invoice)
                                    <a href="{{ route('work.details', $work->id) }}" class="btn btn-primary btn-sm btn-redish-hover">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <form action="{{ route('work.destroy', $work->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-redish-hover" onclick="return confirm('Are you sure you want to delete this work?');">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endif
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
