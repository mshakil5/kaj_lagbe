@extends('layouts.user')

@section('content')

<div class="row mt-3">
    <div class="col-10 mx-auto">
        <div class="card">
            <div class="card-header bg-primary">
                <h2 class="card-title text-white">Job History</h2>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Job ID</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Invoice</th>
                            <th class="text-center">Transactions</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Details</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($works as $key => $work)
                        <tr>
                            <td class="text-center">{{ $work->orderid }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($work->date)->format('d/m/Y') }}</td>
                            <td class="text-center">{{ $work->name }}</td>
                            <td class="text-center">{{ $work->email }}</td>
                            <td class="text-center">
                                @if ($work->invoice->count() > 0)
                                <a href="{{ route('show.invoice', $work->id) }}" class="btn btn-primary">
                                    Invoice
                                </a>
                                @else
                                No Invoice
                                @endif
                            </td>
                            <td class="text-center">
                                @if($work->transactions->count() > 0)
                                <a href="{{ route('show.transactions', $work->id) }}" class="btn btn-primary">
                                    Transactions
                                </a>
                                @else
                                <span>No Transaction</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <span>
                                    @if ($work->status == 1)
                                    New
                                    @elseif ($work->status == 2)
                                    In Progress
                                    @elseif ($work->status == 3)
                                    Completed
                                    @elseif ($work->status == 4)
                                    Cancelled
                                    @endif
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('show.details', $work->id) }}" class="btn btn-primary">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @if ($work->status == 3)
                                <a href="{{ route('user.work.images', $work->id) }}" class="btn btn-primary">
                                    <i class="bi bi-image"></i>
                                </a>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($work->invoice )
                                <a href="{{ route('work.edit', $work->id) }}" class="btn btn-primary btn-sm btn-redish-hover">
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

@endsection