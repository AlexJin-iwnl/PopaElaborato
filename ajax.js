$(document).ready(function(){
    $(".addAndDelete").click(function(evento){
        evento.preventDefault();
        var id=$(this).val();
        $.ajax({
            url: 'add.php',
            method: "post",
            data: {idProgettoSelezionato:id}
        }).done(function(data){
            console.log(data);
            location.reload();
        }).fail(function(code, status){
            console.log('FALLITO');
        });
    });
    $("#logOut").click(function(evento){
        evento.preventDefault();
        var id=$(this).val();
        $.ajax({
            url: 'endSession.php',
            method: "post",
            data: {}
        }).done(function(data){
            console.log(data);
            console.log("log out");
            location.reload();
        }).fail(function(code, status){
            console.log('FALLITO');
        });
    });
});