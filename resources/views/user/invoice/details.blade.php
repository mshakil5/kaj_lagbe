@extends('layouts.user')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">

        <a href="{{ route('user.works') }}" class="btn btn-secondary mb-3">Go Back</a>

        <div class="card">

            <div class="card-header">
                <h4 class="card-title">Invoice Details</h4>
                @if ($invoice)
                    <table class="table">
                        <tr>
                            <th>Date:</th>
                            <td class="text-center">{{ $invoice->date }}</td>
                        </tr>
                        <tr>
                            <th>Amount:</th>
                            <td class="text-center">{{ $invoice->amount }}</td>
                        </tr>
                        <tr>
                            <th>Invoice:</th>
                            <td class="text-center">
                                <a class="btn btn-secondary" href="{{ asset($invoice->img) }}" target="_blank">View Invoice</a>
                            </td>
                        </tr>
                    </table>
                @else
                    <p class="text-muted">No invoice found for this work.</p>
                @endif
            </div>

            <div class="card-body">
                @if (isset($success))
                    <div class="alert alert-success" role="alert">
                        {{ $success }}
                    </div>
                @endif

                @if ($invoice && $invoice->status === 0)
                    <div class="text-center mt-4">
                        <button class="btn btn-secondary" disabled>Paid</button>
                    </div>
                    <div class="card mt-4">
                        <div class="card-header">
                            Payment Details
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>Date:</th>
                                    <td class="text-center">{{ $invoice->created_at }}</td>
                                </tr>
                                <tr>
                                    <th>Invoice ID:</th>
                                    <td class="text-center">{{ $invoice->invoiceid }}</td>
                                </tr>
                                <tr>
                                    <th>Amount:</th>
                                    <td class="text-center">{{ $invoice->amount }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                @elseif ($invoice && $invoice->status !== 0)
                    <div class="text-center mt-4">
                        <form action="{{ route('payment') }}" method="POST">
                            @csrf
                            <input type="hidden" name="amount" value="{{ $invoice->amount }}">
                            <input type="hidden" name="work_id" value="{{ $invoice->work_id }}">
                            <button type="submit" class="btn btn-secondary">Pay</button>
                        </form>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
