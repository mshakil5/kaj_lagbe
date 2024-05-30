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
                            <td style="text-align: center">
                                @if ($work->invoice->count() > 0)
                                    <a href="{{ route('show.invoice', $work->id) }}" class="btn btn-secondary">
                                        Invoice
                                    </a>
                                @else
                                    No Invoice
                                @endif
                            </td>

                            <td class="text-center">
                                @if($work->transactions->count() > 0)
                                    <a href="{{ route('show.transactions', $work->id) }}" class="btn btn-secondary">
                                        Transactions
                                    </a>
                                @else
                                    <span>No Transaction</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <span>
                                    @if ($work->status == 1 )
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
                                <a href="{{ route('show.details', $work->id) }}" class="btn btn-secondary">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>

                            <td class="text-center">
                                @if (!$work->invoice )
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

<!-- <div class="text-center mt-4">
    <div class="mt-2">
        <a href="{{ route('homepage') }}#section_3" class="btn btn-secondary btn-sm">
            Contact Us
        </a>
    </div>
</div> -->

<!-- <a href="https://wa.me/?text=Hello%21%20Hello%20from%20Edge%20administration%2C%20how%20can%20I%20help%20you%3F" class="whatsapp-icon" target="_blank">
    <img src="{{ asset('whatsapp_icon.png') }}" alt="WhatsApp Icon" width="50" height="50">
</a> -->



<!-- <style>
    .whatsapp-icon {
        position: fixed;
        bottom: 50px;
        right: 50px;
        z-index: 1000; 
    }
</style> -->

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
