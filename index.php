<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="icon" type="image/png" href="img/logo.svg">
      <title>El Buen Pescado Tienda</title>
      <!-- Slick Slider -->
      <link rel="stylesheet" type="text/css" href="vendor/slick/slick.min.css"/>
      <link rel="stylesheet" type="text/css" href="vendor/slick/slick-theme.min.css"/>
      <!-- Icofont Icon-->
      <link href="vendor/icons/icofont.min.css" rel="stylesheet" type="text/css">
      <!-- Bootstrap core CSS -->
      <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <!-- Custom styles for this template -->
      <link href="css/style.css" rel="stylesheet">
      <!-- Sidebar CSS -->
      <link href="vendor/sidebar/demo.css" rel="stylesheet">
      <!-- Bootstrap Icons -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
   </head>
   <body class="fixed-bottom-padding">
      <div class="theme-switch-wrapper">
         <label class="theme-switch" for="checkbox">
            <input type="checkbox" id="checkbox" />
            <div class="slider round"></div>
            <i class="icofont-moon"></i>
         </label>
         <em>Enable Dark Mode!</em>
      </div>
      <!-- home page -->
      <div class="osahan-home-page">
         <div class="shadow-sm p-3 fondo">
            <div class="title d-flex align-items-center">
               <a href="index.html" class="text-decoration-none text-dark d-flex align-items-center">
                  <img class="osahan-logo me-2" src="img/logo_white_2x.png">
                  
               </a>
               <!--
               <p class="ms-auto m-0">
                  <a href="notification.html" class="text-decoration-none bg-white p-1 rounded shadow-sm d-flex align-items-center">
                  <i class="text-dark bi bi-bell-fill"></i>
                  <span class="badge badge-danger p-1 ms-1 small">2</span>
                  </a>
               </p> 
               <a class="toggle ms-3 text-white" href="#"><i class="bi bi-list "></i></a> -->
            </div>
            <form id="form1" action="listing.php" method="post">
               <div class="input-group mt-3 rounded shadow-sm overflow-hidden bg-white py-1">
                  <div class="input-group-prepend">
                     <button class="border-0 btn btn-outline-secondary text-success bg-white"><i class="icofont-search"></i></button>
                  </div>
                  <input type="text" class="shadow-none border-0 form-control ps-0" placeholder="Buscar productos.." aria-label="" aria-describedby="basic-addon1" name="buscar">
               </div>
            </form>
         </div>
         <!-- body -->
         <div class="osahan-body">
            <!-- categories -->
            <div class="p-3 osahan-categories">
               <h6 class="mb-2">¿Que necesitas? Elije tu categoria</h6>
               <div class="row m-0">
                  <div class="col ps-0 pe-1 py-1">
                     <div class="bg-white shadow-sm rounded text-center  px-2 py-3 c-it">
                        <a href="listing.php?cat=lacteos">
                           <img src="img/categorie/5.svg" class="img-fluid px-2">
                           <p class="m-0 pt-2 text-muted text-center">Lacteos</p>
                        </a>
                     </div>
                  </div>
                  <div class="col p-1">
                     <div class="bg-white shadow-sm rounded text-center  px-2 py-3 c-it">
                        <a href="listing.php?cat=mariscos">
                           <img src="img/categorie/4.svg" class="img-fluid px-2">
                           <p class="m-0 pt-2 text-muted text-center">Mariscos</p>
                        </a>
                     </div>
                  </div>
                  <div class="col p-1">
                     <div class="bg-white shadow-sm rounded text-center  px-2 py-3 c-it">
                        <a href="listing.php?cat=carnes">
                           <img src="img/categorie/3.svg" class="img-fluid px-2">
                           <p class="m-0 pt-2 text-muted text-center">Carnes</p>
                        </a>
                     </div>
                  </div>
                  <div class="col ps-0 pe-1 py-1">
                     <div class="bg-white shadow-sm rounded text-center  px-2 py-3 c-it">
                        <a href="listing.php?cat=abarrotes">
                           <img src="img/categorie/7.svg" class="img-fluid px-2">
                           <p class="m-0 pt-2 text-muted text-center">Abarrotes</p>
                        </a>
                     </div>
                  </div>
               </div>
               
            </div>
            
            <!-- Promos 
            <div class="py-3 bg-white osahan-promos shadow-sm">
               <div class="d-flex align-items-center px-3 mb-2">
                  <h6 class="m-0">Promos for you</h6>
                  <a href="promos.html" class="ms-auto text-success">See more</a>
               </div>
               <div class="promo-slider">
                  <div class="osahan-slider-item m-2">
                     <a href="promo_details.html"><img src="img/promo1.jpg" class="img-fluid mx-auto rounded" alt="Responsive image"></a>
                  </div>
                  <div class="osahan-slider-item m-2">
                     <a href="promo_details.html"><img src="img/promo2.jpg" class="img-fluid mx-auto rounded" alt="Responsive image"></a>
                  </div>
                  <div class="osahan-slider-item m-2">
                     <a href="promo_details.html"><img src="img/promo3.jpg" class="img-fluid mx-auto rounded" alt="Responsive image"></a>
                  </div>
               </div>
            </div> -->
            <!-- Pick's Today -->
            <div class="title d-flex align-items-center mb-3 mt-3 px-3">
               <h6 class="m-0">Productos del Dia</h6>
               
            </div>
            <!-- pick today -->
            <div class="pick_today px-3">
               <div class="row">
                  <div class="col-6 pe-2  pt-3">
                     <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                        <div class="list-card-image">
                           <a href="product_details.html" class="text-dark">
                              <!-- <div class="member-plan position-absolute"><span class="badge m-3 badge-danger">10%</span></div> -->
                              <div class="p-3">
                                 <img src="img/listing/v1.jpg" class="img-fluid item-img w-100 mb-3">
                                 <h6>Queso Oaxaca</h6>
                                 <div class="d-flex align-items-center">
                                    <h6 class="price m-0 text-success">$30.00 kg</h6>
                           <a href="cart.html" class="btn btn-success btn-sm ms-auto">+</a>
                           </div>
                           </div>
                           </a>
                        </div>
                     </div>
                  </div>
                  <div class="col-6 pe-2  pt-3">
                     <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                        <div class="list-card-image">
                           <a href="product_details.html" class="text-dark">
                              
                              <div class="p-3">
                                 <img src="img/listing/v2.jpg" class="img-fluid item-img w-100 mb-3">
                                 <h6>Mojarra</h6>
                                 <div class="d-flex align-items-center">
                                    <h6 class="price m-0 text-success">$100.00 kg</h6>
                           <a href="cart.html" class="btn btn-success btn-sm ms-auto">+</a>
                           </div>
                           </div>
                           </a>
                        </div>
                     </div>
                  </div>
                  <div class="col-6 pe-2  pt-3">
                     <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                        <div class="list-card-image">
                           <a href="product_details.html" class="text-dark">
                              
                              <div class="p-3">
                                 <img src="img/listing/v3.jpg" class="img-fluid item-img w-100 mb-3">
                                 <h6>Camaron pelado 25</h6>
                                 <div class="d-flex align-items-center">
                                    <h6 class="price m-0 text-success">$130.00 kg</h6>
                           <a href="cart.html" class="btn btn-success btn-sm ms-auto">+</a>
                           </div>
                           </div>
                           </a>
                        </div>
                     </div>
                  </div>
                  <div class="col-6 pe-2  pt-3">
                     <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                        <div class="list-card-image">
                           <a href="product_details.html" class="text-dark">
                              
                              <div class="p-3">
                                 <img src="img/listing/v4.jpg" class="img-fluid item-img w-100 mb-3">
                                 <h6>Arrachera</h6>
                                 <div class="d-flex align-items-center">
                                    <h6 class="price m-0 text-success">$190.00 kg</h6>
                           <a href="cart.html" class="btn btn-success btn-sm ms-auto">+</a>
                           </div>
                           </div>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
               
            </div>
            <!-- Most sales -->
            <div class="title d-flex align-items-center p-3">
               <h6 class="m-0">Recomendaciones</h6>
               <a class="ms-auto text-success" href="recommend.html">26 more</a>
            </div>
            <!-- osahan recommend -->
            <div class="osahan-recommend px-3">
               <div class="row">
                  <div class="col-12 mb-3">
                     <a href="product_details.html" class="text-dark text-decoration-none">
                        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                           <div class="recommend-slider rounded pt-2">
                              <div class="osahan-slider-item m-2 rounded">
                                 <img src="img/recommend/r1.jpg" class="img-fluid mx-auto rounded shadow-sm" alt="Responsive image">
                              </div>
                             
                           </div>
                           <div class="p-3 position-relative">
                              <h6 class="mb-1 font-weight-bold text-success">Fresh Orange
                              </h6>
                              <p class="text-muted">Orange Great Quality item from Jamaica.</p>
                              <div class="d-flex align-items-center">
                                 <h6 class="m-0">$8.8/kg</h6>
                     <a class="ms-auto" href="cart.html">
                     <div class="input-group input-spinner ms-auto cart-items-number">
                     <div class="input-group-prepend">
                     <button class="btn btn-success btn-sm" type="button" id="button-plus"> + </button>
                     </div>
                     <input type="text" class="form-control" value="1">
                     <div class="input-group-append">
                     <button class="btn btn-success btn-sm" type="button" id="button-minus"> − </button>
                     </div>
                     </div>
                     </a>
                     </div>
                     </div>
                     </div>
                     </a>
                  </div>
                  <div class="col-12 mb-3">
                     <a href="product_details.html" class="text-dark text-decoration-none">
                        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                           <div class="recommend-slider rounded pt-2">
                              <div class="osahan-slider-item m-2">
                                 <img src="img/recommend/r2.jpg" class="img-fluid mx-auto rounded shadow-sm" alt="Responsive image">
                              </div>
                              <
                           </div>
                           <div class="p-3 position-relative">
                              <h6 class="mb-1 font-weight-bold text-success">Green Apple</h6>
                              <p class="text-muted">Green Apple Premium item from Vietnam.</p>
                              <div class="d-flex align-items-center">
                                 <h6 class="m-0">$10.8/kg</h6>
                     <a class="ms-auto" href="cart.html">
                     <div class="input-group input-spinner ms-auto cart-items-number">
                     <div class="input-group-prepend">
                     <button class="btn btn-success btn-sm" type="button" id="button-plus"> + </button>
                     </div>
                     <input type="text" class="form-control" value="1">
                     <div class="input-group-append">
                     <button class="btn btn-success btn-sm" type="button" id="button-minus"> − </button>
                     </div>
                     </div>
                     </a>
                     </div>
                     </div>
                     </div>
                     </a>
                  </div>
                  <div class="col-12 mb-3">
                     <a href="product_details.html" class="text-dark text-decoration-none">
                        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                           <div class="recommend-slider rounded pt-2">
                              <div class="osahan-slider-item m-2">
                                 <img src="img/recommend/r3.jpg" class="img-fluid mx-auto rounded shadow-sm" alt="Responsive image">
                              </div>
                              
                           </div>
                           <div class="p-3 position-relative">
                              <h6 class="mb-1 font-weight-bold text-success">Fresh Apple
                              </h6>
                              <p class="text-muted">Fresh Apple Premium item from Thailand.</p>
                              <div class="d-flex align-items-center">
                                 <h6 class="m-0">$12.8/kg</h6>
                     <a class="ms-auto" href="cart.html">
                     <div class="input-group input-spinner ms-auto cart-items-number">
                     <div class="input-group-prepend">
                     <button class="btn btn-success btn-sm" type="button" id="button-plus"> + </button>
                     </div>
                     <input type="text" class="form-control" value="1">
                     <div class="input-group-append">
                     <button class="btn btn-success btn-sm" type="button" id="button-minus"> − </button>
                     </div>
                     </div>
                     </a>
                     </div>
                     </div>
                     </div>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Footer -->
      <?php
         include('includes/footer.php');
      ?>
      
      <!-- Bootstrap core JavaScript -->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- slick Slider JS-->
      <script type="text/javascript" src="vendor/slick/slick.min.js"></script>
      <!-- Sidebar JS-->
      <script type="text/javascript" src="vendor/sidebar/hc-offcanvas-nav.js"></script>
      <!-- Custom scripts for all pages-->
      <script src="js/osahan.js"></script>
   </body>
</html>