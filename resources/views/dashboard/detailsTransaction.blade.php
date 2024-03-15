@include('layout.header')
@include('dashboard.header')
<section>
    <div class="container details-transaction mt-5 p-4">
        <h2 class="text-center mb-4 text-warning">Détails de la Transaction</h2>
        <div class="row">
            <div class="col-md-6">
                <h3 class="text-info mb-3">Informations Générales</h3>
                <p style="word-wrap: break-word"><strong>ID de la Transaction:</strong> {{ $transaction->uuid }}</p>
                <p style="word-wrap: break-word"><strong>Montant:</strong> {{ $transaction->amount }} {{ $transaction->curency }}</p>
                <p style="word-wrap: break-word"><strong>Description:</strong> {{ $transaction->description }}</p>
                <p style="word-wrap: break-word"><strong>Plateforme:</strong> {{ $transaction->plateform }}</p>
                <p style="word-wrap: break-word"><strong>Lien de Paiement:</strong> <a href={{ $transaction->payment_link }}>{{ $transaction->payment_link }}</a></p>
                <p style="word-wrap: break-word"><strong>Date d'Expiration:</strong> {{ $transaction->expiration_time }}</p>
                <p style="word-wrap: break-word"><strong>Statut:</strong> {{ $transaction->status }}</p>
            </div>
            <div class="col-md-6">
                <h3 class="text-info mb-3">Détails Client</h3>
                <p style="word-wrap: break-word"><strong>Prénom:</strong> {{ $transaction->customer_firstname }}</p>
                <p style="word-wrap: break-word"><strong>Nom:</strong> {{ $transaction->customer_lastname }}</p>
                <p style="word-wrap: break-word"><strong>Numéro de Téléphone:</strong> {{ $transaction->number }}</p>
                <p style="word-wrap: break-word"><strong>Pays:</strong> {{ $transaction->country }}</p>
                <p style="word-wrap: break-word"><strong>Méthode de Paiement:</strong> {{ $transaction->method }}</p>
                <p style="word-wrap: break-word"><strong>URL de Callback:</strong> {{ $transaction->url_callback }}</p>
                <p style="word-wrap: break-word"><strong>Date de Paiement:</strong> {{ $transaction->payment_date }}</p>
            </div>
        </div>
    </div>
</section>
@include('layout.footer')