@include('layout.header')
@include('dashboard.header')
@if(isset($success))
    <div class="my-3 alert alert-success">{{ $success }}</div>
@endif
<section>
    <div class="container mt-4">
        <h1 class="text-warning mb-4">Liste des Transactions</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Nom du client</th>
                        <th class="text-center">Prénom du client</th>
                        <th class="text-center">Montant</th>
                        <th class="text-center">Devise</th>
                        <th class="text-center">Plateforme</th>
                        <th class="text-center">Statut</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td class="text-center">{{  $transaction->id }}</td>
                            <td class="text-center">{{  $transaction->customer_lastname }}</td>
                            <td class="text-center">{{  $transaction->customer_firstname }}</td> 
                            <td class="text-center">{{  $transaction->amount }}</td>
                            <td class="text-center">{{  $transaction->currency }}</td>
                            <td class="text-center">{{  $transaction->plateform }}</td>
                            @if ($transaction->status == 'SUCCESSFUL')
                                <td class="text-center text-success">{{ $transaction->status }}</td>
                            @elseif ($transaction->status == 'PENDING')
                                <td class="text-center text-warning">{{ $transaction->status }}</td>
                            @else
                                <td class="text-center text-danger">{{ $transaction->status }}</td>
                            @endif
                            <td class="text-center">
                                @if ($transaction->method == "Mobile Money")
                                    <a href="{{ route('dashboard.refreshtransaction', ['id_generate' => $transaction->id_generate])}}" class="text-decoration-none btn btn-success text-white mx-2 text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-clockwise d-inline-block text-center" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>
                                            <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/>
                                        </svg>
                                    </a>
                                @endif
                                <a href="{{ route('dashboard.transaction', ['id_generate' => $transaction->id_generate])}}" class="text-decoration-none btn btn-warning text-white text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye d-inline-block text-center" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@include('layout.footer')