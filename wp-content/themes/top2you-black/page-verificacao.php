<?php 
	//print_r($_GET);

	global $wpdb;

	$results_m = $wpdb->get_results( 'SELECT * FROM wp_cf7dbplugin_submits WHERE field_value = "'.$_GET['m'].'" ', OBJECT );
	$results_c = $wpdb->get_results( 'SELECT * FROM wp_cf7dbplugin_submits WHERE field_value = "'.$_GET['confirm_code'].'" ', OBJECT );

	print_r($results);

	if(isset($results_m[0]) and isset($results_c[0])){
		if($results_m[0]->submit_time == $results_c[0]->submit_time){
			wp_redirect('/?news=ok');
			exit;
		}
	}

	wp_redirect('/?news=error');
	exit;
 ?>