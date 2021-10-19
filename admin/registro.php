

<?php
global $wpdb;

$tabla= "{$wpdb->prefix}users_plugin";

if(isset($_POST['btnguardar'])){
    $usuario = $_POST['user'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $display = $_POST['display'];
}


print($usuario);


$datos = [
    'user_login' => $usuario,
    'user_pass' => $password,
    'user_email' => $email,
    'display_name' => $display
];

$resultado = $wpdb->insert($tabla,$datos);

print($datos);

?>


<form method="post" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>">
  <div class="login-form">
    <div class="form-group">
      <label for="user">Usuario:</label><br />
      <input type="text" id="user" name="user" class="form-control" value="<?php echo isset($_POST['user']) ? $_POST['user'] : null;?>" placeholder="Usuario" required aria-required="true" />
    </div>
    <div class="form-group">
    <label for="email">Password:</label>
    <input type="password" id="password" name="password" class="form-control" value="<?php echo(isset($_POST['password']) ? $_POST['password'] : null); ?>" placeholder="Password" required aria-required="true" />
  </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" class="form-control" value="<?php echo(isset($_POST['email']) ? $_POST['email'] : null); ?>" placeholder="Email" required aria-required="true" />
    </div>
    <div class="form-group">
      <label for="display">Display</label>
      <input type="text" id="display" name="display" class="form-control" value="<?php echo(isset($_POST['display']) ? $_POST['display'] : null); ?>" placeholder="Población" required aria-required="true" />
    </div>
    <input type="submit" id="btnguardar" name="btnguardar" value="Enviar" />
  </div>
</form>