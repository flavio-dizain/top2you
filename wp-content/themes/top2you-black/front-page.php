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
					    	<div class="background" style="background-image: url(<?php echo $slide['imagem'] ?>);">
					      		<div class="text">
					      			<div class="container">
					      				<div class="row">
						      				<div class="col-sm-5 col-sm-push-6 content">
						      					<?php echo $slide['texto'] ?>
						      					<?php if ( 0 === strpos( $slide['botao']['url'], '#' ) ) { ?>
						      						<a href="#" data-toggle="modal" data-target="<?php echo $slide['botao']['url'] ?>" class="btn btn-default hidden-xs"><?php echo $slide['botao']['text'] ?></a>
						      					<?php } else { ?>
						      						<a href="<?php echo $slide['botao']['url'] ?>" target="<?php echo $slide['botao']['target'] ?>" class="btn btn-default hidden-xs"><?php echo $slide['botao']['text'] ?></a>
						      					<?php } ?>
						      				</div>
						      			</div>
					      			</div>
					      		</div>
					    	</div>
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
	/*
	echo '<!--';
	print_r($eventos);
	echo '-->';
	*/
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

							<?php echo $i % 2 == 0 ? '</div><div class="row">' : null ; ?>

							<div class="col-sm-6">
								<div class="card">
									<a href="<?php echo $evento->url ?>" class="card-header">
										<?php
										/*
										<span class="price">
										<?php 
											$menor_preco = 0;
											$gratis = FALSE;
											foreach ( $evento->tickets as $ticket ) {
												if ( 'AVAILABLE' == $ticket->on_sale_status ) {
													if ( $ticket->free ) {
														$gratis = TRUE;
														break;
													} elseif ( 0 === $menor_preco OR $menor_preco > $ticket->cost->major_value ) {
														$menor_preco = $ticket->cost->major_value;
													}
												}
											}
											if ( $gratis ) {
												echo 'GRÁTIS';
											} else {
												if ( count( $evento->tickets ) > 1 ) {
													echo 'A PARTIR DE ';
												}
												echo 'R$'.absint( $menor_preco );
											}
										?>
										</span>
										*/
										?>
										<div class="image" style="background-image: url(<?php echo $evento->logo_url ?>);">
											<img src="<?php echo get_template_directory_uri() ?>/img/card-height.jpg">
										</div>
									</a>
									<a href="<?php echo $evento->url ?>" class="card-body">
										<?php
										$tit = explode('-', $evento->post_title);
										echo isset($tit[1]) ? '<h4>'.$tit[0].'</h4><h5>'.$tit[1].'</h5>' : '<h5>'.$evento->post_title.'</h5>'; ?>
									</a>
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
								</div>
							</div>
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
<section>
	<div class="container">
		<div class="zoom">
			<img src="<?php echo bloginfo('template_url'); ?>/img/gift.jpg" class="img-responsive">
		</div>
	</div>
</section>

<section class="banner-blog" style="background-image: url(<?php echo bloginfo('template_url'); ?>/img/banner-blog.jpg);">
	<div class="container">
		<h4>Conheça o nosso blog</h4>
		<a href="#">leia mais <i class="fa fa-angle-right"></i></a>
	</div>
</section>
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

					<?php echo $formulario_form ?>
				</div>
			</div>
		</section>
		<?php
	}
?>

<?php get_footer();