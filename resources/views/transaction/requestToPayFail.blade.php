<div class='resquesttopayfail d-flex flex-column justify-content-center align-items-center'>
    <img class='mb-4 img-fluid w-25' src='{{ asset('assets/yl_fail.png') }}' alt='' width='72' height='57'>
    <h4 class='h4 mb-3 fw-normal text-center'>Un problème est survenue lors du paiement Veuillez réssayez</h4>
    <p>NB: Vérifier que vous avez entrer un numéro Mobile Money Valide</p>
    <div class='paymentbox w-100'>
        <div class='form-floating'>
            <input type='number' class='form-control' id='floatingInput' name='amount' placeholder='Montant' value='100' readonly />
            <label for='floatingInput'>Montant</label>
        </div>
        <div class='form-floating'>
            <input type='tel' class='form-control' id='phone' name='phone' pattern='[0-9]{3}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}' value='{{ $transaction->numero }}' readonly />
            <label for='floatingPassword'>Numéro de téléphone</label>
        </div>
    </div>
</div>