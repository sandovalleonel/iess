$(document).ready(function(){
  $("#buscar_admin").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#usuario_admin tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});