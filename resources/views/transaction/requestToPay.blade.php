@include('layout.header')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tansfert d'Argent</div>
                    <div class="card-body">
                        <div id="payLoader" class="" style="display:none">
                            @include('transaction.requestToPayAwait')
                        </div>
                        <div id="content-paie">
                            <form id='form-paie' class="d-flex flex-column justify-content-center align-items-center p-3" method="POST" id_generate={{ $transaction->id_generate }}>
                                @csrf
                                <img src="{{ asset('assets/logo.png') }}" width="250px" height="120px" />
                                <h5 class="modal-title text-center my-3 text-center">Paiement sécurisé par <b class="text-warning">Mobile Money</b></h5>
                                <div class="paymentbox w-100">
                                    <div class="mb-3">
                                        <label for="montantInput">Montant (XOF)</label>
                                        <input type="number" class="form-control" id="montantInput" name="amount" placeholder="Montant" value="{{ $transaction->amount }}" readonly />
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="phone">Numéro de téléphone</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" pattern="[0-9]{3}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" />
                                    </div>
                                </div>
                                <button class="w-100 btn btn-lg btn-warning text-white mt-3" id="btn-paie" type="submit" name="paynow" id="submitrequesttopay">Payer Maintenant</button>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.footer');
<script>
   $(document).ready(function () {

        $('#form-paie').submit(function(e) {
            e.preventDefault();

            var phone = $('#phone').val()

            var requestBody = {
                phone:  phone
            };

            if(phone === '')
                alert("Veuillez donner votre numéro")
            else {
                $("#payLoader").show();
                $("#form-paie").html('');

                const id_generate = this.getAttribute('id_generate');

                $.ajax({
                    url: "/api/collection/rqsttopay/" + id_generate,
                    method: "PUT",
                    data: requestBody,
                    success: function (response) {
                        $("#payLoader").hide();
                        $("#content-paie").html(response.html);
                        
                        if(response.status == 'PENDING') {
                            var intervalId = setInterval(function(){
                                $.ajax({
                                    url: "/api/collection/paymentstatus/" + id_generate,
                                    method:"GET",
                                    success: function(response){
                                        $("#content-paie").html(response.html);
                                    
                                        if (response.status != 'PENDING') {
                                            clearInterval(intervalId);
                                        }
                                    },
                                    error: function (xhr, status, error) {
                                        console.error(error);
                                        clearInterval(intervalId);
                                    }
                                });
                            }, 5000);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
               
            }
        });
    });
</script>