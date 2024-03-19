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
            <form action="{{ route('invoices.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date">Date:</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}">
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount:</label>
                            <input type="text" class="form-control" id="amount" name="amount" value="{{ old('amount') }}">
                        </div>
                        <input type="hidden" name="work_id" value="{{ $work_id }}">
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="file">Choose File:</label>
                            <input type="file" class="form-control-file" id="img" name="img">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create Invoice</button>
            </form>
        </div>
    </div>
</div>

@endsection
