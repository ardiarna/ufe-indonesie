<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="generator" content="Hugo 0.101.0">
    <title>UFE</title>
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <style>
      body {
        font-family: Roboto;
        font-style: normal;
        font-weight: normal;
        max-width: 400px;
        margin: auto;
        padding: 10px;
        background: url(images/group_22.png);
        background-repeat: no-repeat;
        background-size: 100% 100%;
      }
    </style>
  </head>
  <body>
    <div class="d-flex justify-content-end pb-4">
      <img src="images/ufe.png" alt="#" width="70" />  
    </div>
    <div class="d-flex justify-content-between align-items-center pb-4">
      <span style="color: rgba(106, 144, 249, 1);">Credit / Debit Card</span>
      <img src="images/cc.png" alt="#" width="50%" height="auto" style="object-fit: contain;" />  
    </div> 
    <form id="frUtama">
      <input type="hidden" name="untukbayar" id="untukbayar" value="<?php echo $_GET['untukbayar']; ?>" />
      <input type="hidden" name="username" id="username" value="<?php echo $_GET['username']; ?>" />
      <input type="hidden" name="email" id="email" value="<?php echo $_GET['email']; ?>" />
      <input type="hidden" name="payment_type" id="payment_type" value="credit_card" />
      <input type="hidden" name="payment_agent" id="payment_agent" />
      <input type="hidden" name="registration_date" id="registration_date" value="<?php echo $_GET['registration_date']; ?>" />
      <input type="hidden" name="id_activites" id="id_activites" value="<?php echo $_GET['id_activites']; ?>" />
      <input type="hidden" name="id_harga" id="id_harga" value="<?php echo $_GET['id_harga']; ?>" />
      <input type="hidden" name="expired_date" id="expired_date" value="<?php echo $_GET['expired_date']; ?>" />
      <input type="hidden" name="donation_date" id="donation_date" value="<?php echo $_GET['donation_date']; ?>" />
      <input type="hidden" name="order_date" id="order_date" value="<?php echo $_GET['order_date']; ?>" />
      <input type="hidden" name="harga" id="harga" value="<?php echo $_GET['harga']; ?>" />
      <input type="hidden" name="id_posisi" id="id_posisi" value="<?php echo $_GET['id_posisi']; ?>" />
      <input type="hidden" name="layout" id="layout" value="<?php echo $_GET['layout']; ?>" />
      <input type="hidden" name="keterangan" id="keterangan" value="<?php echo $_GET['keterangan']; ?>" />
      <div class="d-flex mb-2">
        <input type="text" inputmode="numeric" class="form-control" name="card-number" id="card-number" placeholder="Numéro de Carte de Crédit" />
        <input type="password" inputmode="numeric" class="form-control" name="card-cvv" id="card-cvv" placeholder="CVV" maxlength="3" style="max-width: 100px; margin-left: 10px;"/>
      </div>
      <div class="d-flex mb-3">
        <label for="card-expiry-month" class="col-form-label">Exp.</label>
        <select class="form-select" name="card-expiry-month" id="card-expiry-month" style="margin-left: 10px; margin-right: 10px;">
          <option value="01">01 - Janvier</option>
          <option value="02">02 - Février</option>
          <option value="03">03 - Mars</option>
          <option value="04">04 - Avril</option>
          <option value="05">05 - Mai</option>
          <option value="06">06 - Juin</option>
          <option value="07">07 - Juillet</option>
          <option value="08">08 - Août</option>
          <option value="09">09 - Septembre</option>
          <option value="10">10 - Octobre</option>
          <option value="11">11 - Novembre</option>
          <option value="12">12 - Décembre</option>
        </select>
        <select class="form-select" name="card-expiry-year" id="card-expiry-year" style="max-width: 120px;">
          <option>2022</option>
          <option>2023</option>
          <option>2024</option>
          <option>2025</option>
          <option>2026</option>
          <option>2027</option>
          <option>2028</option>
          <option>2029</option>
          <option>2030</option>
          <option>2031</option>
        </select>
      </div> 
      <!-- <div class="d-flex mb-4 justify-content-center">
        <input class="form-check-input" type="checkbox" value="" id="ckSetuju">
        <label class="form-check-label ms-2" for="ckSetuju">
          Oui, j'accepte les termes et conditions.
        </label>
      </div> -->
      <div class="d-flex justify-content-center pt-3">
        <button type="button" class="btn btn-primary" id="tombolOK" onclick="getTokenDariMidtrans()">Continuer</button>  
      </div>
    </form>
    <div class="d-flex justify-content-center pt-5 pb-2">
      <img src="images/secure_midtrans.svg" alt="Secure payments with Midtrans" width="50%" class="img-thumbnail"/>  
    </div>
    <script id="midtrans-script" type="text/javascript" src="https://api.midtrans.com/v2/assets/js/midtrans-new-3ds.min.js" data-environment="sandbox" data-client-key="SB-Mid-client-6OhXJ4btcTfnfopF"></script>
    <script src="assets/jquery//jquery-3.6.1.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() { 
        // $('#ckSetuju').change(function() { 
        //   if ($(this).is(':checked')) { 
        //     $("#tombolOK").prop('disabled', false); 
        //   } else {
        //     $("#tombolOK").prop('disabled', true);
        //   } 
        // });
      });

      function getTokenDariMidtrans() {
        $("#tombolOK").prop('disabled', true);

        var dataKartu = {
          "card_number": $("#card-number").val(),
          "card_exp_month": $("#card-expiry-month").val(),
          "card_exp_year": $("#card-expiry-year").val(),
          "card_cvv": $("#card-cvv").val()
        };

        // callback functions
        var getCardTokenCallback = {
          onSuccess: function(response) {
            // Success to get card token_id, implement as you wish here
            console.log('Success to get card token_id, response:', response);
            var token_id = response.token_id;
            $("#payment_agent").val(token_id);
            console.log('This is the card token_id:', token_id);
            // Implement sending the token_id to backend to proceed to next step
            if($("#untukbayar").val() == "act") {
              $.ajax({
                type: 'POST',
                url: 'https://ufe-section-indonesie.org/ufeapp/reading_registration.php?mode=tambah',
                data: $("#username, #email, #payment_type, #payment_agent, #registration_date, #id_activites, #id_harga, #expired_date").serialize(),
                success: function(response){
                  console.log('response charge from backend:', response);
                  if (response.data.redirect_url) {
                    window.location.href = response.data.redirect_url;
                  }
                },
                error: function(xhr, status, error){
                  console.error(xhr);
                }
              }); 
            } else if($("#untukbayar").val() == "don") {
              $.ajax({
                type: 'POST',
                url: 'https://ufe-section-indonesie.org/ufeapp/reading_donation.php?mode=tambah',
                data: $("#username, #email, #payment_type, #payment_agent, #donation_date, #harga").serialize(),
                success: function(response){
                  console.log('response charge from backend:', response);
                  if (response.data.redirect_url) {
                    window.location.href = response.data.redirect_url;
                  }
                },
                error: function(xhr, status, error){
                  console.error(xhr);
                }
              }); 
            } else if($("#untukbayar").val() == "adv") {
              $.ajax({
                type: 'POST',
                url: 'https://ufe-section-indonesie.org/ufeapp/reading_iklan.php?mode=bayar',
                data: $("#username, #email, #payment_type, #payment_agent, #order_date, #id_posisi, #id_harga, #layout, #keterangan").serialize(),
                success: function(response){
                  console.log('response charge from backend:', response);
                  if (response.data.redirect_url) {
                    window.location.href = response.data.redirect_url;
                  }
                },
                error: function(xhr, status, error){
                  console.error(xhr);
                }
              });
            }
                 
          },
          onFailure: function(response) {
            console.log('Fail to get card token_id, response:', response);
            $("#tombolOK").prop('disabled', false);
          }
        };

        MidtransNew3ds.getCardToken(dataKartu, getCardTokenCallback);

      }
    </script>
  </body>
</html>
