	<footer>
		<div class="top">
			<div class="container">
				<h4>Acompanhe a top2you nas redes socias</h4>
				<ul class="social">


							<?php 
					 			wp_nav_menu( array(
					 				'theme_location' => 'redes-sociais', 
					 				'container' => false, 
					 				'items_wrap' => '%3$s',
				 					'fallback_cb' => false,
				 					'link_before' => '<i class="icon icon-social-',
				 					'link_after' => '"></i>',
					 			) ); 
					 		?>

				</ul>
			</div>
		</div>
	</footer>
	
	<?php 
		$modais = new WP_Query( array(
			'post_type' => 'page',
			'posts_per_page' => -1,
			'meta_key' => '_wp_page_template',
			'meta_value' => 'template-modal.php',
		) );
		if ( $modais->have_posts() ) {
			while ( $modais->have_posts() ) { $modais->the_post();
				?>
				<div id="<?php echo $post->post_name ?>" class="modal fade" role="dialog">
				  	<div class="modal-dialog">
				    	<div class="modal-content">
					      	<div class="modal-header">
					        	<a href="#"><i class="fa fa-times-circle" data-dismiss="modal"></i></a>
					      	</div>
				      		<div class="modal-body">
				      			<?php the_content(); ?>
				      			<?php edit_post_link('(Editar)', '<p>', '</p>'); ?>
				      		</div>
				    	</div>
				  	</div>
				</div>
				<?php
			}
			wp_reset_postdata();
		}
	?>

	<?php wp_footer(); ?>
</body>
</html>