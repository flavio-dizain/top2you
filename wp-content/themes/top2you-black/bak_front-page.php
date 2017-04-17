<?php get_header(); ?>

<?php
	// Slider principal
	$slider = CFS()->get( 'slider' );
	if ( count( $slider ) ) {
		?>
		<div class="container-outer container-slider border-fade">
			<div class="slick-slider">
				<div class="slick-slider-for">
				  	<?php
				  		$i = 0;
				  		foreach ( $slider as $slide ) {
				  			?>
					    	<a href="<?php echo $slide['botao']['url'] ?>" target="_blank" class="background" style="background-image: url(<?php echo $slide['imagem'] ?>);">
					      		<div class="text">
					      			<div class="container">
					      				<div class="row">
						      				<div class="col-sm-5 col-sm-push-6 content">
						      					<?php echo $slide['texto'] ?>
						      					<?php if ( 0 === strpos( $slide['botao']['url'], '#' ) ) { ?>
						      						<div href="#" data-toggle="modal" data-target="<?php echo $slide['botao']['url'] ?>" class="btn btn-default hidden-xs"><?php echo $slide['botao']['text'] ?></div>
						      					<?php } else { ?>
						      						<div href="<?php echo $slide['botao']['url'] ?>" target="<?php echo $slide['botao']['target'] ?>" class="btn btn-default hidden-xs"><?php echo $slide['botao']['text'] ?></div>
						      					<?php } ?>
						      				</div>
						      			</div>
					      			</div>
					      		</div>
					      		<div class="text-mob">
					      			<div class="container">
					      				<h2><?php echo $slide['speaker']; ?></h2>
					      				<h3><?php echo $slide['cargo']; ?></h3>
					      			</div>
					      		</div>
					    	</a>
				  			<?php
				  		}
				  	?>
				</div>
			</div>

			<div class="container-outer border-fade" style="position: relative;">
				<div class="slick-slider-nav">
				  	<?php
				  		foreach ( $slider as $slide ) {

				  			//print_r($slide);
				  			?>
							  <div class="background" style="background-image: url(<?php echo $slide['imagem'] ?>);">
							  	<img src="<?php echo bloginfo('template_url'); ?>/img/thumb-height.jpg">
							  	<div class="text">
								  	<h5><?php echo $slide['speaker']; ?></h5>
								  	<h6><?php echo $slide['cargo']; ?></h6>
							  	</div>
							  </div>
				  			<?php
				  		}
				  	?>
				</div>
				<a href="#" class="slick-slider-prev"><i class="fa fa-angle-left"></i></a>
				<a href="#" class="slick-slider-next"><i class="fa fa-angle-right"></i></a>
			</div>
		</div>
		<?php
	}


	// Chamada
	$chamada = CFS()->get( 'chamada' );
	if ( $chamada ) {
		?>
		<section>
			<div class="container">
				<div class="row">
					<div class="col-sm-10 col-sm-push-1 text-center call">
						<h2><?php echo $chamada ?></h2>
					</div>
				</div>
			</div>
		</section>
		<?php
	}


	// Eventos
	$eventos = eventbrite_get_events( array(
		'show_series_parent' => true,
		'page' => ( empty( $_GET['page'] ) ) ? 1 : absint( $_GET['page'] ),
	), TRUE );

	/*echo '<!--';
	echo $evento->end->local;
	echo '-->';*/

	if ( isset( $eventos->events ) AND is_array( $eventos->events ) ) {
		$i = 0;
		?>
		<section id="eventos">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<!-- <h4 style="color: #fff;"><?php //echo CFS()->get( 'eventos_titulo' ) ?></h4> -->
					</div>
				</div>
				<div class="row">
					<?php
						foreach ( $eventos->events as $evento ) { setup_postdata( $evento ); ?>

							<?php //echo $i % 2 == 0 ? '</div><div class="row">' : null ; ?>
							<?php if($evento->ID != '33496830923')://'33496830923'): ?>
							<div class="col-sm-6">
								<a href="<?php echo $evento->url ?>" target="_blank" class="card">
									<div class="card-header">
										<div class="image" style="background-image: url(<?php echo $evento->logo_url ?>);">
											<img src="<?php echo get_template_directory_uri() ?>/img/card-height.jpg">
										</div>
									</div>
									<div class="card-body">
										<?php
										$tit = explode('-', $evento->post_title);
										echo isset($tit[1]) ? '<h4>'.$tit[0].'</h4><h5>'.$tit[1].'</h5>' : '<h5>'.$evento->post_title.'</h5>'; ?>
									</div>
									<div class="card-footer">
										<?php
											// Tags foram removidas (http://stackoverflow.com/questions/13380228/eventbrite-tags)
											// Alterados para categoria, subcategoria e formato

											$fake_tags = array( 'category', 'subcategory', 'format' );
											$links = array();
											foreach ( $fake_tags as $tag ) {
												if ( isset( $evento->{$tag}->short_name_localized ) ) {
													$links[] = $evento->{$tag}->short_name_localized;
												}
											}

											if ( count( $links ) ) {
												?>
												<div class="card-footer-left">
													<?php foreach ( $links as $link ) { ?>
														<a href="<?php echo $evento->url ?>">#<?php echo $link ?></a>
													<?php } ?>
												</div>
												<?php
											}
										?>
										<!--div class="card-footer-right">
											<a href="#"><i class="ico-share"></i></a>
											<a href="#"><i class="ico-bookmark"></i></a>
										</div-->
									</div>
								</a>
							</div>
							<?php endif; ?>
						<?php

						$i++;
						}
					?>
				</div>
				<?php if ( $eventos->pagination->page_count > $eventos->pagination->page_number) { ?>
					<div class="row">
						<div class="col-sm-2 col-sm-push-5">
							<a href="<?php the_permalink(); echo '?page=' . ( $eventos->pagination->page_number + 1 ) ?>" class="btn btn-default btn-block text-uppercase"><?php echo CFS()->get( 'eventos_botao' ) ?></a>
						</div>
					</div>
				<?php } ?>
			</div>
		</section>
		<?php
	}


