	<footer>
		<div class="top">
			<div class="container">
				<h4>Acompanhe a top2you nas redes sociais</h4>
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
			<div class="bottom">
			<div class="container">
				<p>A Top2You é uma aceleradora de desenvolvimento de pessoas. Acreditamos que uma conversa pode inspirar e encurtar distâncias, principalmente quando essa conversa é com alguém que já fez esse caminho e chegou lá. A Top2You te dá a chance de conversar com grandes nomes do mundo dos negócios, esportes e entretenimento de forma personalizada, focada em um assunto definido por você e utilizando uma tecnologia que torna isso simples e acessível.</p>
			</div>
		</div>
		<div class="midle">
			<div class="container">
					<div class="footer-midle">
						<div class="col">
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
						?>
						</div>
						<div class="col">
							<div class="footer-menu">
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
								<p>&nbsp;<?php //echo get_theme_mod( 'rodape_copyright' ); ?></p>
							</div>
						</div>
						<div class="col">
							<div class="info">
								<?php 
									$endereco = get_theme_mod( 'rodape_endereco' );
									if ( $endereco ) {
										$endereco = explode( "\n", $endereco );
									}
									echo implode( ' <br> ', $endereco );
								?>
								<p><br>Contato: <a href="mailto:suporte@top2you.net">suporte@top2you.net</a></p>
							</div>
						</div>
					</div>
			</div>
		</div>
		<div>
			<div class="container text-center">
					<p style="margin: 0 0 30px;font-size: 12px;font-weight: 400;color: #999999;"><?php echo get_theme_mod( 'rodape_copyright' ); ?></p>
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