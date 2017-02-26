<?php
/**
 * カスタムフィールドのView
 *
 * @package WordPress
 * @subpackage VideoSummary
 * @since VideoSummary 1.0
 *
 * @var $post \WP_Post
 */
$post = get_post();
?>
<div class="customField">
	<dl>
		<dt>
			<span><label>再生時間</label></span>
		</dt>
		<dd>
			<input name="time" value="<?php echo get_post_meta($post->ID,'time',true); ?>" type="text" placeholder="例) 12:34">
		</dd>
	</dl>
	<dl>
		<dt>
			<span><label>動画タグ</label></span>
		</dt>
		<dd>
			<textarea name="script"><?php echo get_post_meta($post->ID,'script',true); ?></textarea>
		</dd>
	</dl>

	<dl>
		<dt>
			<span><label>閲覧数</label></span>
		</dt>
		<dd>
			<input name="preview" value="<?php echo (int)get_post_meta($post->ID,'preview',true); ?>" type="number" required min="0">
			回
		</dd>
	</dl>
	<dl>
		<dt>
			<span><label>お気に入り数</label></span>
		</dt>
		<dd>
			<input name="favorite" value="<?php echo (int)get_post_meta($post->ID,'favorite',true); ?>" type="number" required min="0">
			回
		</dd>
	</dl>
	<dl>
		<dt>
			<span><label>いいね数</label></span>
		</dt>
		<dd>
			<input name="like" value="<?php echo (int)get_post_meta($post->ID,'like',true); ?>" type="number" required min="0">
			回
		</dd>
	</dl>
</div>
<style>
	.customField dt {
		width:20%;
		clear:both;
		float:left;
		display:inline;
		font-weight:bold;
		text-align:center;
	}
	.customField dd {

	}
	.customField textarea {
		width: 600px;
		height: 100px;
		max-width: 100%;
	}
	.customField textarea, .customField input {
		outline: 0;
		background-color: #ffe;
	}
</style>