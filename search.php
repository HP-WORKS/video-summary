<?php get_header(); ?>

<div class="container">

	<div class="col-xs-1 main-center">
		<ul class="breadcrumb pull-right sort-by">

			<?php if ($_GET["sort"] == 0){ ?>
				<li class="active">▼新着順</li>
			<?php } else { ?>
				<li><a href="<?php echo ero\Controller::addQuery("sort", 0); ?>">新着順</a></li>
			<?php } ?>

			<?php if ($_GET["sort"] == 1){ ?>
				<li class="active">▼お気に入り順</li>
			<?php } else { ?>
				<li><a href="<?php echo ero\Controller::addQuery("sort", 1); ?>">お気に入り順</a></li>
			<?php } ?>

			<?php if ($_GET["sort"] == 2){ ?>
				<li class="active">▼いいね順</li>
			<?php } else { ?>
				<li><a href="<?php echo ero\Controller::addQuery("sort", 2); ?>">いいね順</a></li>
			<?php } ?>

			<?php if ($_GET["sort"] == 3){ ?>
				<li class="active">▼再生回数順</li>
			<?php } else { ?>
				<li><a href="<?php echo ero\Controller::addQuery("sort", 3); ?>">再生回数順</a></li>
			<?php } ?>

		</ul>
		<h2>動画一覧</h2>
		<div class="clearfix"></div>
		<ul class="movie-list clearfix masonry">
			<?php
			/**
			 * クエリを取得
			 * @var $the_query WP_Query
			 */
			$the_query = ero\Controller::searchPost();

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
		<div class="bs-component">
			<?php
			call_user_func(function($hit, $per, $num){
				include "pager.php";

			}, $the_query->found_posts, get_option('posts_per_page'), get_query_var('page', 1));
			?>
		</div>
	</div>


	<?php get_sidebar(); ?>

</div>


<?php get_footer(); ?>
