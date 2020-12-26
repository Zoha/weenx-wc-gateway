<?php
/*
Plugin Name: Weenx WooCommerce Gateway
Description: add weenx gateway to wooCommerce plugin
Version: 1.0.0
Author: Zoha Banam
License: GPLv2 or later
*/

define('WEENX_WC_GATEWAY_VERSION', '1.0.0');
define('WEENX_WC_GATEWAY_MINIMUM_WP_VERSION', '5.4');
define('WEENX_WC_GATEWAY_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WEENX_WC_GATEWAY_GIFT_PAY_DEFAULT_URL', "https://services.weenx.net/WebServices/Gateway.asmx?WSDL");
define('WEENX_WC_GATEWAY_GO_PAY_DEFAULT_URL', "https://services.weenx.net/WebServices/GoPayGateway.asmx?WSDL");

require_once(WEENX_WC_GATEWAY_PLUGIN_DIR . 'weenx-wc-gateway.php');
