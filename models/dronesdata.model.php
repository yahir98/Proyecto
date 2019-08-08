<?php

require_once "libs/dao.php";

/**
 * Obtiene los registro de la tabla de modas
 *
 * @return Array
 */
function obtenerDrones()
{
    $sqlstr = "select `products`.`id_product`,
    `products`.`name`,
    `products`.`description`,
    `products`.`price` from `products`";

    $drones = array();
    $drones = obtenerRegistros($sqlstr);
    return $drones;
}

/**
 * Obtiene un dron por ID
 *
 * @param number $id identificador de el dron
 *
 * @return void
 */
function obtenerDronesPorId($id)
{
  $sqlstr = "select `products`.`id_product`,
  `products`.`name`,
  `products`.`description`,
  `products`.`price` from `products` where id_product=%d";

    $dron = array();
    $dron = obtenerUnRegistro(sprintf($sqlstr, $id));
    return $dron;
}
/**
 * Agrega nuevo dron a la tabla
 *
 * @param string $dscdrones Descripción de el dron
 * @param double $prcdrones Precio de el dron
 * @param double $ivadrones  Impuesto de el dron
 * @param string $estdrones Estado de el dron [ACT, INA, PLN, RET]
 *
 * @return integer affected rows
 */
function agregarNuevoDron($name, $description, $price, $estado) {
    $insSql = "INSERT INTO products(name, description, price)
      values ('%s', '%s', %f);";
      if (ejecutarNonQuery(
          sprintf(
              $insSql,
              $name,
              $description,
              $price
          )))
      {
        return getLastInserId();
      } else {
          return false;
      }
}

function modificarDrones($name, $description, $price, $id_product)
{
    $updSQL = "UPDATE products set name='%s', description='%s',
    price=%f where id_product=%d;";

    return ejecutarNonQuery(
        sprintf(
            $updSQL,
            $name,
            $description,
            $price,
            $id_product
        )
    );
}
function eliminarDrones($id_product)
{
    $delSQL = "DELETE FROM products where id_product=%d;";

    return ejecutarNonQuery(
        sprintf(
            $delSQL,
            $id_product
        )
    );
}

?>
