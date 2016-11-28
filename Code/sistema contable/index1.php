<!DOCTYPE html>

<html>

<head>

    <!-- http://www.lawebdelprogramador.com -->

    <title>La Web del Programador - Ejemplo de obtener, agregar y eliminar estilos a un id</title>

    <script src="http://code.jquery.com/jquery-latest.js"></script>

 

    <script type='text/javascript'>

    $(document).ready(function(){

        /** Seleccionamos el elemento con el id 5 */

        $("#selecciona5").click(function(){

            $("#selector").val(5);

            // ejecutamos el evento change()

            $("#selector").change();

        });

 

        /** Seleccionamos el elemento con el id 1 */

        $("#selecciona1").click(function(){

            $("#selector").val(1);

            // ejecutamos el evento change()

            $("#selector").change();

        });

 

        /** deshabilitamos el valor 3 */

        $("#desactivar3").click(function(){

            $("#selector option[value=3]").attr('disabled','disabled');

        });

 

        /** habilitamos el valor 3 */

        $("#activar3").click(function(){

            $("#selector option[value=3]").removeAttr('disabled');

        });

 

        /** validamos que haya un valor del desplegable seleccionado */

        $("#validar").click(function(){

            if($("#selector").val()==0)

            {

                alert("No hay ninguna opcion seleccionada");

            }else{

                alert("Esta seleccionado el valor: "+$("#selector").val());

            }

        });

 

        /** Mostramos el valor-texto seleccionado */

        $("#selector").change(function(){

            var valor=$("#selector").val();

            var texto=$("#selector option:selected").text();

            $("#valorSeleccionado").html(valor+" - "+texto);

        });

    })

    </script>

 

    <style>

    div {display:inline-block;clear:both;border:1px solid;cursor:pointer;margin:3px;padding:5px;}

    </style>

</head>

 

<body>

    <h1>Ejemplo de utilizar jquery con un select</h1>

    <form>

        <select name='selector' id='selector'>

            <option value='0'>Selecciona una opción</option>

            <option value='1'>Opcion 1</option>

            <option value='2'>Opcion 2</option>

            <option value='3'>Opcion 3</option>

            <option value='4'>Opcion 4</option>

            <option value='5'>Opcion 5</option>

            <option value='6'>Opcion 6</option>

            <option value='7'>Opcion 7</option>

        </select>

    </form>

 

    <!-- mostramos el valor seleccionado en cada momento -->

    <p id='valorSeleccionado'></p>

 

    <div id='selecciona5'>Seleccionar el 5 elemento</div>

    <div id='selecciona1'>Seleccionar el 1 elemento</div>

    <div id='desactivar3'>Desactivar el 3 elemento</div>

    <div id='activar3'>Activar el 3 elemento</div>

	<div id='validar'>Validar que haya un elemento seleccionado</div>

</body>

</html>