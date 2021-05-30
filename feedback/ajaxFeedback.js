$(document).ready(function(){
    $(".addVoto").click(function(evento){
        evento.preventDefault();
        var id=$(this).val();
        var stud=$("#studenti"+id).val();
        console.log(stud);
        $.ajax({
            url: 'addVoto.php',
            method: "post",
            data: {idProgettoSelezionato:id,studenti:stud,feedback:$("#descrizione"+id).val(),voto:$("#voto"+id).val()}
        }).done(function(data){
            //console.log(data);
            location.reload();
        }).fail(function(code, status){
            console.log('FALLITO');
        });
    });
    $(".modificaVoto").click(function(evento){
        evento.preventDefault();
        var id=$(this).val();
        console.log(id);
        $.ajax({
            url: 'updateVoto.php',
            method: "post",
            data: {idProgettoSelezionato:id,studenti:$("#studenti").val(),feedback:$("#descrizione").val(),voto:$("#voto").val()}
        }).done(function(data){
            //console.log(data);
            //console.log("log out");
            location.reload();
        }).fail(function(code, status){
            console.log('FALLITO');
        });
    });
});