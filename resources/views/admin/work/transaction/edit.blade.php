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
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('transaction.update', $transaction->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" name="date" id="date" class="form-control" value="{{ $transaction->date }}" required>
                </div>
                <div class="form-group">
                    <label for="amount">Amount:</label>
                    <input type="number" name="amount" id="amount" class="form-control" value="{{ $transaction->amount }}" required>
                </div>
                <div class="form-group">
                    <label for="discount">Discount:</label>
                    <input type="number" name="discount" id="discount" class="form-control" value="{{ $transaction->discount }}" required>
                </div>
                <div class="form-group">
                    <label for="additional_expense">Additional Expense:</label>
                    <input type="number" name="additional_expense" id="additional_expense" class="form-control" value="{{ $transaction->additional_expense }}" required>
                </div>
                <div class="form-group">
                    <label for="due_amount">Due Amount:</label>
                    <input type="number" name="due_amount" id="due_amount" class="form-control" value="{{ $transaction->due_amount }}" required>
                </div>
                <div class="form-group">
                    <label for="net_amount">Net Amount:</label>
                    <input type="number" name="net_amount" id="net_amount" class="form-control" value="{{ $transaction->net_amount }}" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
    <div class="mtb-3">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
