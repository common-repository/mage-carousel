<?php 
/*
Plugin Name: Mage Carousel
Plugin URI: https://wordpress.org/plugins/mage-carousel/
Description: An Awesome & Multipurpose Carousel For your WordPress Website
Author: MagePeople Team
Version: 1.0
Author URI: http://mage-people.com
License: GPLv2 or later
Text Domain: mpc
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

// Include Requird PHP Scripts and files.
require_once (dirname(__FILE__)."/inc/enque_scripts.php");
require_once (dirname(__FILE__)."/inc/custom_cpt.php");
require_once (dirname(__FILE__)."/inc/shortcode.php");




// Enque Required Style & Scripts For Front End
function mage_mpc_libs() {

    wp_enqueue_script('jquery'); 

    wp_enqueue_script( 'mpc-owl-carousel', plugin_dir_url( __FILE__ ) . 'js/owl.carousel.min.js', array('jquery'), '1', true );

    wp_enqueue_script( 'mpc-carousel-scripts', plugin_dir_url( __FILE__ ) . 'js/main.js', array('jquery','mpc-owl-carousel'), '1', true );

    wp_enqueue_style('mpc-owl-default-styles',plugin_dir_url( __FILE__ ) .'css/owl.theme.default.min.css');

    wp_enqueue_style('mpc-owl-core-styles',plugin_dir_url( __FILE__ ) .'css/owl.carousel.min.css');

    wp_enqueue_style('mpc-carousel-styles',plugin_dir_url( __FILE__ ) .'css/main.css');
    
    // enquee font awesome from cdn for latest support
    wp_enqueue_style('mpc-font-awesome','https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
}
add_action( 'wp_enqueue_scripts', 'mage_mpc_libs' );