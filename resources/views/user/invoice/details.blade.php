@extends('layouts.user')

@section('content')
<div class="row mt-3">
    <div class="col-10 mx-auto">
        <a href="{{ route('user.works') }}" class="btn btn-primary mb-3">Go Back</a>
        
        @if ($invoice)

        @foreach ($invoice as $invoice)
            <div class="card mt-2">
                <div class="card-header bg-primary">
                    <h2 class="card-title text-white">Invoice Details</h2>
                </div>
                <div class="card-body">
                    
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
                                        <a class="btn btn-primary" href="{{ asset($invoice->img) }}" target="_blank">View Invoice</a>
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
                                    @if ($invoice->status == 0)
                                        <button class="btn btn-primary" disabled>Paid</button>
                                    @elseif ($invoice->status != 0)
                                        <form action="{{ route('payment', $invoice->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="amount" value="{{ $invoice->amount }}">
                                            <input type="hidden" name="work_id" value="{{ $invoice->work_id }}">
                                            <button type="submit" class="btn btn-primary">Pay</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        </table>
                </div>
            </div>
            @endforeach
        @else
            <p class="text-muted">No invoice found for this work.</p>
        @endif
    </div>
</div>
@endsection
