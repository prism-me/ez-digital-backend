<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta name="description" content="EZ-Digital Invoice" />
    <!-- favicon -->
    <link rel="icon" href="favicon.png" sizes="16x16" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Custom Js -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- bootstrape link -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
    <!-- fontawesome icons link -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.css"
      integrity="sha512-tx5+1LWHez1QiaXlAyDwzdBTfDjX07GMapQoFTS74wkcPMsI3So0KYmFe6EHZjI8+eSG0ljBlAQc3PQ5BTaZtQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <!-- google font link -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <title>EZ-Digital Invoice</title>
  </head>
  <body>
    <!-- NAVBAR -->
    <nav class="navbar sticky-top">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="{{ asset('assets/logos/ezlogo.png') }}" alt="ez logo" width="160px" height="50px" />
        </a>
      </div>
    </nav>
    <!-- PACKAGE DETAILS -->
    <div class="container">
      <form
        role="form"
        action="{{ route('payment') }}"
        method="post"
        class="require-validation"
        data-cc-on-file="false"
        data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
        id="payment-form">
        @csrf

          @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li style="color:red">{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
          @endif
          @if (Session::has('success'))
            <div class="alert alert-success text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <p>{{ Session::get('success') }}</p>
            </div>
          @endif
          <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 gap-2 gap-lg-0 gap-md-0">
            <h2 class="main-title">PACKAGE DETAILS</h2>
            <button class="btn-style active">
              Completed <i class="fa-solid fa-circle-check"></i>
            </button>
          </div>
          <div class="card mt-4 py-2">
              <div class="card-body">
                <div class="row gap-4 gap-lg-0 gap-md-0">
                  <div class="col">
                    <div class="d-flex justify-content-start align-items-center gap-3">
                      <img
                        src="{{ asset('assets/logos/seo.png') }}"
                        alt="seo icon"
                        width="60px"
                        height="60px"
                        />
                      <div>
                        <h3 class="title mb-2">
                          Auto Search Engine Optimization
                          <i class="fa-regular fa-pen-to-square fa-sm ms-1"></i>
                        </h3>
                        <h3 class="subtitle">3 Months - 1000Aed</h3>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-auto col-sm-12">
                    <div class="table-responsive">
                      <table class="table table-borderless m-0">
                        <tbody>
                          <tr>
                            <td class="table-heading">Subtotal:</td>
                            <td class="table-subheading">1000 Aed</td>
                          </tr>
                          <tr>
                            <td class="table-heading">GST (18%):</td>
                            <td class="table-subheading">400 Aed</td>
                          </tr>
                          <tr>
                            <td class="table-heading">Total:</td>
                            <td class="table-subheading">1400 Aed</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          </div>
          <!-- PERSONAL DETAILS -->
          <div class="container">
            <div class="d-flex justify-content-between align-items-center mt-5">
              <h2 class="main-title">PERSONAL DETAILS</h2>
              <button class="btn-style">
                Completed <i class="fa-solid fa-circle-check"></i>
              </button>
            </div>

            <div class="card mt-4 py-2">
                <div class="card-body">
                  <div class="row gap-4 gap-lg-0 gap-md-0">
                    <div class="col-md-auto col-sm-12">
                      <img
                        src="{{ asset('assets/logos/person.png') }}"
                        alt="person icon"
                        width="100px"
                        height="100px"
                      />
                    </div>
                    <div class="col">
                      <div>
                        <div class="row">
                          <div class="col">
                              <input
                                type="text"
                                class="form-control mb-3"
                                placeholder="Name",
                                name="name"
                                required
                              />
                            </div>
                            <div class="col">
                              <input
                                type="email"
                                class="form-control mb-3"
                                placeholder="Email"
                                name="email"
                                required
                              />
                            </div>
                          </div>
                          <div class="row">
                            <div class="col">
                              <input
                                type="text"
                                class="form-control mb-3"
                                placeholder="Phone",
                                name="mobile"
                                required
                              />
                            </div>
                            <div class="col"></div>
                          </div>
                          <div class="col">
                              <input
                                type="text"
                                class="form-control mb-3"
                                placeholder="Address",
                                name="line1"
                                required
                              />
                            </div>
                          <div class="row">
                            <div class="col">
                              <input
                                type="text"
                                class="form-control mb-3"
                                placeholder="Country",
                                name="country"
                                required
                              />
                            </div>
                            <div class="col">
                              <input
                                type="text"
                                class="form-control mb-3"
                                placeholder="State",
                                name="state"
                                required
                              />
                            </div>
                          </div>
                          <div class="row">
                            <div class="col">
                              <input
                                type="text"
                                class="form-control mb-3"
                                placeholder="City",
                                name="city"
                                required
                              />
                            </div>
                            <div class="col">
                              <input
                                type="text"
                                class="form-control mb-3"
                                placeholder="Postal Code",
                                name="postal_code"
                                required
                              />
                            </div>
                          </div>
                           <div class="row">
                            <div class="col">
                              <input
                                type="text"
                                class="form-control mb-3"
                                placeholder="Description",
                                name="description"
                                required
                              />
                            </div>
                          </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
          </div>
          <!-- PAYMENT METHOD -->
          <div class="container hiddenPaymentDiv1" id ="hiddenPaymentDiv1">
            <div class="d-flex justify-content-between align-items-center mt-5">
              <h2 class="main-title">PAYMENT METHOD</h2>
              <button class="btn-style">
                Completed <i class="fa-solid fa-circle-check"></i>
              </button>
            </div>
            <div class="card mt-4 mb-5 py-2">
              <div class="card-body">
                <div class="row gap-4 gap-lg-0 gap-md-0">
                  <div class="col-md-auto col-sm-12">
                    <img
                      src="{{ asset('assets/logos/payment.png') }}"
                      alt="payment icon"
                      width="100px"
                      height="100px"
                    />
                  </div>
                  <div class="col-md-8 col-sm-12">


                        <div class='form-row row'>
                          <div class='col-xs-12 col-md-6 form-group required'>
                              <label class='control-label'>Name on Card</label> <input
                                  class='form-control' size='4' type='text'>
                          </div>

                          <div class='col-xs-12 col-md-6 form-group required'>
                              <label class='control-label'>Card Number</label> <input
                                  autocomplete='off' class='form-control card-number' size='20'
                                  type='text'>
                          </div>
                      </div>

                      <div class='form-row row'>
                          <div class='col-xs-12 col-md-4 form-group cvc required'>
                              <label class='control-label'>CVC</label> <input autocomplete='off'
                                  class='form-control card-cvc' placeholder='ex. 311' size='4'
                                  type='text'>
                          </div>
                          <div class='col-xs-12 col-md-4 form-group expiration required'>
                              <label class='control-label'>Expiration Month</label> <input
                                  class='form-control card-expiry-month' placeholder='MM' size='2'
                                  type='text'>
                          </div>
                          <div class='col-xs-12 col-md-4 form-group expiration required'>
                              <label class='control-label'>Expiration Year</label> <input
                                  class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                  type='text'>
                          </div>
                      </div>

                        <div id="card-errors" role="alert"></div>
                      </div>
                  </div>
              </div>
          </div>
          <center>
                <div class="row mt-5">
                  <div class="col-xs-12">
                      <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now ($100)</button>
                  </div>
                </div>
          </center>
      </form>
    </div>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">

$(function() {

    /*------------------------------------------
    --------------------------------------------
    Stripe Payment Code
    --------------------------------------------
    --------------------------------------------*/

    var $form = $(".require-validation");

    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true;
        $errorMessage.addClass('hide');

        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
          }
        });

        if (!$form.data('cc-on-file')) {
          e.preventDefault();
         
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }

    });

    /*------------------------------------------
    --------------------------------------------
    Stripe Response Handler
    --------------------------------------------
    --------------------------------------------*/
    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];

            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }

});
</script>
  </body>
</html>