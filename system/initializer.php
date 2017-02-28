<?php
/**
 * 名前の衝突を避けたいので名前空間作成
 * User: developer
 * Date: 2017/02/24
 * Time: 10:57
 */
namespace ero;


class Initializer
{

	const thumbnail = "small-feature";


	public function __construct()
	{
		//テーマ初期化
		add_action('after_setup_theme', function()
		{
			//アイキャッチ有効化
			add_theme_support('post-thumbnails');

			//アイキャッチ画像サイズ設定
			add_image_size(self::thumbnail, 200, 150, true);
		});
		add_theme_support('title-tag');
        add_theme_support('automatic-feed-links');

		//post解析前に
		add_action("get_header", function()
		{
			if (is_single())
			{
				Controller::showSingle(get_post());
			}
		});

		//管理画面にカスタムフィールド実装
		add_action('admin_menu', function(){
			add_meta_box(
				'myCustom', '拡張情報', [$this, "setCustomField"], 'post', 'normal', 'high'
			);
		});

		//カスタムフィールド保存
		add_action('save_post', [$this, "saveCustomFiled"]);

		//Ajax通信
		add_action("wp_ajax_counter", [$this, "countVideo"]);
	}


	/**
	 * カウントアップ/ダウン処理
	 * 動画のお気に入りやイイねの加減
	 */
	public function countVideo()
	{
		try {
			if (isset($_COOKIE[$_GET["column"]]) === false)
			{
				//新規cookie設定
				setcookie(
					"{$_GET["column"]}[0]", $_GET["postId"], 0, '/'
				);
				throw new \Exception();
			}
			elseif (in_array($_GET["postId"], $_COOKIE[$_GET["column"]]) === false)
			{
				//既存cookieに追加
				setcookie(
					"{$_GET["column"]}[". count($_COOKIE[$_GET["column"]]) .']', $_GET["postId"], 0, '/'
				);
				throw new \Exception();
			}
			else {
				//存在済みを削除という意味
				$index = array_search($_GET["postId"], $_COOKIE[$_GET["column"]]);
				//cookie消去
				setcookie(
					"{$_GET["column"]}[{$index}]", null, -1, '/'
				);
				//デクリメント
				update_post_meta(
					$_GET["postId"],
					$_GET["column"],
					current(get_post_meta($_GET["postId"], $_GET["column"], false)) - 1
				);
			}
		}
		catch (\Exception $e){
			//値の追加
			update_post_meta(
				$_GET["postId"],
				$_GET["column"],
				current(get_post_meta($_GET["postId"], $_GET["column"], false)) + 1
			);
		}

	}


	/**
	 * カスタムフィールドの表示
	 */
	public function setCustomField()
	{
		include_once "views/customField.php";
	}


	/**
	 * カスタムフィールド保存
	 * @param $postId
	 */
	public function saveCustomFiled($postId)
	{
		$filedSet = [
			"time", "script", "preview", "favorite", "like"
		];
		foreach ($filedSet as $filed)
		{
			update_post_meta($postId, $filed, $_POST[$filed]);
		}
	}


}
new Initializer();