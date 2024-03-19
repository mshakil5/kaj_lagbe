@extends('admin.layouts.admin')

@section('content')

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <a href="{{ route('admin.work') }}" class="btn btn-secondary">
                        Back
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @isset($invoice)
                <form action="{{ route('invoices.update', $invoice->work_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="work_id" value="{{ $invoice->work_id }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date">Date:</label>
                                <input type="date" class="form-control" id="date" name="date" value="{{ $invoice->date }}">
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount:</label>
                                <input type="text" class="form-control" id="amount" name="amount" value="{{ $invoice->amount }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h3>Existing Invoice File:</h3>
                                @if ($invoice->img)
                                    <p><a href="{{ asset($invoice->img) }}" target="_blank">View Invoice</a></p>
                                @else
                                    <p>No file found</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <h3>Upload New Invoice File</h3>
                                <label for="file">Choose File:</label>
                                <input type="file" class="form-control-file" id="img" name="img">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Invoice</button>
                </form>

                <form action="{{ route('invoices.destroy', $invoice->work_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this invoice?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn mt-3 btn-danger">Delete Invoice</button>
                </form>
            @else
                <a href="{{ route('invoice.create', ['work_id' => $work->id]) }}" class="btn btn-success">Create New</a>
            @endisset
        </div>
    </div>
</div>

@endsection
