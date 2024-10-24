@extends('layouts.user')

@section('content')

<div class="row mt-3">
    <div class="col-10 mx-auto">
        <a href="{{ route('user.works') }}" class="btn btn-primary mb-3">Go Back</a>
        <div class="card">
            <div class="card-header bg-primary">
                <h2 class="card-title text-white">Transaction Details</h2>               
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Sl </th>
                             <th class="text-center">Date</th>
                            <th class="text-center">Transaction ID</th>
                            <th class="text-center">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $key => $transaction)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>   
                            <td class="text-center">{{ \Carbon\Carbon::parse($transaction->date)->format('d/m/Y') }}</td>
                            <td class="text-center">{{ $transaction->tranid }}</td>
                            <td class="text-center">{{ $transaction->amount }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
