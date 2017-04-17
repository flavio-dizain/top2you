<!doctype html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>

	<style>
	#count-load {

	}
	</style>

	<!-- Facebook Pixel Code --> 
	<script> 
	!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod? 
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n; 
	n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0; 
	t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window, 
	document,'script','https://connect.facebook.net/en_US/fbevents.js'); 
	fbq('init', '1881561618725207'); // Insert your pixel ID here. 
	fbq('track', 'PageView'); 
	</script> 
	<noscript><img height="1" width="1" style="display:none" 
	src="https://www.facebook.com/tr?id=1881561618725207&ev=PageView&noscript=1"; 
	/></noscript> 
	<!-- DO NOT MODIFY --> 
	<!-- End Facebook Pixel Code --> 
	
	<!-- Google Analytics -->
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-96533081-1', 'auto');
	  ga('send', 'pageview');

	</script>

</head>
<body <?php body_class(); ?>>

<!-- progress bar || progress.js-->
<style type="text/css">
.progress {position: fixed; left: 0px; top: 0px; width: 100%; height: 100%; z-index: 9999; background-color: #1e1d1b; }
.bar {display: none; background-color: #be3e3b; width:0%; height:5px; border-radius: 3px; }
#percent1 {display: none;}
.percent {display: none; color: #fff; position: absolute; display: inline-block; font-size: 50px; top: 50%; left: 50%; transform: translate(-50%, -50%); }
#wrapper {width:995px; padding:0px; margin:0px auto; font-family:helvetica; text-align:center; }
h1 {text-align:center; font-size:35px; margin-top:60px; color:#A9BCF5; }
h1 p {text-align:center; margin:0px; font-size:18px; text-decoration:underline; color:grey; }
</style>
<div class='progress' id="progress_div">
	<div class='bar' id='bar1'></div>
	<div class='percent' id='percent1'><span>0</span>%</div>
</div>
<!-- / progress bar -->

<input type="hidden" id="progress_width" value="0">


	<nav class="navbar navbar-default">
	  	<div class="container">
	    	<div class="navbar-header">
	      		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span> 
	      		</button>
		      	<a class="navbar-brand" href="<?php echo home_url('/'); ?>">
					<?php echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full', false, array( 'alt' => get_bloginfo( 'name' ), 'class' => 'img-responsive' ) );  ?>
		      	</a>
	    	</div>
	    	<div class="collapse navbar-collapse" id="myNavbar">
	      		<ul class="nav navbar-nav navbar-right text-uppercase">
					<?php 
			 			wp_nav_menu( array(
			 				'theme_location' => 'menu-topo', 
			 				'container' => false, 
			 				'items_wrap' => '%3$s',
		 					'fallback_cb' => false,
			 			) ); 
			 		?>
	      		</ul>
	    	</div>
	  	</div>
	</nav>