<?php 
/**
 * Plugin Name:       session_plugin
 * Plugin URI:        https://example.com/
 * Description:       Plugin para sesion de usuario
 * Version:           1.0.0
 * Author:            Jose Pimentel
 * Author URI:        http://josepimentel.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       session
 * Domain Path:       /languages
 */

 function Activar(){
    global $wpdb;

    $sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}users_plugin (
        ID bigint(20) unsigned NOT NULL auto_increment,
        user_login varchar(60) NOT NULL default '',
        user_pass varchar(255) NOT NULL default '',
        user_nicename varchar(50) NOT NULL default '',
        user_email varchar(100) NOT NULL default '',
        user_url varchar(100) NOT NULL default '',
        user_registered datetime NOT NULL default '0000-00-00 00:00:00',
        user_activation_key varchar(255) NOT NULL default '',
        user_status int(11) NOT NULL default '0',
        display_name varchar(250) NOT NULL default '',
        PRIMARY KEY  (ID),
        KEY user_login_key (user_login),
        KEY user_nicename (user_nicename),
        KEY user_email (user_email)
    ) $charset_collate;\n";

    $wpdb->query($sql);
 }

 function Desactivar(){
    //flush_rewrite_rule_rules();
 }



 register_activation_hook(__FILE__,'Activar');
 register_deactivation_hook(__FILE__,'Desactivar');

 add_Action('admin_menu','CrearMenu');
 add_action( 'wp_enqueue_scripts', 'Estilos' );


 function CrearMenu(){
     add_menu_page(
         'Login Plugin', //Titulo de la pagina
         'Login Plugin', //Titulo del Menu
         'manage_options', //Capability
         'sp_menu', //slug
         'Login', //Funcion del contenido
         plugin_dir_url(__FILE__). 'admin/img/icon.png',
         '1'
     );

    

 } 

 function Login(){
    //echo "<h1>Contenido de la pagina del Login</h1>";

require_once( plugin_dir_path(__FILE__). '/admin/login.php');
}

function Registro(){
    //echo "<h1>Contenido de la pagina del Registro</h1>";
    require_once( plugin_dir_path(__FILE__). '/admin/registro.php');
}


function cyb_plugin_scripts_and_styles() {

    wp_enqueue_script(
        'mi-plugin-script',
        plugins_url( 'assets/js/plugin-script.js', __FILE__ ),
        array( 'jquery' ),
        '1.0',
        true
    );

    wp_enqueue_style(
        'mi-plugin-style',
        plugins_url( 'admin/css/styles.css', __FILE__ ),
        array(),
        '1.0'
    );

    wp_enqueue_script(
        'mi-bootstrap-script',
        plugins_url( 'admin/bootstrap/js/bootstrap.min.js', __FILE__ ),
        array( 'jquery' ),
        '1.0',
        true
    );

}

?>