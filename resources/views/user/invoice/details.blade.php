@extends('layouts.user')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <a href="{{ route('user.works') }}" class="btn btn-secondary mb-3">Go Back</a>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Invoice Details</h4>
                @if ($invoice)
                    <table class="table">
                        <tr>
                            <th>Date:</th>
                            <td class="text-center">{{ \Carbon\Carbon::parse($invoice->date)->format('d/m/Y') }}</td>
                        </tr>    
                        <tr>
                             <th>Invoice ID: </th>
                            <td class="text-center">{{ $invoice->invoiceid }}</td>
                        </tr>
                        <tr>
                            <th>Invoice:</th>
                            <td class="text-center">
                                @if(isset($invoice->img))
                                    <a class="btn btn-secondary" href="{{ asset($invoice->img) }}" target="_blank">View Invoice</a>
                                @else
                                    <span>No invoice available</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Amount:</th>
                            <td class="text-center">{{ $invoice->amount }}</td>
                        </tr>
                        <tr>
                            <th>Send:</th>
                            <td class="text-center">
                                @if ($invoice->status === 0)
                                    <button class="btn btn-secondary" disabled>Paid</button>
                                @elseif ($invoice->status !== 0)
                                    <form action="{{ route('payment') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="amount" value="{{ $invoice->amount }}">
                                        <input type="hidden" name="work_id" value="{{ $invoice->work_id }}">
                                        <button type="submit" class="btn btn-secondary">Pay</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    </table>
                @else
                    <p class="text-muted">No invoice found for this work.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
