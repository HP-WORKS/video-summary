<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php wp_title(); ?></title>

	<link rel="stylesheet" href="<?php print get_template_directory_uri(); ?>/local/css/bootstrap.cosmo.min.css">
	<link rel="stylesheet" href="<?php print get_template_directory_uri(); ?>/style.css">

	<head profile="http://gmpg.org/xfn/11">
    <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="navbar navbar-default">
	<div class="container">
		<div class="navbar-header">
			<a href="<?php print home_url(); ?>" class="navbar-brand">WordPress Theme VideoSummary </a>
		</div>
		<div class="navbar-collapse collapse" id="navbar-main">
			<h1>ワードプレスで動画まとめサイトを作ろう</h1>
		</div>
	</div>
</div>
<div class="search-bar">
	<div class="container">
		<form class="col-xs-12 searcher" action="<?php print home_url(); ?>" method="get">
			<div class="input-group">
				<input
					type="search"
					name="s"
					class="form-control"
					placeholder="キーワード検索"
					value=""
				/>
				<div class="input-group-btn">
					<button type="submit" class="btn btn-primary">検索</button>
				</div>
			</div>
		</form>
	</div>
</div>