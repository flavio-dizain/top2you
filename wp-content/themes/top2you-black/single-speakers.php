<?php get_header('interna'); the_post(); ?>

<div class="banner-biografia" style="background-image: url(<?php $banner = CFS()->get('banner'); echo $banner; ?>);">
	<div class="container">
		<?php if(CFS()->get('intro_video')['url'] != ''): ?>
			<a href="#" data-toggle="modal" data-target="#videoModal" class="play">
				<img src="<?php bloginfo('template_url'); ?>/img/play.png">
				<p>Assista ao Vídeo</p>
			</a>
		<?php endif; ?>
	</div>
</div>
<div class="container">
	<div class="row profile">
		<div class="col-sm-8">
			<div class="photo" style="background-image: url(<?php $img = wp_get_attachment_image_src(get_post_thumbnail_id(), ['size'=>'normal']); echo $img[0]; ?>);"></div>
			<h1><?php the_title(); ?></h1>
			<h2><?php the_excerpt(); ?></h2>
		</div>
		<div class="col-sm-4">
			<div class="ingressos" style="width:100%; text-align:left;"><iframe src="<?php echo CFS()->get('eventbrite_url'); ?>" frameborder="0" height="370" width="100%" vspace="0" hspace="0" marginheight="5" marginwidth="5" scrolling="no" allowtransparency="true"></iframe></div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-8">
			<div class="biografia border-top">
				<?php the_content(); ?>
				<blockquote>
					<?php echo CFS()->get('citacao'); ?>
				</blockquote>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="motivacoes border-top">
				<div class="box-black">
					<h4>Motivações</h4>
					<?php echo CFS()->get('motivacoes'); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="row row-eq-height-xs listas">
		<div class="col-sm-4">
			<div class="box-list">
				<div class="content">
					<h4>Valores</h4>
					<?php echo CFS()->get('valores'); ?>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="box-list">
				<div class="content">
					<h4>Quem me inspira</h4>
					<?php echo CFS()->get('inspiracao'); ?>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="box-list">
				<div class="content">
					<h4>Hobbies</h4>
					<?php echo CFS()->get('hobbies'); ?>
				</div>
			</div>
		</div>
	</div>

	<div class="hidden-xs" style="margin-bottom: 30px;"></div>

	<div class="social-networks biografia">
		<div class="container">
			<h4>Redes Sociais</h4>
			<ul class="social">

				<?php echo CFS()->get('facebook')['url'] != '' ? '<li><a href="'.CFS()->get('facebook')['url'].'" target="_blank"><i class="icon icon-social-facebook"></i></a></li>' : null; ?>
				<?php echo CFS()->get('linkedin')['url'] != '' ? '<li> <a href="'.CFS()->get('linkedin')['url'].'" target="_blank"><i class="icon icon-social-linkedin"></i></a> </li>' : null; ?>
				<?php echo CFS()->get('instagram')['url'] != '' ? '<li> <a href="'.CFS()->get('instagram')['url'].'" target="_blank"><i class="icon icon-social-instagram"></i></a> </li>' : null; ?>
				<?php echo CFS()->get('youtube')['url'] != '' ? '<li> <a href="'.CFS()->get('youtube')['url'].'" target="_blank"><i class="icon icon-social-youtube"></i></a> </li>' : null; ?>
			</ul>
		</div>


	</div>
	<div class="midias">

		<?php $yt_posts = CFS()->get('youtube_posts'); $instas = CFS()->get('instagram_posts'); ?>
		<div class="row row-eq-height-xs">
			<div class="col-xs-1"><i class="icon icon-arrow-carrot-left arrow-youtube"></i></div>
			<div class="col-xs-10">
				<div class="youtube midia">
					<?php foreach ($yt_posts as $p) : ?>
						<div><a href="<?php echo $p['video']['url']; ?>" target="_blank"><img src="<?php echo 'https://img.youtube.com/vi/'. youtube_id_from_url($p['video']['url']) .'/default.jpg'; ?>"></a></div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="col-xs-1"><i class="icon icon-arrow-carrot-right arrow-youtube"></i></div>
		</div>
		<div class="row row-eq-height-xs">
			<div class="col-xs-1"><i class="icon icon-arrow-carrot-left arrow-instagram"></i></div>
			<div class="col-xs-10">
				<div class="instagram midia">
					<?php foreach ($instas as $i) :  ?>
						<div><a href="<?php echo $i['post']['url']; ?>" target="_blank"><img src="<?php echo 'https://instagr.am/p/'. instagram_post_id($i['post']['url']) .'/media/?size=t'; ?>"></a></div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="col-xs-1"><i class="icon icon-arrow-carrot-right arrow-instagram"></i></div>
		</div>
	</div>

</div>
<?php if(CFS()->get('intro_video')['url'] != ''): ?>
	<div id="videoModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	  	<a href="#" data-dismiss="modal"><i class="fa fa-times"></i></a>
	    <iframe src="<?php echo CFS()->get('intro_video')['url']; ?>" frameborder="0" allowfullscreen></iframe>
	  </div>
	</div>
<?php endif; ?>

<?php get_footer(); ?>
