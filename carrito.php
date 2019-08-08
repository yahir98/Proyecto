<?php
require_once 'models/carrito.model.php';
    if(isset($_POST['submit'])){

        foreach($_POST['quantity'] as $key => $val) {
            if($val==0) {
                unset($_SESSION['carrito'][$key]);
            }else{
                $_SESSION['carrito'][$key]['quantity']=$val;
            }
        }

    }
?>

<h1>Ver carrito</h1>
<a href="index.php?page=checkout">Ir a pago por PayPal</a>
<br>
<br>
<a href="index.php?page=dashboard">Volver a pagina principal</a>
<br>
<form method="post" action="carritoindex.php?page=carrito">

    <table>

        <tr>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Total por Articulo</th>
        </tr>

        <?php

            $sql="SELECT * FROM products WHERE id_product IN (";

                    foreach($_SESSION['carrito'] as $id => $value) {
                        $sql.=$id.",";
                    }

                    $sql=substr($sql, 0, -1).") ORDER BY name ASC";
                    $query=mysqli_query($conexion,$sql);
                    $totalprice=0;
                    while($row=mysqli_fetch_array($query)){
                        $subtotal=$_SESSION['carrito'][$row['id_product']]['quantity']*$row['price'];
                        $totalprice+=$subtotal;
                    ?>

                    <?php $_POST['v1'] = $row['name'];
                          $_POST['v2'] = $_SESSION['carrito'][$row['id_product']]['quantity'];
                          $_POST['v3'] = $row['price'];
                          $_POST['v4'] = $_SESSION['carrito'][$row['id_product']]['quantity']*$row['price'];
                     ?>


                        <tr>
                            <td><?php echo $_POST['v1'] ?></td>
                            <td><?php echo $_POST['v2'] ?></td>
                            <td><?php echo $_POST['v3'] ?>$</td>
                            <td><?php echo $_POST['v4'] ?>$</td>
                        </tr>
                          <?php
                              agregarProdTmp($_POST['v1'],$_POST['v2'],$_POST['v3'],$_POST['v4']);
                           ?>

                    <?php



                    }


                    ?>

                    <?php
                      $row=0;
                     ?>


                    <tr>
                        <td colspan="4">Total Precio: <?php echo $totalprice ?></td>
                    </tr>

    </table>
    <br />
</form>
<br />
