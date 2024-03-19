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
            <form action=" {{ route('store.transaction') }} " method="POST">
                @csrf
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" name="date" id="date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="amount">Amount:</label>
                    <input type="number" name="amount" id="amount" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="discount">Discount:</label>
                    <input type="number" name="discount" id="discount" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="additional_expense">Additional Expense:</label>
                    <input type="number" name="additional_expense" id="additional_expense" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="due_amount">Due Amount:</label>
                    <input type="number" name="due_amount" id="due_amount" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="net_amount">Net Amount:</label>
                    <input type="number" name="net_amount" id="net_amount" class="form-control" required>
                </div>
                <input type="hidden" name="work_id" value="{{ $work_id }}">

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <div class="mtb-3">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
