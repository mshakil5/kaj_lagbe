@extends('admin.layouts.admin')

@section('content')
<div class="container pt-3">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <a href="{{ route('admin.complete') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Go back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('invoices.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Date:</td>
                            <td><input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}"></td>
                        </tr>
                        <tr>
                            <td>Amount:</td>
                            <td><input type="text" class="form-control" id="amount" name="amount" value="{{ old('amount') }}"></td>
                        </tr>
                        <tr>
                            <td>Upload Invoice File</td>
                            <td><input type="file" class="form-control-file" id="img" name="img"></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="hidden" name="work_id" value="{{ $work_id }}">
                                <button type="submit" class="btn btn-primary">Create Invoice</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
@endsection
