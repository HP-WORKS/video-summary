<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 2017/02/24
 * Time: 11:19
 */
namespace ero\model;


use ero\Initializer;

class extendPost
{
	/**
	 * @var \WP_Post
	 */
	public $post;


	public function __construct(\WP_Post $post)
	{
		$this->post = $post;
	}


	/**
	 * サムネイルのパスを取得
	 * @return string
	 */
	public function thumbnail()
	{
		return current(wp_get_attachment_image_src(
			get_post_thumbnail_id($this->post->ID), Initializer::thumbnail
		));
	}


	/**
	 * カテゴリ名を取得
	 * @return string
	 */
	public function category()
	{
		foreach (get_the_category() as $cat) return $cat->name;
	}


	/**
	 * カテゴリIDを取得
	 * @return array
	 */
	public function categoryId()
	{
		$ids = [];

		foreach (get_the_category() as $cat){
			$ids[] = $cat->term_id;
		}
		return $ids;
	}


	/**
	 * カスタムフィールド情報を取得
	 * @param $name
	 * @return string
	 */
	public function meta($name)
	{
		return current(get_post_meta($this->post->ID, $name, false));
	}


	/**
	 * 対象のキーで投票済みか調べる
	 * @param $key
	 * @return bool
	 */
	public function isVoted($key)
	{
		return in_array($this->post->ID, (array)$_COOKIE[$key]);
	}


	/**
	 * 関連する動画のクエリを取得
	 * @return \WP_Query
	 */
	public function relative()
	{
		$args = [
			'post_type'			=> 'post',
			'post_status'		=> 'publish',
			'posts_per_page'	=> 12,
			'post__not_in'		=> [$this->post->ID],
			'category__in'		=> $this->categoryId()
		];
		return new \WP_Query($args);
	}


	/**
	 * コンテンツ変換
	 * @return string
	 */
	public function content()
	{
		$content = $this->post->post_content;
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);

		return $content;
	}



}