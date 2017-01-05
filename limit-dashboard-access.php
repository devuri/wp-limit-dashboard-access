<?php
/**
 
	@package  Limit Dashboard Access  by devuri

	Plugin Name: Limit Dashboard Access 
	Plugin URI: http://wp.devuri.com
	GitHub Theme URI: devuri/wp-limit-dashboard-access
	Description: Disable the WP Dashboard access, change howdy to logout and remove wp logo. Redirect to the home page.
	Version: 1.3.0
	Author: devuri
	Author URI: http://www.devuri.com
	Contributors:
	License: GPLv2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.txt
	Text Domain: limit-dashboard-access
	Domain Path: /languages
	Usage: .
	Tags: 

	
	Copyright 2016 devuri	(email : hello@devuri.com)
	GPLv2 Full license details in license.txt	

	Limit Dashboard Access  is built using the  http://qweelo.com/QuPlugin, (C) 2015- 2016 Qweelo.
	Qu Plugin QuickStarter is distributed under the terms of the GNU GPL v2 or later.

	This Plugin, like WordPress, is licensed under the GPL.
	Use it to make something cool, have fun, and share.	

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

---------------------------------------------------------------------------------------------------*/


	// * DIRECT ACCESS DENIED *
	if ( ! defined( "WPINC" ) ) { 
		die; 
	}
	

	//plugin directory CONSTANT
	define("LIMITDASHBOARDACCESS_DIR", dirname(__FILE__));
	
	//PLUGIN URL
	define("LIMITDASHBOARDACCESS_URL", plugins_url( "/",__FILE__ ));
	
	
	// * VARS 
	function lide_info($plgn_info){
		
		$PluginName = "Limit Dashboard Access ";
		$Version = "1.0";
		$Description = "Disable the WP Dashboard access for subscribers. Redirect to the home page. ";
		$Author = "devuri";
		$AuthorURI = "http://www.devuri.com";
		$codepre = "lide";
		
		
		$pluginfo_atts = array (
			
				"name" 		=> $PluginName,
				"version" 	=> $Version,
				"description" 	=> $Description,
				"author"	=> $Author,
				"authoruri" => $AuthorURI,
				"codepre" => $codepre,
			);
		//	
		return $pluginfo_atts[$plgn_info];
	}
	
	
	
				
/**
			* 	ADMIN MENU *
******************************/

	//======= SetUp admin Menu Here	
	//add_action("admin_menu", "limit_dashboard_access_lide");
		function limit_dashboard_access_lide() {
			
			
				$page_title = "Limit Dashboard Access  Page ";
				$menu_title = "Dashboard Access ";
				$capability = "manage_options";
				$menu_slug = "limit-dashboard-access-pqpln";
				$function = "limit_dashboard_access_qpage";
				$position = "8.8";
				$icon_url = "";
				add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
		}	
//--------------- Admin MAIN Page ------------------------
	
		function limit_dashboard_access_qpage(){
				
				// header
				require_once(LIMITDASHBOARDACCESS_DIR. "/_admin/head.php");	
				
				// page
				require_once(LIMITDASHBOARDACCESS_DIR."/_admin/admin.php");
				
				// footer
				require_once(LIMITDASHBOARDACCESS_DIR. "/_admin/footer.php");	

		}// fend
	
/* ----------------------------------------------------
			Start Plugin Code Here
-----------------------------------------------------*/  

	
	// === redirect all subscribers 
        add_action('admin_init', 'lide_deny_dashboard');

	
	
		function lide_deny_dashboard() {
				if (!current_user_can('delete_posts') && $_SERVER['DOING_AJAX'] != '/wp-admin/admin-ajax.php') {
				wp_redirect( home_url()); exit;
			}
		}


		// Replace the WordPress Generator
		function devuri_generator() { 
		return '<meta name="Archangel" content="DevuriKing and TheArch Prince" />'; 
		}
		
		add_filter( 'the_generator', 'devuri_generator' );


/*...............................................
Remove the Howdy menu from the Admin Bar and change to a log Out Link 
----------------------------------------------------- */
add_action( 'wp_before_admin_bar_render', 'custom_logout_link_lide' ); 
	
	function custom_logout_link_lide() {
    		global $wp_admin_bar;
    		$wp_admin_bar->add_menu( array(
        		'id'    => 'wp-custom-logout',
        		'title' => 'Log Out',
       			'parent'=> 'top-secondary',
        		'href'  => wp_logout_url()
    		) );
    	$wp_admin_bar->remove_menu('my-account');
	$wp_admin_bar->remove_menu('wp-admin');
}


add_action( 'admin_bar_menu', 'remove_wplogo_lide', 999 );

function remove_wplogo_lide( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'wp-logo' );
}


add_filter('admin_footer_text', 'copywright_web_lide');
	function copywright_web_lide () {
	$blogname = get_bloginfo( 'name');
	$th_year = date("Y");
	echo '&copy; '.$th_year.' <a href="'.home_url().'" target="_blank">'.$blogname.'</a> All Rights Reserved. ';
}


/*---------------------------------------------------------
	Remove Version From The Admin Footer
------------------------------------------------------------*/
add_action( 'admin_menu', 'dvwlw_rm_footer_version' );

function dvwlw_rm_footer_version() {

		// only remove for low level users
		if ( ! current_user_can('manage_options') ) { 
        remove_filter( 'update_footer', 'core_update_footer' ); 
    }
}
