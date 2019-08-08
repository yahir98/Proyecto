<?php
require_once 'libs/paypal.php';
require_once 'includes/connection.php';
/**
 * Renderizado de Documento
 *
 * @return void
 */

function run()
{
  $server="127.0.0.1";
  $user="greentec";
  $pass="123456";
  $db="greentec";
  $port="3306";

  $conexion = new mysqli(
      $server, $user, $pass, $db, $port
  );

  if ($conexion->connect_errno ) {
      die($conexion->connect_error);
  }

  $conexion->set_charset("utf8");


  $sql="SELECT * FROM tmp_prod ORDER BY nombre ASC";
  $data= mysqli_query($conexion,$sql);

  while ($row=mysqli_fetch_array($data)) {
    $name[]=$row['nombre'];
    $quantity[]=$row['cantidad'];
    $price[]=$row['price'];
    $pricetot[]=$row['pricetot'];
  }

    $viewData = array();
    //Esto lo saca de la carretilla de compras
    $sqlcount=	"SELECT * FROM tmp_prod";
    $data= mysqli_query($conexion,$sqlcount);
    $total = mysqli_num_rows($data);
    $tot2 = $total;
    $a=0;
    while ($tot2>0) {
        $myItems[$a] =
        array(
            "sku"=>$a,
            "name"=>$name[$a],
            "quantity"=>$quantity[$a],
            "price"=>$price[$a],
            "subtotal"=>$pricetot[$a],
        );

      $a=$a+1;
      $tot2=$tot2-1;
    }


    $viewData["items"] = $myItems;

    if (isset($_POST["btnSubmit"]))
    {
        $viewData  = $_POST;
        $payPalReturn = createPaypalTransacction(0, $myItems);
        if ($payPalReturn)
        {
            redirectToUrl($payPalReturn);
        }
        $viewData["returndata"] = $payPalReturn;
        $sql="DELETE FROM tmp_prod";
        $data= mysqli_query($conexion,$sql);
        redirectWithMessage(
            "Pago realizado con exito",
            "index.php?page=droneslist"
        );
    }
    renderizar("checkout", $viewData);
}

/**
 * Undocumented function
 *
 * @param [type] $_amount Cantidad a Realizar en la transacción
 * @param array  $_items  Productos a Solicitar Pago
 *
 * @return array datos de la transaccion por paypal
 */
function createPaypalTransacction( $_amount , $_items )
{
    $apiContext = getApiContext();
    $payer = new \PayPal\Api\Payer();
    $payer->setPaymentMethod('paypal');

    $items = new \PayPal\Api\ItemList();
    $_amount = 0 ;
    foreach ($_items as $_item) {
        $item = new \PayPal\Api\Item();
        $item->setSku($_item["sku"]);
        $item->setName($_item["name"]);
        $item->setQuantity($_item["quantity"]);
        $item->setPrice($_item["price"]);
        $_amount += floatval($_item["price"]);
        $item->setCurrency('USD');
        $items->addItem($item);
    }

    $amount = new \PayPal\Api\Amount();
    $amount->setTotal(strval($_amount));
    $amount->setCurrency('USD');

    $transaction = new \PayPal\Api\Transaction();
    $transaction->setAmount($amount);
    $transaction->setNoteToPayee("Venta de Paquete para un mes de EdnaModas");
    $transaction->setItemList($items);

    $redirectUrls = new \PayPal\Api\RedirectUrls();

    $redirectUrls
        ->setReturnUrl("http://localhost/mvc/index.php?page=checkoutapp")
        ->setCancelUrl("http://localhost/mvc/index.php?page=checkoutcnl");

    $payment = new \PayPal\Api\Payment();
    $payment->setIntent('sale')
        ->setPayer($payer)
        ->setTransactions(array($transaction))
        ->setRedirectUrls($redirectUrls);

    try {
        $payment->create($apiContext);
        $_SESSION["paypalTrans"] = $payment;
        return $payment->getApprovalLink();
    } catch (\PayPal\Exception\PayPalConnectionException $ex) {
        // This will print the detailed information on the exception.
        //REALLY HELPFUL FOR DEBUGGING
        error_log($ex->getData());
        return false;
    }
}

run();
?>
