<form action="controller/controller.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="archivo" id="archivo"><br>
    <input type="button" value="Subir archivo" id='subidaFichero'>
    <input type="submit" id='subidaFichero2' style="display:none"">
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document.body).ready(function() {
        $('#subidaFichero').click(function() {
            if($('#archivo').val().length < 1) {
                alert("Porfavor seleccione algun fichero.");
            }else {
                $('#subidaFichero2').click();
            }
        });
    })
</script>
