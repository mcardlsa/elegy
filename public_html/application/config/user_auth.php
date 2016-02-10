<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Security settings
|
| The library uses PasswordHash library for operating with hashed passwords.
| 'phpass_hash_portable' = Can passwords be dumped and exported to another server. If set to FALSE then you won't be able to use this database on another server.
| 'phpass_hash_strength' = Password hash strength.
|--------------------------------------------------------------------------
*/
$config['phpass_hash_portable'] = FALSE;
$config['phpass_hash_strength'] = 8;

/*
|--------------------------------------------------------------------------
| Auto login settings
|
| 'autologin_cookie_name' = Auto login cookie name.
| 'autologin_cookie_life' = Auto login cookie life before expired. Default is 2 months (60*60*24*31*2).
|--------------------------------------------------------------------------
*/
$config['autologin_cookie_name'] = 'autologin';
$config['autologin_cookie_life'] = 60*60*24*31*2;
$config['forgot_password_expire'] = 24*60*60;


/*
|--------------------------------------------------------------------------
| Registration settings
|
| 'password_min_length' = Min length of user's password.
| 'password_max_length' = Max length of user's password.
|--------------------------------------------------------------------------
*/
$config['password_min_length'] = 6;
$config['password_max_length'] = 20;


/*
* User Group ID's definition
*/


$config['super_admin_group_id'] = 1;
$config['user_group_id'] = 2;
$config['shelter_group_id'] = 3;

$config['default_group_id'] = 2;

/*
* Site configuration	
*/

$config['site_name'] = 'ElegyApp';
$config['webmaster_email'] = 'kuldeep.singh@tanzaniteinfotech.com';



/* End of file tanza_auth.php */
/* Location: ./application/config/tanza_auth.php */