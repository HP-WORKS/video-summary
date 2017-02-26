<li class="col-xs-3">
	<a href="<?php the_permalink(); ?>">
		<div class="thumbnail clearfix">
			<div class="images">

				<?php if(has_post_thumbnail()): ?>

					<img src="<?php echo $extends->thumbnail(); ?>" alt="<?php the_title(); ?>">

				<?php else: ?>

					<img src="<?php print get_template_directory_uri(); ?>/local/image/noImage.png">

				<?php endif; ?>

			</div>
			<p>
				<?php the_title(); ?>
			</p>
			<div class="category black">
				<?php echo $extends->category(); ?>
			</div>
			<div class="col-xs-6 no-side black">
				<i class="fa fa-thumbs-up"></i>
				<?php echo number_format($extends->meta("like")); ?>
			</div>
			<div class="col-xs-6 no-side black">
				<i class="fa fa-eye"></i>
				<?php echo number_format($extends->meta("preview")); ?>
			</div>
		</div>
	</a>
</li>