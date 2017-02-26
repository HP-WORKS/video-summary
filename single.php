<?php

/**
 * 拡張Postクラスを作成
 * @var $extends ero\model\extendPost
 */
$extends = ero\Controller::getExtendPost($post);

get_header();
?>
<script>
	var ajaxTo = "<?php bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php";
	var postId = "<?php echo $post->ID; ?>";
</script>
<div class="container">

	<article class="col-xs-1 main-center detail">

		<h2><?php print the_title(); ?></h2>

		<div class="movie-player">
			<?php echo $extends->meta("script"); ?>
		</div>
		<footer>
			<ul>
				<li
					id="favorite"
					class="actions <?php echo ($extends->isVoted("favorite")) ? "added" : null; ?>"
					data-type="favorite">

					<span>お気に入り</span>
				</li>
				<li
					id="like"
					class="actions <?php echo ($extends->isVoted("like")) ? "added" : null; ?>"
					data-type="like">

					<span>
						いいね
					</span>
				</li>
			</ul>
		</footer>

		<div class="movie-info clearfix">

			<div class="image thumbnail">
				<?php if(has_post_thumbnail()): ?>

					<img src="<?php echo $extends->thumbnail(); ?>" alt="<?php the_title(); ?>">

				<?php else: ?>

					<img src="<?php print get_template_directory_uri(); ?>/local/image/noImage.png">

				<?php endif; ?>
			</div>
			<div class="details">
				<div>
					投稿日：<?php print get_the_date(); ?>
				</div>
				<div>
					カテゴリ：<?php print the_category(','); ?>
				</div>
				<div>
					<?php the_tags(); ?>
				</div>
			</div>
			<div class="result">
				<div>
					<strong><?php echo number_format($extends->meta("preview")); ?></strong>
					回再生
				</div>
				<div>
					<strong><?php echo number_format($extends->meta("favorite")); ?></strong>
					お気に入り
				</div>
				<div id="reaction-counts">
					<strong><?php echo number_format($extends->meta("like")); ?></strong>
					いいね
				</div><!-- /#reaction-counts -->
			</div>
			<div class="clearfix"></div>
		</div>

		<div class="movie-info message">
			<p><?php echo $extends->content(); ?></p>
		</div>

		<h3>関連動画</h3>
		<ul class="movie-list clearfix masonry">
			<?php
			/**
			 * 関連動画を取得
			 * @var $the_query WP_Query
			 */
			$the_query = $extends->relative();

			while ($the_query->have_posts()): $the_query->the_post();
				/**
				 * 拡張Postクラスを作成
				 * @var $extends ero\model\extendPost
				 */
				$extends = ero\Controller::getExtendPost($post);

				//動画単体
				include "movie.php";
			endwhile;
			//リセット
			wp_reset_postdata();
			?>
		</ul>

		<div class="clearfix"></div>

	</article>

	<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>