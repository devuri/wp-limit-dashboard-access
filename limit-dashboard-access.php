<?php
/**
 
	@package  Limit Dashboard Access  by devuri

	Plugin Name: Limit Dashboard Access 
	Plugin URI: http://wp.devuri.com
	Description: Disable the WP Dashboard access for subscribers. Redirect to the home page.
	Version: 1.0.0
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
	add_action("admin_menu", "limit_dashboard_access_lide");
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
	
  
