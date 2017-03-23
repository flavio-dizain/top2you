	<footer>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="info">
						<?php 
							$rodape_logo_link = get_theme_mod( 'rodape_logo_link' );
							$rodape_logo = get_theme_mod( 'rodape_logo' );
							if ( $rodape_logo ) {
								$fecha_tag = '';
								if ( $rodape_logo_link ) {
									echo '<a href="' . $rodape_logo_link . '" target="_blank">';
									$fecha_tag = '</a>';
								}
								echo '<img src="' . $rodape_logo . '" alt="top2you">';
								echo $fecha_tag;
							}

							$endereco = get_theme_mod( 'rodape_endereco' );
							if ( $endereco ) {
								$endereco = explode( "\n", $endereco );
								?>
								<p>
									A Top2You é uma aceleradora de desenvolvimento de pessoas. Acreditamos que uma conversa pode inspirar e encurtar distâncias, principalmente quando essa conversa é com alguém que já fez esse caminho e chegou lá. A Top2You te dá a chance de conversar com grandes nomes do mundo dos negócios, esportes e entretenimento de forma personalizada, focada em um assunto definido por você e utilizando uma tecnologia que torna isso simples e acessível.
								</p>
								<?php
							}
						?>
					</div>
				</div>
				<div class="col-sm-8 col-sm-push-1 footer-right">
					<div>
						<ul>
							<?php 
					 			wp_nav_menu( array(
					 				'theme_location' => 'menu-rodape', 
					 				'container' => false, 
					 				'items_wrap' => '%3$s',
				 					'fallback_cb' => false,
					 			) ); 
					 		?>
						</ul>
					</div>
					<div>
						<ul>
							<?php 
					 			wp_nav_menu( array(
					 				'theme_location' => 'redes-sociais', 
					 				'container' => false, 
					 				'items_wrap' => '%3$s',
				 					'fallback_cb' => false,
				 					'link_before' => '<i class="icon icon-social-',
				 					'link_after' => '-square"></i>',
					 			) ); 
					 		?>
						</ul>
					</div>
					<div>
						<p class="pull-left" style="text-transform: initial;"><?php echo implode( ' <br> ', $endereco ); ?></p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-8 col-sm-push-4 footer-right">
					<div style="padding: 0;">
						<p class="pull-left" style="font-size:10px; color:#999;"><?php echo get_theme_mod( 'rodape_copyright' ); ?></p>
						<a href="http://dizain.com.br/" target="_blank" class="pull-right"><img src="<?php echo get_template_directory_uri() ?>/img/dizainicon.png"></a>
					</div>
				</div>
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