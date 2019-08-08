<?php

require_once "models/dronesdata.model.php";
function run()
{
    $viewData = array();
    $viewData["xcfrt"] = md5(microtime());
    $_SESSION["xcfrt"] = $viewData["xcfrt"];
    $viewData["droneslist"] = obtenerDrones();
    renderizar("droneslist", $viewData);
}

run();
?>
