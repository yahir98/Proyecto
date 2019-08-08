<?php

require_once "libs/dao.php";

/**
 * Obtiene los registro de la tabla de modas
 *
 * @return Array
 */
function obtenerTemporal()
{
    $sqlstr = "select `tmp_prod`.`id_product`,
    `tmp_prod`.`nombre`,
    `tmp_prod`.`cantidad`,
    `tmp_prod`.`price`,
    `tmp_prod`.`pricetot` from `tmp_prod`";

    $tmp = array();
    $tmp = obtenerRegistros($sqlstr);
    return $tmp;
}

/**
 * Obtiene un dron por ID
 *
 * @param number $id identificador de el dron
 *
 * @return void
 */

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
function agregarProdTmp($nombre,$cantidad,$price,$pricetot) {
    $insSql = "INSERT INTO tmp_prod(nombre,cantidad,price,pricetot)
      values ('%s', %d, %f, %f);";
      if (ejecutarNonQuery(
          sprintf(
              $insSql,
              $nombre,
              $cantidad,
              $price,
              $pricetot
          )))
      {
        return getLastInserId();
      } else {
          return false;
      }
}

function eliminarTmp()
{
    $delSQL = "DELETE FROM tmp_prod;";

    return ejecutarNonQuery(
        sprintf(
            $delSQL
        )
    );
}
