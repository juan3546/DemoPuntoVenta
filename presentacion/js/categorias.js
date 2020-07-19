$(document).ready(function(){
    tablaPersonas =  $("#tbCategoria").DataTable({
      "columnDefs":[{
       "targets": -1,
       "data":null,
       "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
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
        $("#formCategorias").trigger("reset");
        $(".modal-header").css("background-color", "#28a745");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nueva Categoria");            
        $("#modalCRUD").modal("show");        
        id=null;
        opcion = 1; //alta
    }); 

    var fila; //capturar la fila para editar o borrar el registro
    
    //botón EDITAR    
    $(document).on("click", ".btnEditar", function(){
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        nombre = fila.find('td:eq(1)').text();
        estatus = fila.find('td:eq(2)').text();
        
      
    
        $("#nombre").val(nombre);
        $("#estatus").val(estatus);
        
        opcion = 2; //editar
    
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Persona");            
        $("#modalCRUD").modal("show");  
    
    });


    //botón BORRAR
    $(document).on("click", ".btnBorrar", function(){    
        
        fila = $(this);
        id = $(this).closest("tr").find('td:eq(0)').text();
        opcion = 3 //borrar
        var respuesta = alertify.confirm("¿Está seguro de eliminar el registro: "+id+"?", 
        function(){
          alertify.success('Ok');
        },function(){
          alertify.error('Cancel');
        });
        //var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
        if(respuesta){
            $.ajax({
                url: "../negociacion/NegCategorias.php", 
                type: "POST",
                dataType: "json",
                data: {opcion:opcion, id:id},
                success: function(){
                    tbCategoria.row(fila.parents('tr')).remove().draw();
                }
            });
        }       
    });





    $("#formCategorias").submit(function(e){
        e.preventDefault();  
        nombre = $.trim($("#nombre").val());
        estatus = $.trim($("#estatus").val());  
        $.ajax({
            url: "../negociacion/NegCategorias.php",
            type: "POST",
            dataType: "json",
            data: {nombre:nombre, estatus:estatus,  opcion:opcion, id:id},
            success: function(data){  
              var datos = JSON.parse(data);
              console.log(datos);
                id = datos[0].id_categoria;            
                nombre = datos[0].nombre;
                estatus = datos[0].estatus;
                if(opcion == 1){tbCategoria.row.add([id,nombre,estatus]).draw();}
                else{tbCategoria.row(fila).data([id,nombre,estatus]).draw();}            
            },
            error: function(jqXHR, textStatus, errorThrown){
                if (jqXHR.status === 0) {

                    alert('Not connect: Verify Network.');
        
                  } else if (jqXHR.status == 404) {
        
                    alert('Requested page not found [404]');
        
                  } else if (jqXHR.status == 500) {
        
                    alert('Internal Server Error [500].');
        
                  } else if (textStatus === 'parsererror') {
        
                    alert('Requested JSON parse failed.');
        
                  } else if (textStatus === 'timeout') {
        
                    alert('Time out error.');
        
                  } else if (textStatus === 'abort') {
        
                    alert('Ajax request aborted.');
        
                  } else {
        
                    alert('Uncaught Error: ' + jqXHR.responseText);
        
                  }

            }        
        });
        $("#modalCRUD").modal("hide");    
        
    });  
});

