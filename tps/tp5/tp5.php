<?php
// Instrucciones. los valores de registros y memoria luego de ejecutar cada instrucción y descripción de la operación
$instructions = array(
    "0" => array(
        "instructionValue" => "MOV CX, 566E",
        "axValue" => "0000",
        "cxValue" => "566E",
        "memoryValue" => "0000",
        "opDescription" => "Se carga el registro CX con el número 566E"
    ),
    "1" => array(
        "instructionValue" => "MOV[1000], CX",
        "axValue" => "0000",
        "cxValue" => "566E",
        "memoryValue" => "566E",
        "opDescription" => "Se carga en la posición 1000 de memoria el contenido de CX"
    ),
    "2" => array(
        "instructionValue" => "ADD CX, [1000]",
        "axValue" => "0000",
        "cxValue" => "ACDC",
        "memoryValue" => "566E",
        "opDescription" => "Se suman los contenidos del reg. CX y de la pos. de memoria 1000 y se lo asigna a CX"
    ),
    "3" => array(
        "instructionValue" => "MOV AX, CX",
        "axValue" => "ACDC",
        "cxValue" => "ACDC",
        "memoryValue" => "566E",
        "opDescription" => "Se carga el registro AX con el contenido de CX"
    )
);

$instNum = $_POST["number"];
echo json_encode($instructions[$instNum]);
?>