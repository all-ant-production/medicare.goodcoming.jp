<?php

/*********************************************************************************
**********************************************************************************
* 2025.01.28
* auther:emrt
*　［説明］fuctions.phpの分割
**********************************************************************************
**********************************************************************************/


/******************************************************************** 
 * サイドメニューの並べ替え
 ********************************************************************/

function custom_menu_order($menu_ord) {
		if (!$menu_ord) return true;
		return array(

				'separator1', // 仕切り
				'index.php',							 // ダッシュボード   
				'separator2', // 仕切り

				'edit.php', 							 // 投稿
				'edit.php?post_type=media',				 //カスタム投稿
				'edit.php?post_type=interview',			 //カスタム投稿
				'edit.php?post_type=manga',				 //カスタム投稿
				'edit.php?post_type=supervision',		 //カスタム投稿
				'edit.php?post_type=lic',				 //カスタム投稿
				'edit.php?post_type=contributor',		 //カスタム投稿
				'edit.php?post_type=news',				 //カスタム投稿
				'edit.php?post_type=qa',				 //カスタム投稿
				'edit.php?post_type=review',			 //カスタム投稿
				'edit.php?post_type=page',				 // 固定ページ

				'separator3', // 仕切り
				'upload.php',							 // メディア
				'themes.php',							 // 外観
				'plugins.php',							 // プラグイン
				'users.php',							 // ユーザー
				'tools.php',							 // ツール
				'options-general.php',					 // 設定
				'edit-comments.php',					 // コメント
				'link-manager.php',						 // リンク
				'admin.php?page=wsal-auditlog',			 // ログ
				'separator-last', // 仕切り
		);
}
add_filter('custom_menu_order', 'custom_menu_order');
add_filter('menu_order', 'custom_menu_order');




/******************************************************************** 
* ユーザー毎にサイドメニューの非表示
* ユーザーIDに特定文字を含む場合、strpos()関数を使用し判別
* キーワードがこれ以上多くなる場合、配列化し変更してください。
*********************************************************************/

/******************************************************************** 
* 権限回りでの表示非表示
*********************************************************************/
/***更新アラート********/
//add_filter('pre_site_transient_update_core', '__return_zero');
//remove_action('wp_version_check', 'wp_version_check');
//remove_action('admin_init', '_maybe_update_core');

add_action('admin_menu', 'remove_Administrator');
function remove_Administrator() {
	global $current_user;
	wp_get_current_user();
	//管理者
	if( current_user_can('administrator') &&
		$current_user->user_login == "ant-mngmnt01" ||
		$current_user->user_login == "all-cms" ||
		$current_user->user_login == "ant-creative01" ||
		$current_user->user_login == "ant-creative02" ||
		$current_user->user_login == "ant-creative03" ||
		$current_user->user_login == "cashing-ohji" ||
		$current_user->user_login == "ant-morita_edit" ||
		$current_user->user_login == "okyan" ){
			remove_menu_page('link-manager.php');
			remove_menu_page('edit-comments.php');
			//remove_menu_page('edit.php');
	}

	//編集者
	if( current_user_can('editor') &&
		$current_user->user_login == "ant-marketer01" ||
		$current_user->user_login == "ant-marketer02" ||
		$current_user->user_login == "ant-marketer03" ||
		$current_user->user_login == "ant-marketer04" ||
		$current_user->user_login == "ant-marketer_tokyo" ){
			remove_menu_page('link-manager.php');
			remove_menu_page('edit-comments.php');
			remove_menu_page('admin.php?page=wsal-auditlog');
			remove_menu_page('themes.php');
			remove_menu_page('plugins.php');
			remove_menu_page('users.php');
			remove_menu_page('tools.php');
			remove_menu_page('options-general.php');
			remove_menu_page('admin.php?page=ai1wm_export');
			remove_menu_page('profile.php');			
	}
}

/******************************************************************** 
* 元々のテーマ内記載物
*********************************************************************/




	/*
	add_action('init', 'cptype');
	function cptype() {
		////////////////////////////////////////////////////////////////////////
		// サイト情報設定
		////////////////////////////////////////////////////////////////////////
		register_post_type('siteinfo', array(
			'label' => 'siteinfo',
			'description' => 'サイト設定で設定したコンテンツは、最新の投稿を反映しています。現状作成されたページを更新するか、新規投稿から設定して下さい。',
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'capability_type' => 'post',
			'map_meta_cap' => true,
			'hierarchical' => false,
			'rewrite' => array('slug' => 'siteinfo', 'with_front' => true),
			'query_var' => true,
			'has_archive' => true,
			'supports' => array('title'),
			'menu_position' => '2',
			'labels' => array (
				'name' => 'サイト設定',
				'singular_name' => '',
				'menu_name' => 'サイト設定',
				'add_new' => '新規追加',
				'add_new_item' => '新規追加',
				'edit' => '編集',
				'edit_item' => 'サイト設定の編集',
				'new_item' => 'サイト設定を追加',
				'view' => '表示',
				'view_item' => 'サイト設定を表示',
				'search_items' => 'サイト設定を検索',
				'not_found' => 'サイト設定が見つかりません',
				'not_found_in_trash' => 'ゴミ箱には見当たりません',
				'parent' => 'Parent siteinfo',
		)) );
	
	}
	*/



/*********************************************************************************
*
* タクソノミー
*
**********************************************************************************/
/*
	add_action('init', 'Taxonomy');
	function Taxonomy() {
	
		////////////////////////////////////////////////////////////////////////
		// サイト情報【カテゴリー】
		////////////////////////////////////////////////////////////////////////
		register_taxonomy( 'tax_topinfo',array ( 0 => 'topinfo', ),
		array(
			'hierarchical' => true,
			'label' => 'サイト設定-項目設定',
			'show_ui' => true,
			'query_var' => true,
			'labels' => array (
				'search_items' => '',
				'popular_items' => '',
				'all_items' => '',
				'parent_item' => '',
				'parent_item_colon' => '',
				'edit_item' => '',
				'update_item' => '',
				'add_new_item' => '',
				'new_item_name' => '',
				'separate_items_with_commas' => '',
				'add_or_remove_items' => '',
				'choose_from_most_used' => '',
			)
		));
	
	}
	flush_rewrite_rules( false );
*/
?>