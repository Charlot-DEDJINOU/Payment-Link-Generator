<div class='resquesttopaysuccessful d-flex flex-column justify-content-center align-items-center'>
    <h4 class='h4 mb-3 fw-normal'>Paiement effectué avec succès</h4>
    <img class='mb-4 img-fluid w-25' src='{{ asset('assets/yl_success.png') }}' alt='' width='50' height='45'>
    <div class='paymentbox container'>
        <div class='form-floating border p-3 mb-3 text-muted' style="border-radius: 5px">
            Vous avez réalisé un paiement d'un montant de {{ $transaction->amount . ' ' . $transaction->currency }}
        </div>
        <div class='form-floating mb-3'>
            <input type='tel' class='form-control shadow-none border-none' id='phone' name='phone' pattern='[0-9]{3}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}' value='{{ $transaction->number }}' readonly>
            <label for='floatingPassword'>Le paiement a été réalisé en utilisant le numéro de téléphone</label>
        </div>
        <div class='form-floating mb-3'>
            <input type='text' class='form-control shadow-none border-none' id='floatingInput' name='status' placeholder='Statut' value='{{ $transaction->status }}' readonly>
            <label for='floatingInput'>État de la transaction financière</label>
        </div>
        <div class='form-floating mb-3'>
            <input type='text' class='form-control payid shadow-none border-none' id='floatingInput' name='externalId' placeholder='Statut' value='{{ $transaction->uuid }}' readonly>
            <label for='floatingInput'>Id du paiement</label>
        </div>
        <div class='form-floating mb-3'>
            <input type='text' class='form-control payid shadow-none border-none' id='floatingInput' name='externalId' placeholder='Statut' value='{{ $transaction->payment_date }}' readonly>
            <label for='floatingInput'>Date de paiment</label>
        </div>
    </div>
</div>