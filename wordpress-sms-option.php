<?php
/*
 *      wordpress-sms-option.php
 *
 *      Copyright 2007 albert <albert.oliva@gmail.com>
 *
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 */
 
 // parametros por defecto vacios

add_option('tm_login', '');
add_option('tm_password', '');
add_option('tm_to', '');
add_option('tm_mensaje', '');

if(isset($_POST[tm_login]))
    {
      update_option('tm_login',$_POST[tm_login]);
    }

$tm_login = get_option('tm_login');

if(isset($_POST[tm_password]))
    {
      update_option('tm_password',$_POST[tm_password]);
    }

$tm_password = get_option('tm_password');

if(isset($_POST[tm_to]))
    {
      update_option('tm_to',$_POST[tm_to]);
    }

$tm_to = get_option('tm_to');

if(isset($_POST[tm_mensaje]))
    {
      update_option('tm_mensaje',$_POST[tm_mensaje]);
    }

$tm_mensaje = get_option('tm_mensaje');

?>

<div class="wrap"> 
	<h2><?php _e('Configuración: wordpress-sms Plugin', 'wordpress-sms') ?></h2>
	<p><?php _e('Para poder utilizar este plugin correctamente deberás rellenar los siguientes parámetros. Recuerda que si quieres poner varios destinatarios deberás separarlos por ";"<br/><br/><br/>Para más información puedes visitar: <a href="http://wordpress-sms.ditask.es"  target=_blank >wordpress-sms.ditask.es</a>', 'wordpress-sms') ?></strong></p>
	<form name="form1" method="post" action="<?php echo(get_option('siteurl') . '/wp-admin/options-general.php?page=wordpress-sms/wordpress-sms-option.php'); ?>">

	<fieldset class="options">
		<?php _e('Login ', 'wordpress-sms') ?>: <input type="text" name="tm_login" value="<?= $tm_login ?>" />
        <br/><br />
        <?php _e('Clave ', 'wordpress-sms') ?>: <input type="password" name="tm_password" value="<?= $tm_password ?>" />
        <br/><br />
        <?php _e('Destinatarios', 'wordpress-sms') ?>: <input type="text" name="tm_to" value="<?= $tm_to ?>" />
        <br/><br />
        <?php _e('Personaliza tu mensaje', 'wordpress-sms') ?>: <input type="text" name="tm_mensaje" size="87" value="<?= $tm_mensaje ?>" />
        <br/><br />
        <p class="submit"><input type="submit" name="store_vars" value="<?php _e('Actualizar', 'wordpress-sms') ?>" ></p>
	</fieldset>
	</form> 
</div>
