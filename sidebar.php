<div class="col-xs-1 main-left">

	<h4>メニュー</h4>
	<div class="list-group">
		<a href="<?php print home_url(); ?>?s=&favorite=1" class="list-group-item">お気に入り</a>
		<a href="<?php print home_url(); ?>?s=&history=1" class="list-group-item">視聴履歴</a>
	</div>

	<h4>カテゴリ</h4>
	<div class="list-group">
		<?php
		foreach(get_categories() as $value):
			?>

			<a href="<?php print home_url(); ?>/category/<?php echo $value->slug; ?>/" class="list-group-item">

				<span class="badge"><?php
					echo number_format(\ero\Controller::countInCategory($value->cat_ID)); ?></span>

				<?php echo esc_html($value->name); ?>
			</a>

		<?php endforeach; ?>
	</div>

	<h5>その他</h5>
	<div class="list-group">
		<a href="<?php print home_url(); ?>/rss/" class="list-group-item">RSS 2.0</a>
	</div>

	<h5>全記事数</h5>
	<ul>
		<li><!-- 全記事数 --><?php echo ero\Controller::countArticles(); ?><!-- 全記事数 --></li>
	</ul>
</div>
