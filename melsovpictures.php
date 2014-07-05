<?php
    /*
    Plugin Name: Melsov Pictures
    Plugin URI: http://www.matthewpoindexter.com
    Description: Thumbnail/main view style picture gallery
    Author: M. Poindexter
    Version: 1.0
    Author URI: http://www.matthewpoindexter.com
    */
    /*
	Copyright 2014  Matthew Poindexter  (email : melsov@yahoo.com)
	
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as 
	published by the Free Software Foundation.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
	*/
	// include_once('wp-includes/class-wp.php');
	function url(){
	  return sprintf(
	    "%s://%s%s",
	    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
	    $_SERVER['SERVER_NAME'],
	    $_SERVER['REQUEST_URI']
	  );
	}
	include_once('biz/nextgen-connector/NextgenData.php');
	include_once('biz/nextgendatabase/NextgenDatabaseHelper.php');
	include_once('biz/nextgen-display/NextgenDisplay.php');
	
	// TODO: func. to strip query string
    function melsov_test_func($product_cnt=1) 
    {
    	global $wp_query;
		$var = "brobro";
		echo url();
		$nd = NextgenData::FromURL(url());
		$nd->debug();
		$galo = $nd->galleryObject();
		echo $galo->abspath;
		$ndis = new NextgenDisplay($nd);
		NextgenDatabaseHelper::ImagesForGalID($nd->galID());
		
		// $RURI = $Path=$_SERVER['REQUEST_URI'];
		// echo site_url();
		// echo $RURI;
    	if(isset($wp_query->query_vars['myvar'])) {
			$var = urldecode($wp_query->query_vars['myvar']);
		}
 		return  "<div>hihi * $var * was the var </div>";
		/*
 		$oscommercedb = new wpdb(get_option('oscimp_dbuser'),get_option('oscimp_dbpwd'), get_option('oscimp_dbname'), get_option('oscimp_dbhost'));
		$retval = '';
	    for ($i=0; $i<$product_cnt; $i++) {
	        //Get a random product
	        $product_count = 0;
	        while ($product_count == 0) {
	            $product_id = rand(0,30);
	            $product_count = $oscommercedb->get_var("SELECT COUNT(*) FROM products WHERE products_id=$product_id AND products_status=1");
	        }
	         
	        //Get product image, name and URL
	        $product_image = $oscommercedb->get_var("SELECT products_image FROM products WHERE products_id=$product_id");
	        $product_name = $oscommercedb->get_var("SELECT products_name FROM products_description WHERE products_id=$product_id");
	        $store_url = get_option('oscimp_store_url');
	        $image_folder = get_option('oscimp_prod_img_folder');
	 
	        //Build the HTML code
	        $retval .= '<div class="oscimp_product">';
	        $retval .= '<a href="'. $store_url . 'product_info.php?products_id=' . $product_id . '"><img src="' . $image_folder . $product_image . '" /></a><br />';
	        $retval .= '<a href="'. $store_url . 'product_info.php?products_id=' . $product_id . '">' . $product_name . '</a>';
	        $retval .= '</div>';
	 
	    }
	    return $retval;
		*/
	}

	function melsov_add_query_vars_filter($vars) {
		$vars[] = "myvar";
		return $vars;
	}
	add_filter('query_vars', 'melsov_add_query_vars_filter');
    
    function MSoscimp_admin() {
	    // iiiiinclude('test_p_print_admin.php');
	}
    
    function MSoscimp_admin_actions() {
 		// aaaaaadd_options_page("OSCommerce Product Display", "OSCommerce Product Display", 3, "OSCommerce Product Display", "oscimp_admin");
	}
 
	// add_action('admin_menu', 'oscimp_admin_actions');
?>