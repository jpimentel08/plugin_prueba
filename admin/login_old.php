
<?php
    $style2= plugin_dir_url(__FILE__).'css/all.css';
    $style= plugin_dir_url(__FILE__).'css/style.css';
    $scriptJs= plugin_dir_url(__FILE__).'../admin/bootstrap/js/bootstrap.min.js';
    $script_modal= plugin_dir_url(__FILE__).'../admin/js/modal.js';
    $script_modal_forgot= plugin_dir_url(__FILE__).'../admin/js/modal_forgot.js';
    $style_bootstrap= plugin_dir_url(__FILE__).'../admin/bootstrap/css/bootstrap.min.css';

    //$url = plugin_dir_url(__FILE__).'hola.php';
   
    global $wpdb;

//Funcion Registrar Datos
$tabla= "{$wpdb->prefix}users_plugin";

if(isset($_POST['btnguardar'])){
    $usuario = $_POST['user'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $display = $_POST['display'];
}

$datos = [
    'user_login' => $usuario,
    'user_pass' => $password,
    'user_email' => $email,
    'display_name' => $display
];

$resultado = $wpdb->insert($tabla,$datos);

//inicio sesion

if(isset($_POST['btnLogin'])){
        
    $userLogin = $_POST['userLogin'];
    $passLogin = $_POST['passLogin'];
    
    $query= "SELECT * FROM {$wpdb->prefix}users_plugin WHERE user_login = '$userLogin' AND user_pass = '$passLogin'";
    $results= $wpdb->get_results($query);
    $resultado= $wpdb->query( $query ); 

   // print($url);

    if ($resultado == 1) {

        // header( 'Location: http://localhost/plugin_registro/wp-content/plugins/testplugin/admin/hola.php');
        // die();

        foreach ( $results as $page ){
            echo 'ID: '.$page->ID.'<br/>';
            echo $page->user_login.'<br/>';
            echo $page->user_pass.'<br/>';
            echo $page->user_nicename.'<br/>';
            echo $page->user_email.'<br/>';
            echo $page->display_name.'<br/>';   
        }
    }else{
        echo 'Usuario no existe';
        }
    }

//funcion Recuperar Contraseña

//inicio sesion

if(isset($_POST['btnguardarforgot'])){
        
    $email_forgot = $_POST['emailForgot'];
    
    $query= "SELECT * FROM {$wpdb->prefix}users_plugin WHERE user_email = '$email_forgot'";
    $results_forgot= $wpdb->get_results($query);
    $resultado_forgot= $wpdb->query( $query ); 

    //print($query);

    
// $to = $email_forgot;
// $subject = "Recuperar Contraseña";
// $message = "SU contraseña es:";

// wp_mail( $to, $subject, $message );



    if ($resultado_forgot == 1) {

        //datos para el correo
        
        foreach ( $results_forgot as $page ){

            $to = $email_forgot;
            $subject = "Recuperar Contraseña";
            $message = 'Su contraseña es:'.$page->user_pass;
            
            wp_mail( $to, $subject, $message );
            
            
        }
    }else{
        echo 'Usuario no existe';
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="keywords" content="Art Sign Up Form Responsive Widget, Audio and Video players, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, 
		Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design"
    />
    
    <!-- /meta tags -->
    <!-- custom style sheet -->
    <link href="<?php echo $style ?>" rel="stylesheet" type="text/css" />
    <!-- /custom style sheet -->
    <!-- fontawesome css -->
    <link href="<?php echo $style2 ?>" rel="stylesheet" />
    <!-- /fontawesome css -->
    <!-- bootstrap css -->
    <link href="<?php echo $style_bootstrap ?>" rel="stylesheet" />
    <!-- /bootstrap css -->
    <!-- google fonts-->
    <link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- /google fonts-->

    <script type="text/javascript" src="<?php echo $scriptJs ?>"></script>
    <script type="text/javascript" src="<?php echo $script_modal ?>"></script>
    <script type="text/javascript" src="<?php echo $script_modal_forgot ?>"></script>
</head>


<body>
    <div class="body-plugin">
        <div class="w3l-login-form">
            <h2>Login</h2>
            <form action="#" method="POST">
                <div class="w3l-form-group">
                    <label>Usuario:</label>
                    <div class="group">
                    <!-- <i class="fas fa-user"></i> -->
                    <!-- <img class="" src="http://localhost/plugin_registro/wp-content/uploads/2021/10/username1.png" /> -->
                        <input class="form-control" type="text" id="userLogin" name="userLogin" class="form-control" value="<?php echo isset($_POST['userLogin']) ? $_POST['userLogin'] : null;?>" placeholder="Usuario" required aria-required="true" />
                    </div>
                </div>
                <div class="w3l-form-group">
                    <label>Contraseña:</label>
                    <div class="group">
                        <!-- <i class="fas fa-unlock"></i> -->
                        <input type="password" id="passLogin" name="passLogin" class="form-control" value="<?php echo(isset($_POST['passLogin']) ? $_POST['passLogin'] : null); ?>" placeholder="Contraseña" required aria-required="true" />
                    </div>
                </div>
                <div class="forgot">  
                <!-- <a id="btnolvido" href="#" class="register">Olvidaste Contraseña?</a> -->
                <a id="btnolvido" data-dismiss="modal" data-toggle="modal" data-taget="#olvidoModal">Olvidaste Contraseña?</a>
                
                    <!-- <p><input type="checkbox">Remember Me</p> -->
                </div>
                <button type="submit" id="btnLogin" name="btnLogin">Login</button>

            </form>
            <p class=" w3l-register-p">No tienes cuenta?<a id="btnnuevo" href="#" class="register"> Registrarse</a></p>
        </div>
        
        <footer>
            <p class="copyright-agileinfo"> &copy; 2021 Plugin Login. All Rights Reserved | Design by <a href="https://hispanossoluciones.com">Hispanos Soluciones</a></p>
        </footer>
    </div>

</body>

<!-- modal Registrarse -->
<div class="modal fade" id="modalnuevo" tabindex="-1" role="dialog" aria-labelledby="modalnuevo" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrarse</h5>
            </div>
            
            <form method="post" >
                <div class="modal-body">    
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="user">Usuario</label>
                                    <input class="form-control" type="text" id="user" name="user" class="form-control" value="<?php echo isset($_POST['user']) ? $_POST['user'] : null;?>" placeholder="Usuario" required aria-required="true" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" name="password" class="form-control" value="<?php echo(isset($_POST['password']) ? $_POST['password'] : null); ?>" placeholder="Password" required aria-required="true" />
                                </div>    
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" value="<?php echo(isset($_POST['email']) ? $_POST['email'] : null); ?>" placeholder="Email" required aria-required="true" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nombre</label>
                                    <input type="text" id="display" name="display" class="form-control" value="<?php echo(isset($_POST['display']) ? $_POST['display'] : null); ?>" placeholder="Nombre" required aria-required="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col">
                            <button type="button" id="btncerrar" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                        <div class="col">
                            <button type="submit" id="btnguardar" name="btnguardar" value="Enviar" class="btn btn-primary">Registrar</button>
                        </div>
                    </div>  
                </div>
        <form>
    </div>
</div>

<!-- modal Olvido -->
<div class="modal fade" id="olvidoModal" tabindex="-1" role="dialog" aria-labelledby="olvidoModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="olvidoModalLabel">Olvido</h5>
            </div>
            
            <form method="post" >
                <div class="modal-body">    
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" id="emailForgot" name="emailForgot" class="form-control" value="<?php echo(isset($_POST['email']) ? $_POST['email'] : null); ?>" placeholder="Email" required aria-required="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col">
                        <button type="button" id="btnclose" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    <div class="col">
                        <button type="submit" id="btnguardarforgot" name="btnguardarforgot" value="Enviar" class="btn btn-primary">Registrar</button>
                    </div>
                </div>  
        </div>
        <form>
    </div>
</div>


</html>