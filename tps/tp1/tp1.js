(function () {

  function numToXs(num, bits) {
    // Exceso 2^n-1 = numero + 2^bits-1
    var xsBase10 = num + Math.pow(2, bits-1);
    // String para ir construyendo el binario
    var ret = '';

    // #### Validaciones ####

    // Si el numero no fue inicializado aun, no devuelve datos
    if (!num && num != 0) return;

    // Si el numero ingresado es positivo y su modulo es mayor a 2^bits/2 - 1,
    // ó si es negativo y su modulo es mayor a 2^bits/2,
    // no se lo puede representar con tal cantidad de bits
    if (num > 0 && (Math.abs(num) > Math.pow(2, bits)/2 - 1)) return "No se puede representar";
    if (num < 0 && (Math.abs(num) > Math.pow(2, bits)/2)) return "No se puede representar";

    // ######################

    // Convertimos el numero en base 10 a base 2
    while (xsBase10 > 0) {
      // Vamos concatenando el resto de la division al principio del string
      ret = (xsBase10 % 2) + ret;
      xsBase10 = Math.floor(xsBase10 / 2);
    }

    // Si la longitud del numero devuelto es menor que la cantidad de bits, completo
    // los digitos que faltan segun corresponda

    if (ret.length < bits) {
      (num < 0) ? ret = 0 + ret : 0;
    }

    // Expresion regular para partir el string en un array
    // leyendo de derecha a izquierda cada 4 digitos
    var rGroup = new RegExp(/.{1,4}(?=(.{4})*$)/g);

    ret = ret
      .match(rGroup)  // Parte el string cada n digitos
      .join(" ");     // Une el string con espacios

    return ret;
  }

  // ########## jQuery ##########

  $(document).ready(function () {

    // Defino un listener de eventos en cada input para que se recalcule
    // el binario cada vez que se modifica el valor de los mismos.
    $(".tp_numero").on('input', function () {
      var num = parseInt($(this).val());
      var bits = parseInt($(".tp_baseNumerica").val());
      $(".tp_resultado").html(numToXs(num, bits));
    });
    $(".tp_baseNumerica").on('input', function () {
      var num = parseInt($(".tp_numero").val());
      var bits = parseInt($(this).val());
      if (bits > 52) {
        $(".tp_baseNumerica").val('52');
        bits = 52;
      }
      $(".tp_resultado").html(numToXs(num, bits));
    });
  });

  // ############################

}());