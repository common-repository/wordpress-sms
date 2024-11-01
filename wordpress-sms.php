<?php
/*
Plugin Name: wordpress-sms
Plugin URI: http://albertoliva.com/projects/wordpress-sms
Description: Envia un SMS cuando tu blog recibe un nuevo comentario
Version: 1.1
Author: Albert Oliva
Author URI: http://albertoliva.com
*/

/*  Copyright 2007  Albert Oliva  (email : albert.oliva@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

// Hook para añadir la pagina de menu opciones
add_action('admin_menu', 'mt_add_pages');

// Funcion para añadir páginas de menu
function mt_add_pages() {
    // Add a new submenu under Options:
    add_options_page('wordpress-sms opciones', 'wordpress-sms', 8, '?page=wordpress-sms/wordpress-sms-option.php');
}

// Hook para la funcion send_sms
add_action('wordpress_sms', 'send_sms');

// Funcion que envia el mensaje
function send_sms($commentID) {
    global $wpdb;
    $table_name = $wpdb->prefix . "comments";
    $getcomment = "SELECT comment_content from ".$table_name." where comment_ID = ".$commentID.";";
    $content = $wpdb->get_var($getcomment);

	  $host = gethostbyaddr($_SERVER['REMOTE_ADDR']);

    # variable
    $host = 'opensms.movistar.es';
    $service_uri = '/aplicacionpost/loginEnvio.jsp';
    $tm_login = get_option('tm_login');
    $tm_password = get_option('tm_password');
    $tm_to = get_option('tm_to');
    $tm_mensaje = get_option('tm_mensaje');
    $vars ="TM_ACTION=AUTHENTICATE&TM_LOGIN=".$tm_login."&TM_PASSWORD=".$tm_password."&to=".$tm_to."&message=".$tm_mensaje;

    # cabecera http HTTP 
    $header = "Host: $host\r\n";
    $header .= "User-Agent: PHP Script\r\n";
    $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $header .= "Content-Length: ".strlen($vars)."\r\n";
    $header .= "Connection: close\r\n\r\n";

    $fp = pfsockopen($host, 443, $errno, $errstr);

if (!$fp) {
   echo "$errstr ($errno)<br/>\n";
   echo $fp;
} else {
    fputs($fp, "POST $service_uri  HTTP/1.1\r\n");
    fputs($fp, $header.$vars);
    fwrite($fp, $out);
    // muestra la salida (opcional)
    //while (!feof($fp)) {
    //    echo fgets($fp, 128);
    // }
    fclose($fp);
}
}

add_action('comment_post', 'send_sms');

?>
