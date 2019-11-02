(function(){
  $(document).ready(function () {
    let instNum = -1;
    // Todos los elementos de la 1er columna de la tabla (">");
    const tpRows = $(".instructionRow");

    $(".navInstructions button").click(function() {
      const operation = $(this).attr("operation");

      if (operation == "next" && instNum < 3) {
        instNum++;
      } else if (operation == "prev" && instNum > 0) {
        instNum--;
      }
      // AJAX => Post al .php pasando como parámetro el numero de instrucción.
      // Devuelve el resultado y le asigna los valores a las celdas con id = instructionValue, axValue, etc...
      $.post("/tps/tp5/tp5.php", {number: instNum}, function(result){

        // Escondo todas las flechas ">"
        tpRows.find(".arrow").css("visibility", "hidden");
        tpRows.removeClass("active");

        // Muestro la flecha del elemento con id = instNum-x
        $(`#instNum-${instNum} td span`).css("visibility", "initial");
        // Highlight fila naranja
        $(`#instNum-${instNum}`).addClass("active");

        var res = JSON.parse(result);
        // Carga los resultados del ajax en los elementos con los id's definidos
        $("#instValue").html(res.instructionValue);
        $("#axValue").html(res.axValue);
        $("#cxValue").html(res.cxValue);
        $("#memoryValue").html(res.memoryValue);
        $("#opDescription").html(`Descripción: &nbsp;${res.opDescription}`);
      });
    })
  })
}());