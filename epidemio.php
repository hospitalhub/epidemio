<?php
use Hospitalplugin\WP\ScriptsAndStyles;
use Symfony\Component\Yaml\Yaml;
use Hospitalplugin\WP\Menu;
use Epidemio\WP\Actions;
/*
 * Plugin Name: epidemio
 * Version: 0.1-alpha
 * Description: Epidemio
 * Author: Andrzej Marcinkowski
 * Author URI:
 * Plugin URI:
 * Text Domain: epidemio
 * Domain Path: /languages
 */
require_once WP_CONTENT_DIR . "/../vendor/autoload.php";
if (! defined('PLUGIN_URL'))
    define('PLUGIN_URL', WP_PLUGIN_URL . '/epidemio');

$cfg = Yaml::parse(file_get_contents(__DIR__ . '/epidemio.yaml'));

$menuPnct = new Menu();
$hsac = new ScriptsAndStyles();
$psac = new ScriptsAndStyles();

Actions::init();

$menuPnct->init($cfg['menus'], $cfg['url'], $cfg['menu-remove']);
$hsac->init(HOSPITAL_PLUGIN_URL, $cfg['pages'], $cfg['scripts'], $cfg['styles']);
$psac->init(WP_PLUGIN_URL . '/epidemio', $cfg['pages'], $cfg['plugin-scripts'], $cfg['plugin-styles']);
?>