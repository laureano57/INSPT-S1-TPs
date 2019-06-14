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

  // La funcion deberia devolver el indice de compresion (los bits?) y el ratio de compresion
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

// $test = toRle('101000000000000000000111111111111111111111111010101010100100111110000000000000000000000000100010000100000100000010000000100000001', 2);
// print('<pre>'.print_r($test, true).'</pre>'); die();
// print('<pre>'.print_r(maxRleComp('0000000000001000000000000000000000000000001000000000000010100000000011100000001111'),true).'</pre>'); die();


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title>Sistemas de Computacion 1</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../../css/styles.css" type="text/css">
  <script src="../../libs/jquery-3.4.1.min.js"></script>
</head>

<body>
  <div class="wrapper row1">
    <header id="header">
      <div id="hgroup">
        <h1>Sistemas de Computación I</h1>
        <h2>Trabajos prácticos de la materia</h2>
        <h2>Grupo 6 - Gonzalez, Olmedo, Stella</h2>
      </div>
      <nav>
        <ul>
          <li><a id="trabajos-practicos" href="/">Trabajos Prácticos</a></li>
          <li><a href="../../assets/EnunciadoTPs2019.pdf">Consignas</a></li>
          <li class="last"><a href="#">Integrantes</a></li>
        </ul>
      </nav>
    </header>
  </div>

  <div class="wrapper row2">
    <div id="container" class="clear">
      <div id="tp-wrapper">
        <div class="tp-header">
          <h1>Trabajo Práctico Nº 3</h1>
          <h2>Compresor RLE</h2>
        </div>
        <div class="form-wrapper">
          <p>Ingrese un número a comprimir:</p>
          <input type="number" placeholder="Numero entero..." class="tp_numero">
        </div>
        <div class="form-wrapper">
          <p>Resultado:</p>
          <h3 class="tp_resultado">
            <?php 
              $out = maxRleComp('0000000000001000000000000000000000000000001000000000000010100000000011100000001111');
              echo '<p>' . $out['rleNum'] . '</p>';
            ?> 
          </h3>
        </div>
      </div>
    </div>
  </div>

  <div class="wrapper row3">
    <footer id="footer">
      <p class="fl_left">INSPT - Tecnicatura Superior en Informática - 2019</p>
      <p class="validators">
        <a href="http://validator.w3.org/check?uri=referer"><img src="../../img/valid-html5.png" alt="Valid HTML 5" height="31" width="88"></a>&nbsp;&nbsp;&nbsp;
        <a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="../../img/vcss.gif" alt="CSS Válido!" height="31" width="88"></a>
      </p>
    </footer>
  </div>
</body>

</html>