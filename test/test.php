

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Perfil</title>
	<link rel="icon" href="imagenes/favicon.png">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/b_css/bootstrap.min.css">

</head>
<body class="bg-light">	
 

 <form action="test.php" method="post">
        <button id="add">Add</button>
        <div id="canvas">
        </div>
        <br>
    <br>
    <input type="submit" value="Enviar" id="btn_guardar"/>
</form>


	<script type="text/javascript" src="../js/b_js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/iess/js/jquery-3.6.0.min.js"></script>

    <script type="text/javascript" >

        var i = 1;
        $("#add" ).click(function(e) {
            e.preventDefault();
            let enfermedades= `<div id="ef${i}">
                                    <input type="text" value="${i}" disabled name="a[]"/>
                                    <button class="del" id = ${i}>X</button>
                                </div>`;
         $("#canvas").append(enfermedades);
         i++;
        });

        $(document).on('click', '.del', function(e){
            e.preventDefault();
            var button_id = $(this).attr("id");
            $('#ef'+button_id+'').remove();
        });
    </script>

    <script type="text/javascript" >
        $(document).on('click', '#btn_guardar', function(e){
            e.preventDefault();
        const textValues = $.map($('input[type=text][name="a[]"]'), function(el) { return el.value; });
         console.log(textValues);
        });
    </script>



</body>

</html>


