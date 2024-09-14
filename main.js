
let opcionBoton = ""


$(document).ready(function(){
    tablaPersonas = $("#tablaPersonas").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-dark btnEditar'>Editar</button><button class='btn btn-info btnBorrar'>Borrar</button></div></div>"  
       }],
        
        //Para cambiar el lenguaje a español
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    
        $("#btnNuevo").click(function(){
        $("#formPersonas").trigger("reset");
        $(".modal-header").css( "background-color", "#5a6268");
        $(".modal-header").css( "color", "white");
        $(".modal-title").text("Nueva Tarea");
      
        $("#modalCRUD").modal("show");
        opcionBoton = "Creada";
        id=null;
        opcion = 1; //alta

});    

var fila; //capturar la fila para editar o borrar el registro


//Boton editar
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    id= parseInt(fila.find('td:eq(0)').text());
    titulo = fila.find('td:eq(1)').text();
    contenido = fila.find('td:eq(2)').text();
 
    $("#titulo").val(titulo);
    $("#contenido").val(contenido);
    opcion = 2; //editar
       
    $(".modal-header").css("background-color", "#23272B");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Tarea");            
    $("#modalCRUD").modal("show");  
    opcionBoton = "Editada";
})






//Boton borrar
$(document).on("click", ".btnBorrar", function(){
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());

    opcion = 3;

    // Utilizamos SweetAlert en lugar de confirm
    Swal.fire({
        title: "¿Está seguro de eliminar el registro?",
        text: "No podrás revertir esta acción",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "bd/crud.php",
                type: "POST",
                dataType: "json",
                data: { opcion: opcion, id: id },
                success: function () {
                    tablaPersonas.row(fila.parents('tr')).remove().draw();

                    Swal.fire("¡Eliminado!", "La tarea ha sido eliminado.", "success");
                }
            });
        }
    });
});

$(document).on("click", "#btnGuardar", function(){



    Swal.fire(
        "Completado", "Tarea " +  opcionBoton + " Con Exito", "success"
      )
})




$("#formPersonas").submit(function (e) {
    e.preventDefault();
    titulo = $.trim($("#titulo").val());
    contenido = $.trim($("#contenido").val());
   
    $.ajax({
        url: "bd/crud.php",
        type: "POST",
        dataType: "json",
        data: { titulo: titulo, contenido: contenido, id: id, opcion: opcion },
        success: function (data) {
            console.log(data)
            id = data[0].id;
            titulo = data[0].titulo;
            contenido = data[0].contenido;
          
            if (opcion == 1) { tablaPersonas.row.add([id, titulo, contenido]).draw(); 
            }
            else { 
                tablaPersonas.row(fila).data([id, titulo, contenido]).draw();
             }
        }
    });
    $("#modalCRUD").modal("hide");
    
});


});