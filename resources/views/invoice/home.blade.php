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
      <div
        class="d-flex flex-wrap justify-content-between align-items-center mt-5 gap-2 gap-lg-0 gap-md-0"
      >
        <h2 class="main-title">PACKAGE DETAILS</h2>
        <button class="btn-style active">
          Completed <i class="fa-solid fa-circle-check"></i>
        </button>
      </div>
      <div class="card mt-4 py-2">
        <div class="card-body">
          <div class="row gap-4 gap-lg-0 gap-md-0">
            <div class="col">
              <div
                class="d-flex justify-content-start align-items-center gap-3"
              >
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
                @if (Session::has('success'))
                  <div class="alert alert-success alert-dismissible" id="successMessage" role="alert">
                      <button type="button" class="close" data-dismiss="alert">
                          <!-- <i class="fa fa-times"></i> -->
                      </button>

                      {{ session('success') }}
                  </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li style="color:red">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />

                @endif
                <div>
                  <div id="formResult"></div><br />
                  <form class="row row-cols-lg-3 row-cols-1" id="userForm"  method="post" >
                  @csrf
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
                    <div class="col">
                      <input
                        type="text"
                        class="form-control mb-3"
                        placeholder="Phone",
                        name="mobile"
                        required
                      />
                    </div>
                    <div class="col-12">
                      <button type="button" onclick="formSubmit()"  class="btn btn-dark form-btn">
                        Next <i class="fa-solid fa-angle-right fa-sm ms-1"></i>
                      </button>
                    </div>
                  </form>
                
                </div>
              </div>
              
            </div>
          </div>
        </div>
      
    </div>
    <!-- PAYMENT METHOD -->
    <div class="container hiddenPaymentDiv" id ="hiddenPaymentDiv">
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
              <form class="row row-cols-lg-2 row-cols-1">
                <div class="col-12">
                  <div class="form-check mb-3">
                    <input
                      class="form-check-input me-3"
                      type="checkbox"
                      value=""
                      id="paymentCheck"
                    />
                    <label class="form-check-label" for="paymentCheck">
                      <div
                        class="d-flex justify-content-start align-items-start gap-2"
                      >
                        <img
                          src="{{ asset('assets/logos/visa.png') }}"
                          alt="visa icon"
                          width="50px"
                          height="30px"
                        />
                        <img
                          src="{{ asset('assets/logos/master.png') }}"
                          alt="master icon"
                          width="50px"
                          height="30px"
                        />
                        <img
                          src="{{ asset('assets/logos/american_express.png') }}"
                          alt="american express icon"
                          width="50px"
                          height="30px"
                        />
                        <img
                          src="{{ asset('assets/logos/discover.png') }}"
                          alt="discover icon"
                          width="50px"
                          height="30px"
                        />
                      </div>
                    </label>
                  </div>
                </div>
                <div class="col">
                  <input
                    type="text"
                    class="form-control mb-3"
                    placeholder="Card Holder Name"
                    required
                  />
                </div>
                <div class="col">
                  <input
                    type="text"
                    class="form-control mb-3"
                    placeholder="Card Number"
                    required
                  />
                </div>
                <div class="col">
                  <select class="form-select mb-3" required>
                    <option selected>Month</option>
                    <option>January</option>
                    <option>February</option>
                    <option>March</option>
                    <option>April</option>
                    <option>May</option>
                    <option>June</option>
                    <option>July</option>
                    <option>August</option>
                    <option>September</option>
                    <option>October</option>
                    <option>November</option>
                    <option>December</option>
                  </select>
                </div>
                <div class="col">
                  <select class="form-select mb-3" required>
                    <option selected>Year</option>
                    <option>2023</option>
                    <option>2024</option>
                    <option>2025</option>
                    <option>2026</option>
                    <option>2027</option>
                    <option>2028</option>
                    <option>2029</option>
                    <option>2030</option>
                  </select>
                </div>
                <div class="col">
                  <input
                    type="text"
                    class="form-control mb-3"
                    placeholder="Code"
                    required
                  />
                </div>
                <div class="col">
                  <input
                    type="text"
                    class="form-control mb-4"
                    placeholder="Zip Code"
                    required
                  />
                </div>
                <div class="col-12">
                  <button class="btn form-complete-btn">
                    Complete Order
                    <i class="fa-solid fa-circle-check fa-sm ms-1"></i>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
