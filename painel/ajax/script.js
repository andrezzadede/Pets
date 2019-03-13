$('#estados').change(function(){

    var e = document.getElementById('estados');

    getCidadesByEstado(e.value);
   
});

function getCidadesByEstado(id_estado){
    var page = "ajax/cidade.php";

    $.ajax
    ({
        type: 'POST',
        dataType: 'html',
        url: page,
        beforeSend: function(){
            $("#dados-cidades").html("Carregando...");
        },
        data: { id_estado: id_estado},
        success: function(msg) {
            $("#dados-cidades").html(msg);
        }

    })
}