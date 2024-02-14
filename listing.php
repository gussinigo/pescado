<?php 
include "includes/conexion.php";
$link = Conectarse();
$busqueda=$_POST['buscar'];
$url= substr($_SERVER['REQUEST_URI'],21);
$categoria=$_GET['cat'];

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="icon" type="image/png" href="img/logo.svg">
      <title>El Buen Pescado | Listado</title>
      <!-- Slick Slider -->
      <link rel="stylesheet" type="text/css" href="../vendor/slick/slick.min.css"/>
      <link rel="stylesheet" type="text/css" href="../vendor/slick/slick-theme.min.css"/>
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
      <div class="osahan-listing">
         <div class="p-3">
            <div class="d-flex align-items-center">
               <a class="fw-bold text-success text-decoration-none" href="index.php">
                  <i class="bi bi-arrow-left back-page"></i>
               </a>
                  <span class="fw-bold ms-3 h6 mb-0"><?php 
                     if(!empty($busqueda)){ echo "Busqueda: ".$busqueda; }
                     if (!empty($categoria)){ echo "Busqueda: ".$categoria; }
                  ?></span>
               <a class="toggle ms-auto" href="#"><i class="bi bi-list"></i></a>
            </div>
         </div>
         <div class="osahan-listing px-3 bg-white">
            <div class="row border-bottom border-top">
               <?php 
                  if(!empty($busqueda)){ $where=" and p.producto like '%$busqueda%'"; }
                  if (!empty($categoria)){ $where.=" and pc.nombre= '$categoria'"; }
               
                  $qrProd = "SELECT * FROM productos p, productos_cat pc where p.idcat=pc.idcat ".$where;  
                              
                  $stmqrProd = $link->prepare($qrProd,array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                  $stmqrProd->execute();
                 
                   while ($rowProd = $stmqrProd->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)){
               ?>
               <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-0 border-end">
                  <div class="list-card-image">
                     <a href="product_details.html" class="text-dark">
                        
                        <div class="p-3">
                           <img src="img/listing/v1.jpg" class="img-fluid item-img w-100 mb-3">
                           <h6><?php echo $rowProd['producto'];?></h6>
                           <div class="d-flex align-items-center">
                              <h6 class="price m-0 text-success"><?php echo $rowProd['costo_venta'];?></h6>
                     <a href="cart.html" class="btn btn-success btn-sm ms-auto">+</a>
                     </div>
                     </div>
                     </a>
                  </div>
               </div>
               <?php 
                   }
               ?>
               
            </div>
            
           
            
            
            <!-- Filter Footer -->
         </div>
      </div>
      <div class="row m-0 text-center border-bottom border-top fixed-bottom bg-white">
         <div class="col-12 p-0 border-end">
            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn text-muted"><i class="icofont-filter me-2"></i> Ordenar</a>
         </div>
         
      </div>
      
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
                  <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close">
                  <!-- <span aria-hidden="true">&times;</span> -->
                  </button>
               </div>
               <div class="modal-body p-0">
                  <div class="osahan-filter">
                     <div class="filter">
                        <!-- SORT BY -->
                        <div class="p-3 bg-light border-bottom">
                           <h6 class="m-0">Ordenar por</h6>
                        </div>
                        <div class="form-check border-bottom px-0 custom-radio">
                           <input type="radio" id="customRadio1" name="location" class="form-check-input" checked>
                           <label class="form-check-label py-3 w-100 px-3" for="customRadio1">Precio mayor a menor</label>
                        </div>
                        <div class="form-check border-bottom px-0 custom-radio">
                           <input type="radio" id="customRadio2" name="location" class="form-check-input">
                           <label class="form-check-label py-3 w-100 px-3" for="customRadio2">Precio menor a mayor</label>
                        </div>
                       
                        
                        
                        
                     </div>
                  </div>
               </div>
               <div class="modal-footer p-0 border-0">
                  <div class="col-6 m-0 p-0 shadow-none">                 
                     <button type="button" class="btn border-top btn-lg border-0 w-100" data-bs-dismiss="modal">Cerrar</button>
                  </div>
                  <div class="col-6 m-0 p-0 shadow-none">     
                     <button type="button" class="btn btn-success btn-lg w-100">Aplicar</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
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