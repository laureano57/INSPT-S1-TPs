(function(){
  $(document).ready(function () {
    let instNum = -1;
    let stepNum = 0;
    let steps;
    // Todos los elementos de la 1er columna de la tabla (">");
    const tpRows = $(".instructionRow");

    $(".navSteps button").click(function() {
      const operation = $(this).attr("operation");
      if (!steps) return;

      // Incrementa step
      if (operation == "next") {
        if (stepNum == steps.length-1) return;
        stepNum++;
      } else if (operation == "prev" && stepNum > 0) {
        stepNum--;
      }

      // Borra highlight de steps
      $('.registry-table tr').removeClass('active');
      $('.memory-table tr').removeClass('active');

      // Resalta nuevos cambios
      steps[stepNum].ip.changed ? $('#ip').parent().addClass('active') : 0;
      steps[stepNum].ri.changed ? $('#ri').parent().addClass('active') : 0;
      steps[stepNum].ax.changed ? $('#ax').parent().addClass('active') : 0;
      steps[stepNum].cx.changed ? $('#cx').parent().addClass('active') : 0;
      steps[stepNum].rdi.changed ? $('#rdi').parent().addClass('active') : 0;
      steps[stepNum].rda.changed ? $('#rda').parent().addClass('active') : 0;
      steps[stepNum].mem1000.changed ? $('#mem1000').parent().addClass('active') : 0;
      steps[stepNum].mem1001.changed ? $('#mem1001').parent().addClass('active') : 0;

      // Setea nuevo estado
      $('#ip').html(steps[stepNum].ip.data);
      $('#ri').html(steps[stepNum].ri.data);
      $('#ax').html(steps[stepNum].ax.data);
      $('#cx').html(steps[stepNum].cx.data);
      $('#rdi').html(steps[stepNum].rdi.data);
      $('#rda').html(steps[stepNum].rda.data);
      $('#mem1000').html(steps[stepNum].mem1000.data);
      $('#mem1001').html(steps[stepNum].mem1001.data);
      $('#stepDescription').html(`Paso actual: <br/> ${stepNum} - ${steps[stepNum].description.data}`);
    });

    $(".navInstructions button").click(function() {
      const operation = $(this).attr("operation");
      stepNum = 0;

      if (operation == "next" && instNum < 3) {
        instNum++;
      } else if (operation == "prev" && instNum > 0) {
        instNum--;
      }
      // AJAX => Post al .php pasando como parámetro el numero de instrucción.
      // Devuelve el resultado y le asigna los valores a las celdas con id = instructionValue, axValue, etc...
      $.post("/tps/tp5/tp5.php", {number: instNum}, function(result){
        // Parseo resultado a JSON
        var res = JSON.parse(result);

        // Guardo los pasos de la instruccion seleccionada
        steps = res.steps;
        // Borra highlight de steps
        $('.registry-table tr').removeClass('active');
        $('.memory-table tr').removeClass('active');
        // Seteo el estado inicial de los registros
        $('#ip').html(steps[0].ip.data);
        $('#ri').html(steps[0].ri.data);
        $('#ax').html(steps[0].ax.data);
        $('#cx').html(steps[0].cx.data);
        $('#rdi').html(steps[0].rdi.data);
        $('#rda').html(steps[0].rda.data);
        $('#mem1000').html(steps[0].mem1000.data);
        $('#mem1001').html(steps[0].mem1001.data);
        $('#stepDescription').html(`Paso actual: <br/> ${stepNum} - ${steps[stepNum].description.data}`);

        // Escondo todas las flechas ">"
        tpRows.find(".arrow").css("visibility", "hidden");
        tpRows.removeClass("active");
        // Muestro la flecha del elemento con id = instNum-x
        $(`#instNum-${instNum} td span`).css("visibility", "initial");
        // Highlight fila naranja
        $(`#instNum-${instNum}`).addClass("active");
        // Carga descripcion de la operacion
        $("#opDescription").html(`Descripción de la instrucción: <br/> ${res.opDescription}`);
      });
    })
  })
}());