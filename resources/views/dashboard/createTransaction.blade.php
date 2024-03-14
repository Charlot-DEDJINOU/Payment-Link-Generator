@include('layout.header')
@include('dashboard.header')
<section class="section-create-transaction">
    <div class="container login w-100 h-100 d-flex justify-content-center align-items-center">
        <form class="container p-5 background-white" id="generate-link-form" method="POST">
            @csrf
            <h2 class="text-warning text-center mb-3">Générer un lien de paiement</h2>
            <div class="mb-3">
                <label for="exampleInputName1" class="form-label">PlateForme</label>
                <input type="text" class="form-control" id="exampleInputName1" value="{{ old('plateform') }}" name="plateform" />
            </div>
            <div class="mb-3">
                <label for="exampleInputMontantl1" class="form-label">Montant</label>
                <input type="number" class="form-control" id="exampleInputMontantl1" value="{{ old('amount') }}" name="amount" />
            </div>
            <div class="mb-3">
                <label for="exampleInputTypel1" class="form-label">Type</label>
                <input type="text" class="form-control" id="exampleInputTypel1" value="{{ old('type') }}" name="type" />
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