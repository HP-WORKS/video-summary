<?php
/**
 * 名前の衝突を避けたいので名前空間作成
 * User: developer
 * Date: 2017/02/24
 * Time: 10:57
 */
namespace ero;
use ero\model\extendPost;

//依存クラスロード
require_once "models/post.php";

/**
 * Class Controller
 * @package ero
 */
class Controller
{


	/**
	 * パラメータを追加してURLを返却する
	 * @param $key
	 * @param $value
	 * @return string
	 */
	public static function addQuery($key, $value)
	{
		parse_str(
			$_SERVER["QUERY_STRING"], $httpQue
		);
		$httpQue[$key] = $value;

		return home_url() ."?". http_build_query($httpQue);
	}


	/**
	 * WP_Postから拡張POSTクラスを生成
	 * @param \WP_Post $post
	 * @return extendPost
	 */
	public static function getExtendPost(\WP_Post $post)
	{
		return new extendPost($post);
	}


    /**
     * リクエストパラメータ取得
     * @param $key
     * @param null $default
     * @return null
     */
	public static function get($key, $default=null)
    {
        return (isset($_GET[$key])) ? $_GET[$key] : $default;
    }


	/**
	 * 検索条件を判定してWP_Postの配列を取得
	 * @return [WP_Post]
	 */
	public static function searchPost()
	{
		$args = [
			'post_type'			=> 'post',
			'post_status'		=> 'publish',
			'posts_per_page'	=> get_option('posts_per_page')
		];
		switch (self::get("sort"))
		{
			case 1:
				$args["orderby"]	= "meta_value_num";
				$args["order"]		= "DESC";
				$args["meta_key"]	= "favorite";
				break;

			case 2:
				$args["orderby"]	= "meta_value_num";
				$args["order"]		= "DESC";
				$args["meta_key"]	= "like";
				break;

			case 3:
				$args["orderby"]	= "meta_value_num";
				$args["order"]		= "DESC";
				$args["meta_key"]	= "preview";
				break;

			default :
				$args["orderby"]	= "date";
				break;
		}

		if (self::get("favorite") == 1){
			if (isset($_COOKIE["favorite"]) && count($_COOKIE["favorite"]) > 0){
				$args["post__in"] = $_COOKIE["favorite"];
			}
			else {
				$args["post__in"] = [0];
			}
		}

		if (self::get("history") == 1){
			if (isset($_COOKIE["favorite"]) && count($_COOKIE["preview"]) > 0){
				$args["post__in"] = $_COOKIE["preview"];
			}
			else {
				$args["post__in"] = [0];
			}
		}

		if (get_query_var('cat') !== null){
			$args["cat"] = get_query_var('cat');
		}
		if (get_query_var('tag') !== null){
			$args["tag"] = get_query_var('tag');
		}
		if (self::get("s") !== null){
			$args["s"] = self::get("s");
		}
		if (self::get("page") !== null){
			$args["paged"] = self::get("page");
		}

		return new \WP_Query($args);
	}


	/**
	 * 記事の数を取得
	 * @return int
	 */
	public static function countArticles()
	{
		$my_query = new \WP_Query([
			'post_type'		=> 'post',
			'post_status'	=> 'publish'
		]);
		return (int)$my_query->found_posts;
	}


	/**
	 * カテゴリ内の記事の数を取得
	 * @param $categoryId
	 * @return int
	 */
	public static function countInCategory($categoryId)
	{
		$my_query = new \WP_Query([
			'post_type'		=> 'post',
			'post_status'	=> 'publish',
			'cat'			=> $categoryId
		]);
		return (int)$my_query->found_posts;
	}



	/**
	 * 単一のページを読んだ
	 * @param WP_Post $post
	 */
	public static function showSingle(\WP_Post $post)
	{
		if (!headers_sent() && !wp_is_post_revision($post))
		{
			if (isset($_COOKIE["preview"]) === false)
			{
				//新規cookie設定
				setcookie('preview[0]', $post->ID, 0, '/');
			}
			elseif (in_array($post->ID, (array)$_COOKIE['preview']) === false)
			{
				//既存cookieに追加
				setcookie('preview[' . count($_COOKIE['preview']) . ']', $post->ID, 0, '/');
			}

			//記事の閲覧数をインクリメント
			update_post_meta(
				$post->ID, "preview", current(get_post_meta($post->ID, "preview", false)) + 1
			);
		}
	}


}