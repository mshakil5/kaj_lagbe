@extends('admin.layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <a href="{{ route('admin.new') }}" class="btn btn-secondary">Back</a>
                    @if (isset($invoice) && $invoice->status == 0)
                        <p class="btn mt-3 btn-secondary" disabled>Paid</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @isset($invoice)
                <form action="{{ route('invoices.update', $invoice->work_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="work_id" value="{{ $invoice->work_id }}">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Date:</td>
                                <td><input type="date" class="form-control" id="date" name="date" value="{{ $invoice->date }}"></td>
                            </tr>
                            <tr>
                                <td>Amount:</td>
                                <td><input type="text" class="form-control" id="amount" name="amount" value="{{ $invoice->amount }}"></td>
                            </tr>
                            <tr>
                                <td>Existing Invoice File:</td>
                                <td>
                                    @if ($invoice->img)
                                        <p><a href="{{ asset($invoice->img) }}" target="_blank">View Invoice</a></p>
                                    @else
                                        <p>No file found</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Upload New Invoice File</td>
                                <td><input type="file" class="form-control-file" id="img" name="img"></td>
                            </tr>
                        </tbody>
                    </table>
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
