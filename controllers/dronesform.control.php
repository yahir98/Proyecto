<?php
/* Moda Controller
 * 2019-07-01
 * Created By OJBA
 */

require 'models/dronesdata.model.php';
/**
 * Controla la vista de Moda (Un Registro) en modo INS, UPD, DEL, DSP
 *
 * @return void
 */
function run()
{
    $mode = "";
    $errores=array();
    $hasError = false;
    $modeDesc = array(
      "DSP" => "Drones ",
      "INS" => "Creando Nuevo Dron ",
      "UPD" => "Actualizando Dron ",
      "DEL" => "Eliminando Dron "
    );
    $viewData = array();
    $viewData["showIdDron"] = true;
    $viewData["showBtnConfirmar"] = true;
    $viewData["readonly"] = '';
    $viewData["selectDisable"] = '';

    if (isset($_POST["xcfrt"]) && isset($_SESSION["xcfrt"]) &&  $_SESSION["xcfrt"] !== $_POST["xcfrt"]) {
        redirectWithMessage(
            "Petición Solicitada no es Válida",
            "index.php?page=droneslist"
        );
        die();
    }
    $viewData["xcfrt"] = $_SESSION["xcfrt"];
    if (isset($_POST["btnDsp"])) {
        $mode = "DSP";
        $drones = obtenerDronesPorId($_POST["id_product"]);
        $viewData["showBtnConfirmar"] = false;
        $viewData["readonly"] = 'readonly';
        $viewData["selectDisable"] = 'disabled';
        mergeFullArrayTo($drones, $viewData);
        $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["name"];
    }
    if (isset($_POST["btnUpd"])) {
        $mode = "UPD";
        //Vamos A Cargar los datos
        $drones = obtenerDronesPorId($_POST["id_product"]);
        mergeFullArrayTo($drones, $viewData);
        $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["name"];
    }
    if (isset($_POST["btnDel"])) {
        $mode = "DEL";
        //Vamos A Cargar los datos
        $drones = obtenerDronesPorId($_POST["id_product"]);
        $viewData["readonly"] = 'readonly';
        $viewData["selectDisable"] = 'disabled';
        mergeFullArrayTo($drones, $viewData);
        $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["name"];
    }
    if (isset($_POST["btnIns"])) {
        $mode = "INS";
        //Vamos A Cargar los datos
        $viewData["modeDsc"] = $modeDesc[$mode];
         $viewData["showIdDron"]  = false;
    }
    // if ($mode == "") {
    //     print_r($_POST);
    //     die();
    // }
    if (isset($_POST["btnConfirmar"])) {
        $mode = $_POST["mode"];
        $selectedEst = $_POST["estado"];
         mergeFullArrayTo($_POST, $viewData);
        switch($mode)
        {
        case 'INS':
            $viewData["showIdDron"] = false;
            $viewData["modeDsc"] = $modeDesc[$mode];
            //validaciones
            if (floatval($viewData["price"]) <= 0) {
                $errores[] = "El precio de el dron no puede ser 0";
                $hasError = true;
            }
            if (!$hasError && agregarNuevoDron(
                $viewData["name"],
                $viewData["description"],
                $viewData["price"]
            )
            ) {
                redirectWithMessage(
                    "Dron Guardado Exitosamente",
                    "index.php?page=droneslist"
                );
                die();
            }
            break;
        case 'UPD':
            $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["name"];
            if (modificarDrones(
                $viewData["name"],
                $viewData["description"],
                $viewData["price"],
                $viewData["id_product"]
            )
            ) {
                redirectWithMessage(
                    "Dron Actualizado Exitosamente",
                    "index.php?page=droneslist"
                );
                die();
            }
            break;
        case 'DEL':
            $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["name"];
            $viewData["readonly"] = 'readonly';
            $viewData["selectDisable"] = 'disabled';
            if (eliminarDrones(
                $viewData["id_product"]
            )
            ) {
                redirectWithMessage(
                    "Dron Eliminado Exitosamente",
                    "index.php?page=droneslist"
                );
                die();
            }
            break;
        }
    }
    $viewData["mode"] = $mode;
    $viewData["hasErrors"] = $hasError;
    $viewData["errores"] = $errores;
    renderizar("dronesform", $viewData);
}
run();
?>
