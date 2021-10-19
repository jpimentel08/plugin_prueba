jQuery(document).ready(function($) {
    
    $("#btnnuevo").click(function() {

        $("#modalnuevo").modal("show");
        console.log('click Registrarse');
        
    });

    $("#btnolvido").click(function() {
        $("#olvidoModal").modal("show");
        console.log('click Olvido Contraseña');
        
    });

    $("#btncerrar").click(function() {

        $("#modalnuevo").modal("hide");
        console.log('click cerrando modal Registrarse');
        
    });

    $("#btnclose").click(function() {
        $("#olvidoModal").modal("hide");
        console.log('click cerrando modal olvido');
        
    });
    
}); 






