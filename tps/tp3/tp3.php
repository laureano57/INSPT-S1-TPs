<?php

// Comprime un numero en RLE-n, donde $bits es n y $inputNum es el binario a comprimir
function toRle($inputNum, $bits) {
  // La funcion debe partir el $inputNum en subnumeros, los cuales van a ser los fragmentos
  // a codificar segun la cantidad de ceros que tengan.
  // Ejemplo:
    // Codificacion RLE-3
    // Usa caracteres de 3 bits:
    // 000 - 0 ceros y 1 uno
    // 001 - 1 cero y 1 uno
    // 010 - 2 ceros y 1 uno
    // 011 - 3 ceros y 1 uno
    // …
    // 111 - 7 ceros y 1 uno

  // La funcion deberia devolver el indice de compresion, los bits y el ratio de compresion
  // (salida/entrada). Esta funcion deberia ser usada por otra funcion que tome como parametro
  // la cantidad de indices de compresion con los que probar y la ejecute iterativamente,
  // juntando cada par de (indice_comp, ratio_comp) para analizar al final cual de todos los
  // indices de compresion es el mejor.
  // Es probable que debamos demostrarlo por pantalla, asi que esta funcion deberia contemplar
  // la impresion de cada una de las iteraciones.

  // Creo un array a partir del numero (string) ingresado
  $inputNumArr = str_split($inputNum, 1);

  // Creo el array de subnumeros sobre el que voy a ir concatenando el numero original
  // partido segun 2^bits-1
  $subNumArr = array();
  // Creo el auxiliar sobre el que voy a concatenar cada subnumero
  $auxSubNum = '';
  // Creo la variable sobre la que voy a concatenar todos los subnumeros comprimidos
  $compressed = '';
  $count = 0;

  // Recorro todos los numeros
  for($i = 0; $i < count($inputNumArr); $i++) {
    // Voy concatenando numeros en un substring auxiliar para ir creando el subnumero,
    // tambien voy contando los digitos encontrados para este subnumero.
    // Los subnumeros representan los fragmentos del numero original a codificar
    $auxSubNum .= $inputNumArr[$i];
    $count += 1;

    // Si lei mas numeros que 2^n-1, encontre un 1 o llegue al final del array, corto
    if (($count == (pow(2, $bits)-1)) || ($inputNumArr[$i] == '1') || ($i == count($inputNumArr)-1)) {
      // Cuento la cantidad de ceros que tiene el substring, lo convierto a binario y le agrego ceros a la izquierda
      // hasta completar la cantidad de bits de la compresion (para que devuelva binarios de $bits bits).
      $auxSubNumComp = str_pad(decbin(substr_count($auxSubNum, '0')), $bits, '0', STR_PAD_LEFT);

      // Voy concatenando los subnumeros comprimidos
      $compressed .= $auxSubNumComp;
      // Reseteo auxiliares
      $auxSubNum = '';
      $count = 0;
    }
  }
  // Cuento longitud de entrada y salida
  $input_len = strlen($inputNum);
  $output_len = strlen($compressed);

  // Creo el array de salida con todos los datos
  $output = array(
    'original' => $inputNum,
    'compressed' => $compressed,
    'input_len' => $input_len,
    'output_len' => $output_len,
    'comp_ratio' => $input_len / $output_len
  );

  return $output;
}

function maxRleComp($inputNum) {
  $bit = 1;
  $rleComp = toRle($inputNum, $bit);
  $max = 0;

  while($max < $rleComp['comp_ratio']) {
    $bit++;
    $max = $rleComp['comp_ratio'];
    $rleComp = toRle($inputNum, $bit);
  }

  return array(
    'rleNum' => $bit,
    'rleComp' => toRle($inputNum, $bit-1)
  );
}

$output = maxRleComp($_POST['number']);

echo json_encode($output);
?>