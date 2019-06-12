<?php
function toBin($input) {
  $output = '';

}

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
  // Creo el array de salida
  $output = array('compNumber' => '', 'compRatio' => '');

  // Creo el array de subnumeros sobre el que voy a ir concatenando el numero original
  // partido segun 2^bits-1
  $subNumArr = array();
  $auxSubNum = '';
  $count = 0;

  // Recorro todos los numeros

  for($i = 0; $i < count($inputNumArr); $i++) {
    // Voy concatenando numeros en un substring para ir creando el subnumero,
    // tambien voy contando los digitos encontrados para este subnumero.
    // Los subnumeros representan los fragmentos del numero original a codificar
    $auxSubNum .= $inputNumArr[$i];
    $count += 1;

    // Si encontre un 1 o lei mas numeros que 2^n-1...
    if (($count == (pow(2, $bits)-1)) || ($inputNumArr[$i] == '1')) {
      // Agrego el subnumero al array de subnumeros
      array_push($subNumArr, $auxSubNum);
      $auxSubNum = '';
      $count = 0;
    }
    // Si llegue al final del array, agrego el subnumero
    if ($i == count($inputNumArr)-1) {
      array_push($subNumArr, $auxSubNum);
    }
  }

  return $subNumArr;
}

$test = toRle('01101011100000000000010100000011010111111110000', 4);
print('<pre>'.print_r('01101011100000000000010100000011010111111110000', true).'</pre>');
print('<pre>'.print_r($test, true).'</pre>'); die();

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
          <h3 class="tp_resultado"></h3>
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