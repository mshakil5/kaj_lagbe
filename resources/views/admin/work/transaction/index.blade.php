@extends('admin.layouts.admin')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('add.transaction', ['work_id' => $work->id]) }}" class="btn btn-success mt-3">Add New Transaction</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th style="text-align: center">Sl</th> 
                    <!-- <th style="text-align: center">Name</th> -->
                    <th style="text-align: center">Title</th>
                    <th style="text-align: center">Actions</th> <!-- New column for actions -->
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $key => $transaction)
                    <tr>
                        <td style="text-align: center">{{ $key + 1 }}</td> 
                        <!-- <td style="text-align: center">{{ $transaction->work->user->name }}</td> -->
                        <td style="text-align: center">{{ $transaction->work->name }}</td>
                        <td style="text-align: center">
                            <a href="{{ route('transaction.edit', $transaction->id) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('transaction.destroy', $transaction->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this transaction?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </td>


                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>



    <div class="mt-3">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