?>
<section id="gift">
	<div class="container">
		<div class="zoom">
			<img src="<?php echo bloginfo('template_url'); ?>/img/banner_gift.jpg" class="img-responsive">
		</div>
	</div>
</section>

<!-- <section class="banner-blog" style="background-image: url(<?php echo bloginfo('template_url'); ?>/img/banner-blog.jpg);">
	<div class="container">
		<h4>Conheça o nosso blog</h4>
		<a href="#">leia mais <i class="fa fa-angle-right"></i></a>
	</div>
</section> -->
<?php



	// Formulário de cadastro
	$formulario_titulo = CFS()->get( 'formulario_titulo' );
	$formulario_form = CFS()->get( 'formulario_form' );
	if ( $formulario_form OR $formulario_titulo ) {
		?>
		<section>
			<div class="news">
				<div class="container">
					<?php if ( $formulario_titulo ) { ?>
						<h2><?php echo $formulario_titulo ?></h2>
					<?php } ?>

					<?php $UID = md5(uniqid());  echo do_shortcode('[contact-form-7 id="17" title="Formulário de cadastro" v-code="'.$UID.'"]'); //echo $formulario_form  ?>

					<?php echo "<!--"; echo $UID; echo "-->"; ?>
				</div>
			</div>
		</section>
		<?php
	}
?>

<div class="social-networks">
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

<?php get_footer(); ?>
<?php if(isset($_GET['news'])): if($_GET['news'] == 'ok'): ?>
<!-- Modal -->
<div id="myModal_yes" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cadastro de Newsletter</h4>
      </div>
      <div class="modal-body">
        <p>Sua verificação foi realizada com sucesso. Aguarde novidades</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#myModal_yes').modal('show');
		$('#myModal_yes').on('hidden.bs.modal', function () {
		 	window.location.href = "<?php echo get_bloginfo('url'); ?>";
		});
	});
</script>
<?php endif; if($_GET['news'] == 'error'): ?>
<!-- Modal -->
<div id="myModal_no" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cadastro de Newsletter</h4>
      </div>
      <div class="modal-body">
        <p>Erro ao verificar seu cadastro, favortente novamente mais tarde.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#myModal_no').modal('show');
		$('#myModal_no').on('hidden.bs.modal', function () {
		 	window.location.href = "<?php echo get_bloginfo('url'); ?>";
		});
	});
</script>
<?php endif; endif; ?>
