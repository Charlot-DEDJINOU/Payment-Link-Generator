@include('layout.header')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Informations sur la transaction</div>
                @if (isset($transaction))
                    <div class="card-body">
                        @if ($transaction->status == "PENDING")
                            @include('transaction.requestToPayPend')
                        @elseif ($transaction->status == "SUCCESSFUL")
                            @include('transaction.requestToPaySuccess')
                        @else
                            @include('transaction.requestToPayFail')
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@include('layout.footer')