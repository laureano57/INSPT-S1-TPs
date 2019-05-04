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

# Array vacio para armar el resultado
my @output = ();

# Separamos numero por numero y cargamos al array output numero por numero ya codificado
for my $ch (split //, $numberToAiken) {
   push(@output, @bcdAiken[int($ch)]);
}

# if ($numberToAiken != 0) {
#   for my $ch (split //, $numberToAiken) {
#     push(@output, @bcdAiken[int($ch)]);
#   }
# } else if ($numberToStibitz != 0){
#   for my $ch2 (split //, $numberToStibitz) {
#     push(@output, @stibitz[int($ch2)]);
#   }
# }

# Imprimimos template
print "Content-type: text/html\n\n";

print<<EOF;
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title>Sistemas de Computacion 1</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/styles.css" type="text/css">
  <script src="../libs/jquery-3.4.1.min.js"></script>
  <script src="../js/index.js"></script>
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
          <li><a href="../assets/EnunciadoTPs2019.pdf">Consignas</a></li>
          <li class="last"><a href="#">Integrantes</a></li>
        </ul>
      </nav>
    </header>
  </div>
  <!-- content -->
  <div class="wrapper row2">
    <div id="container" class="clear">
      <!-- Aca va el contenido, carga por jQuery -->
      <div id="tp-wrapper">
        <div id="tp-wrapper">
          <div class="tp-header">
            <h1>Trabajo Práctico Nº 2</h1>
            <h2>Codificadores BCD Aiken y Stibitz</h2>
          </div>

          <form action="/cgi-bin/tp2.pl" method="post">
            <div class="form-wrapper-tp2">
              <p>Ingrese número a codificar en BCD Aiken:</p>
              <div class="input-wrapper">
                <input type="number" min="0" placeholder="Cant. de digitos..." class="input-aiken"
                  name="toAiken">
                <input type="submit" value="Convertir">
              </div>
            </div>
            <div class="form-wrapper-tp2">
              <p>Ingrese un número a codificar en Stibitz (XS-3):</p>
              <div class="input-wrapper">
                <input type="number" placeholder="Numero entero..." class="input-stibitz" name="toStibitz">
                <input type="submit" value="Convertir">
              </div>
            </div>
          </form>

          <div class="form-wrapper">
            <p>Resultado:</p>
            <h3 class="tp_resultado">
EOF

# Imprimo el numero codificado
  foreach my $num (@output) {
    print "<span>$num </span>";
  }

# Termino de imprimir el template
  print<<EOF;
            </h3>
          </div>
        </div>
    </div>
  </div>
  <!-- Footer -->
  <div class="wrapper row3">
    <footer id="footer">
      <p class="fl_left">INSPT - Tecnicatura Superior en Informática - 2019</p>
    </footer>
  </div>
</body>

</html>
EOF
