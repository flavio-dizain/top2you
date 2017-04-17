<?php get_header(); ?>

<section id="conteudo" class="clearfix">
	<?php 
		if ( ! is_front_page() ) {
			echo '<h2 class="titulo-pagina">';
			if ( is_category() ) {
		        echo '<strong>' . single_cat_title( '', FALSE ) . '</strong>';
		    } elseif ( is_tag() ) {
		        echo 'Tag &quot;' . single_tag_title( '', FALSE ) . '&quot;';
		    } elseif ( is_search() ) {
		        echo 'Resultado da busca por <em>' . get_search_query() . '</em>';
		    } elseif ( is_author() ) {
		        echo 'Posts de <em>' . get_the_author_meta( 'nicename' ) . '</em>';
		    } elseif ( is_404() ) {
		        echo 'Página não encontrada';
		    } else {
		        echo wp_title( '' );
		    }
		    echo '</h2>';
		}
	?>
	<?php if ( have_posts() ) { ?>
		<div id="lista-conteudo">
			<?php while ( have_posts() ) { the_post(); ?>
				<div class="post clearfix <?php echo ( has_post_thumbnail() ) ? ' post-com-thumb' : ''; ?>">
					<?php the_post_thumbnail( 'thumb-lista-conteudo' , array( 'class' => 'imagem-destaque' ) ); ?>
					<div class="post-conteudo">
						<h3 class="titulo-post">
							<?php 
								$fecha_tag = '';
								if ( ! is_singular( array( 'programacao', 'evento' ) ) ) {
									echo '<a href="' . get_permalink() . '">';
									$fecha_tag = '</a>';
								} 
								echo get_the_title() . $fecha_tag;
							?>
						</h3>
						<?php 
							if ( is_singular() ) {
								the_content();	
							} else {
								the_excerpt();
							} 
						?>
					</div>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
</section>

<?php get_footer();