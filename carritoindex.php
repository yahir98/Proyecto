<?php
//session_start();
   require_once 'includes/connection.php';;
   if(isset($_GET['page'])){

       $pages=array("products", "carrito");

       if(in_array($_GET['page'], $pages)) {

           $_page=$_GET['page'];

       }else{

           $_page="products";

       }

   }else{

       $_page="products";

   }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link rel="stylesheet" href="public/css/reset.css" />
   <link rel="stylesheet" href="public/css/style.css" />


   <title>Carrito de Compras</title>


</head>

<body>

   <div id="container">

       <div id="main">

           <?php require($_page.".php"); ?>

       </div><!--end of main-->

       <div id="sidebar">
         <h1>Carrito</h1>
         <?php

             if(isset($_SESSION['carrito'])){

                 $sql="SELECT * FROM products WHERE id_product IN (";

                 foreach($_SESSION['carrito'] as $id => $value) {
                     $sql.=$id.",";
                 }

                 $sql=substr($sql, 0, -1).") ORDER BY name ASC";
                 $query=mysqli_query($conexion,$sql);
                 while($row=mysqli_fetch_array($query)){

                 ?>
                     <p><?php echo $row['name'] ?> x <?php echo $_SESSION['carrito'][$row['id_product']]['quantity'] ?></p>
                 <?php

                 }
             ?>
                 <hr />
                 <a href="carritoindex.php?page=carrito">Ir al Carrito</a>
                 <br>
                 <a href="index.php?page=dashboard">Ir a pagina principal</a>
             <?php

             }else{

                 echo "<p>Tu carrito esta vacio, agrega algun articulo</p>";

             }

         ?>

       </div><!--end of sidebar-->

   </div><!--end container-->

</body>
</html>
