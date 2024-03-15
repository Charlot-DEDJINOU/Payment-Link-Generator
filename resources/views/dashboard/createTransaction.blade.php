@include('layout.header')
@include('dashboard.header')
<section class="section-create-transaction">
    <div class="container login w-100 h-100 d-flex justify-content-center align-items-center">
        <form class="container p-5 background-white row" id="generate-link-form" method="POST">
            @csrf
            <h2 class="text-warning text-center mb-3">Générer un lien de paiement</h2>
            <div class="mb-3 col-md-6">
                <label for="exampleInputName1" class="form-label">Nom du client</label>
                <input type="text" class="form-control" id="exampleInputName1" value="{{ old('customer_lastname') }}" name="customer_lastname" />
            </div>
            <div class="mb-3 col-md-6">
                <label for="exampleInputName1" class="form-label">Prénom du client</label>
                <input type="text" class="form-control" id="exampleInputName1" value="{{ old('customer_firstname') }}" name="customer_firstname" />
            </div>
            <div class="mb-3 col-md-6">
                <label for="plateform" class="form-label">Plateform</label>
                <select class="form-select shadow-none border-none" id="plateform" name="plateform">
                    <option selected disabled value="">Choisissez votre méthode de paiement</option>
                    <option value="Youpilab Component">Youpilab Component</option>
                    <option value="Youpilab Education">Youpilab Education</option>
                    <option value="Dakodo">Dakodo</option>
                    <option value="Youpilab IOT">Youpilab IOT</option>
                </select>
            </div>
            <div class="mb-3 col-md-6">
                <label for="exampleInputMontantl1" class="form-label">Montant</label>
                <input type="number" class="form-control" id="exampleInputMontantl1" value="{{ old('amount') }}" name="amount" />
            </div>
            <div class="form-floating my-3">
                <textarea class="form-control border-none shadow-none" id="floatingTextarea2" style="height: 100px" name="description" value="{{ old('description') }}"></textarea>
                <label for="floatingTextarea2">Description</label>
            </div>
            <div class="mb-3 text-wrap" id="error-generate" style="word-wrap: break-word"></div>
            <div class="mb-3 text-wrap" id="success-generate" style="word-wrap: break-word"></div>
            <button type="submit" class="btn btn-warning text-white">Générer un lien</button>
        </form>
    </div>
</section>
@include('layout.footer')
<script>
    $(document).ready(function () {

        $('#generate-link-form').submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: "/api/transaction",
                method:"POST",
                data :  $(this).serialize(),
                success: function(response){
                    $('#success-generate').addClass('alert alert-success').text("Lien de paiement : " + response.confirmation_link);
                    $('#error-generate').removeClass('alert alert-danger').text('');
                },
                error: function (xhr, status, error) {
                    $('#error-generate').addClass('alert alert-danger').text(error);
                    $('#success-generate').removeClass('alert alert-success').text('');
                },
            });

        });
    });
</script>