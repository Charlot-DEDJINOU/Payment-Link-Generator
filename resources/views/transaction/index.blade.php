@include('layout.header')

<section class="section-choice-country d-flex flex-column justify-content-center align-content-center">
    <div class="container d-flex flex-column  justify-content-between align-items-center choice-country pt-5 px-3">
        <img src="{{ asset('assets/logo_yl.png') }}" />
        @if(isset($error))
            <div class="alert alert-danger m-3 w-100 text-center">
               {{ $error }}
            </div>
        @endif
        <form class="container" method="POST" action="{{ isset($id_generate) ? route('transaction.checkPayementMethod', ['id_generate' => $id_generate]) : '#' }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="country" class="form-label">Vous voulez utiliser les methodes de paiement de quel pays ?</label>
                <select class="form-select shadow-none border-none" id="country" name="country">
                    <option selected disabled value="">Choisissez votre pays</option>
                    <option value="Benin">Benin</option>
                    <option value="Ghana">Ghana</option>
                    <option value="Kenya">Kenya</option>
                    <option value="Cote d'Ivoire">Cote d'Ivoire</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="paymentMethod" class="form-label">Méthode de paiement</label>
                <select class="form-select shadow-none border-none" id="paymentMethod" name="paymentMethod">
                    <option selected disabled value="">Choisissez votre méthode de paiement</option>
                    <option value="Mobile Money" country-data="Benin,Ghana,Kenya,Cote d'Ivoire">Mobile Money</option>
                    <option value="MOOV Money" country-data="Benin,Ghana">MOOV Money</option>
                    <option value="Celtis" country-data="Benin,Kenya,Cote d'Ivoire">Celtis</option>
                    <option value="Mastercard" country-data="Kenya,Ghana">Mastercard</option>
                    <option value="Visa" country-data="Cote d'Ivoire,Kenya">Visa</option>
                    <option value="PayPal" country-data="Benin,Ghana">PayPal</option>
                </select>
            </div>
            <button type="submit" class="btn btn-warning text-white">Soumettre</button>
        </form>
        <div class="text-center text-muted my-3">Copy Rigth@ Pay General Invasion</div>
    </div>
</section>
@include('layout.footer')
<script>
    $(document).ready(function () {
        $('#country').change(function () {
            var selectedCountry = $(this).val();

            // Activer toutes les options de la deuxième liste déroulante
            $('#paymentMethod option').prop('disabled', false);

            if (selectedCountry) {
                // Désactiver les options de la deuxième liste déroulante qui ne correspondent pas au pays sélectionné
                $('#paymentMethod option(.' + selectedCountry + ')').prop('hidden', false);
                $('#paymentMethod option:not(.' + selectedCountry + ')').prop('hidden', true);
            }
        });
    });
</script>