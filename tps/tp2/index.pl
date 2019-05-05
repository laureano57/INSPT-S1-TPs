#!/usr/bin/perl
use strict;
use warnings;

use CGI qw(:standard);

# Obtengo parametros del formulario (POST)
my $numberToAiken = param("toAiken");
my $numberToStibitz = param("toStibitz");

# Defino array con los 10 digitos codificados en BCD Aiken
my @bcdAiken = ("0000", "0001", "0010", "0011", "0100", "1011", "1100", "1101", "1110", "1111");
my @stibitz = ("0011", "0100", "0101", "0110", "0111", "1000", "1001", "1010", "1011", "1100");

# Creo array donde voy a ir construyendo el resultado
my @output = ();

my $visibility = "hidden";

# Si esta definida la variable, significa que se mando el parametro
if (defined $numberToAiken) {
  # En tal caso, convierto el numero recibido en un array de numeros
  # e itero sobre cada uno de ellos, usando cada numero para llamar a su
  # correspondiente valor del array (por ejemplo, 0 equivale a @bcdAiken[0])
  for my $ch (split //, $numberToAiken) {
    push(@output, @bcdAiken[int($ch)]);
  }
  $visibility = "initial";
}

# Repito para el caso de Stibitz
if (defined $numberToStibitz) {
  for my $ch (split //, $numberToStibitz) {
    push(@output, @stibitz[int($ch)]);
  }
  $visibility = "initial";
}

# Imprimimos template
print "Content-type: text/html\n\n";

print<<EOF;
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
            <h1>Trabajo Práctico Nº 2</h1>
            <h2>Codificadores BCD Aiken y Stibitz</h2>
          </div>

          <form action="/tps/tp2/" method="post">
            <div class="form-wrapper-tp2">
              <p>Ingrese número a codificar en BCD Aiken:</p>
              <div class="input-wrapper">
                <input type="number" min="0" placeholder="Ingrese un entero no negativo..." class="input-aiken"
                  name="toAiken" value="$numberToAiken">
                <input type="submit" value="Convertir" class="submit-aiken">
              </div>
            </div>
          </form>
          <form action="/tps/tp2/" method="post">
            <div class="form-wrapper-tp2">
              <p>Ingrese un número a codificar en Stibitz (XS-3):</p>
              <div class="input-wrapper">
                <input type="number" placeholder="Ingrese un entero no negativo..." class="input-stibitz"
                name="toStibitz" value="$numberToStibitz">
                <input type="submit" value="Convertir" class="submit-stibitz">
              </div>
            </div>
          </form>

          <div class="tp2-resultado" style="visibility: $visibility">
            <p>Resultado:</p>
EOF

# Almaceno el numero codificado en una variable
  my $out = '';
  foreach my $num (@output) {
    $out = $out . $num . " ";
  }

# Termino de imprimir el template con el numero codificado
  print<<EOF;
            <p>$out</p>
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
EOF
