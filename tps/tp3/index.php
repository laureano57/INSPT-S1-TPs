<?php
//   echo <<<EOL
// EOL
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
          <p>Ingrese cantidad de bits:</p>
          <input type="number" min="0" max="52" placeholder="Cant. de bits..." class="tp_baseNumerica">
        </div>
        <div class="form-wrapper">
          <p>Ingrese un número a codificar:</p>
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