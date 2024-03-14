$(document).ready(function () {
  $("#payLoader").hide();

  // Écouter le clic sur le bouton pour déclencher la requête AJAX
  $("#form-paie").submit(function (e) {
    e.preventDefault();

    // Afficher le loader
    $("#payLoader").show();
    $("#form-paie").hide();

    // Effectuer la requête AJAX
    $.ajax({
      url: "api/collection/rqsttopay", // URL de votre script PHP
      method: "POST", // Méthode HTTP (GET ou POST)
      data: $(this).serialize(), // Données à envoyer au script PHP si nécessaire
      success: function (response) {
        // Masquer le loader
        $("#payLoader").hide();
        // Afficher la réponse dans #content-paie
        $("#content-paie").html(response);
        setInterval(function(){
          $.ajax({
            url: "api/collection/paymentstatus",
            method:"POST",
            data :  $(this).serialize(),
            success: function(status){
              $("#content-paie").html(status);
            }
          })
        }, 3000)

      },
      error: function (xhr, status, error) {
        // Gérer les erreurs de la requête AJAX ici
        console.error(error);
      },
    });
  });
  
  // Écouter le clic sur le bouton pour déclencher la requête AJAX
  $("#check-balance").submit(function (e) {
    e.preventDefault();

    // Afficher le loader
    $("#balanceLoader").show();
    $("#check-balance").hide();

    // Effectuer la requête AJAX
    $.ajax({
      url: "api/collection/chkbalance.php", // URL de votre script PHP
      method: "POST", // Méthode HTTP (GET ou POST)
    //   data: $(this).serialize(), // Données à envoyer au script PHP si nécessaire
      success: function (response) {
        // Masquer le loader
        $("#balanceLoader").hide();
        // Afficher la réponse dans #resultat
        $("#account-balance").html(response);
      },
      error: function (xhr, status, error) {
        // Gérer les erreurs de la requête AJAX ici
        console.error(error);
      },
    });
  });

  //TRANSFERT
  $('#form-transfer').submit(function (e){
    e.preventDefault();

    $('#transferLoader').show();
    $('#form-transfer').hide();

    $.ajax({
      url: "api/disbursements/transfer.php",
      method: "POST",
      data: $(this).serialize(),
      success: function(transfer){
          $('#transferLoader').hide();
          $('#content-trans').html(transfer);
          // setInterval(function(){
          //   $.ajax({
          //     url: "api/collection/transferstat.php",
          //     method:"POST",
          //     success: function(status){
          //       $("#content-paie").html(status);
          //     }
          //   })
          // }, 3000)
      },
      error: function(error){
        console.error(error);
      }
    })
  });

  //REFUND
  $('#form-refund').submit(function (e){
    e.preventDefault();

    $('#refundLoader').show();
    $('#form-refund').hide();

    $.ajax({
      url: "api/disbursements/refund.php",
      method: "POST",
      data: $(this).serialize(),
      success: function(refund){
          $('#refundLoader').hide();
          $('#content-refund').html(refund);
      },
      error: function(error){
        console.error(error);
      }
    })
  });
});