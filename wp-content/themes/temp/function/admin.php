<?php

/*********************************************************************************
**********************************************************************************
* 2025.01.28
* auther:emrt
*　［説明］fuctions.phpの分割
**********************************************************************************
**********************************************************************************/


/*********************************************************************************************************************************************************
*　管理画面[ダッシュボード]
**********************************************************************************************************************************************************/

/* 非表示項目*********************************************************/

function remove_dashboard_widgets() {
	global $wp_meta_boxes;
	//unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] ); //概要
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity'] ); //アクティビティ
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);   // 最近のコメント
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);   // 被リンク
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);   // プラグイン
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);   // クイック投稿
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);   // 最近の下書き
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);   // WordPressブログ
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);   // WordPressフォーラム
}
add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets' );


/* 管理画面に独自のJSとCSSを入れる（全てのユーザー）************************/

// フックする関数
function custom_enqueue($hook_suffix) {
	// 読み込むスクリプトファイル(※依存関係:jquery)
	wp_enqueue_script('custom_js', get_template_directory_uri() . '/dst/js/admin/admin.js', array('jquery'));
	// 読み込むCSSファイル
	wp_enqueue_style('custom_css', get_template_directory_uri() . '/dst/css/admin/admin.css');
}
// "custom_enqueue" 関数を管理画面のキューアクションにフック
add_action( 'admin_enqueue_scripts', 'custom_enqueue' );

function mytheme_kill_admin_bar(){
	return false;
}
// show_admin_barにフィルターする。最後に処理してもらいたいので、1,000番目に登録。
add_filter( 'show_admin_bar', 'mytheme_kill_admin_bar' , 1000 );

	
/**
* 管理バー表示スペースの確保のためのコールバックを削除（カスタマイズするため）
* @return boolean
*/
add_theme_support( 'admin-bar', array( 'callback' => '__return_false' ) );


/* 管理バーの項目を非表示***********************************************/

function remove_admin_bar_menu( $wp_admin_bar ) {
	$wp_admin_bar->remove_menu( 'wp-logo' ); // WordPressシンボルマーク
	$wp_admin_bar->remove_menu('my-account'); // マイアカウント
	$wp_admin_bar->remove_menu('new-content'); // 新規
    $wp_admin_bar->remove_menu('new-post'); // 新規 -> 投稿
	$wp_admin_bar->remove_menu('new-content'); // 新規
    $wp_admin_bar->remove_menu('new-post'); // 新規 -> 投稿
    $wp_admin_bar->remove_menu('new-media'); // 新規 -> メディア
    $wp_admin_bar->remove_menu('new-link'); // 新規 -> リンク
    $wp_admin_bar->remove_menu('new-page'); // 新規 -> 固定ページ
    $wp_admin_bar->remove_menu('new-user'); // 新規 -> ユーザー
    $wp_admin_bar->remove_menu('comments'); // コメント
}
add_action( 'admin_bar_menu', 'remove_admin_bar_menu', 70 );


/* 管理バーにログアウトを追加********************************************/

function add_new_item_in_admin_bar() {
	global $wp_admin_bar;
	$wp_admin_bar->add_menu(array(
		'id' => 'new_item_in_admin_bar',
		'title' => __('ログアウト'),
		'href' => wp_logout_url()
	));
}
add_action('wp_before_admin_bar_render', 'add_new_item_in_admin_bar');
remove_action( 'welcome_panel', 'wp_welcome_panel' );



/********************************************************************
 *　管理画面のフッターの変更
********************************************************************/

function custom_admin_footer() {
	$template_dir 	= get_template_directory_uri();
	// プロトコル
	$protocol = empty($_SERVER["HTTPS"]) ? 'http://' : 'https://';
	// ホスト
	$host = $_SERVER['HTTP_HOST'];
	// manualのURLを入力
	$manualURL = '';
	// プロジェクトシートのURL
	$pjURL = '';
	// アカウント一覧のURL
	$accountURL = '';

	echo '
		<div class="ggmanual">
			<strong>マニュアル</strong>
			<a href="'.$manualURL.'" target="_blank"><span>＞</span>使い方 PDF</a>
		</div>
		<div class="ggmanual">
			<strong>プロジェクトシート</strong>
			<a href="'.$manualURL.'" target="_blank"><span>＞</span>プロジェクトシート</a>
		</div>
		<div class="ggmanual">
			<strong>アカウント一覧（認証が必要）</strong>
			<a href="'.$accountURL.'" target="_blank"><span>＞</span>アカウント一覧</a>
		</div>
	';
}
add_filter('admin_footer_text', 'custom_admin_footer');


/* メニューの非表示****************************************************/

function wp_category_terms_checklist_no_top( $args, $post_id = null ) {
	$args['checked_ontop'] = false;
	return $args;
}
add_action( 'wp_terms_checklist_args', 'wp_category_terms_checklist_no_top' );



/******************************************************************** 
* 元々のテーマ内記載物
*********************************************************************/

// generatorを非表示にする
remove_action('wp_head', 'wp_generator');

// タイトル表示
add_theme_support( 'title-tag' );

// アイキャッチを有効にする
add_theme_support( 'post-thumbnails' );

// アイキャッチ画像のsrcsetを削除
add_filter('wp_calculate_image_srcset_meta', '__return_null');

//自動更新を無効にする（自動更新を無効にすんな糞が）
//add_filter( 'automatic_updater_disabled', '__return_true' );

//抜粋する文字数を50文字に設定
add_filter('excerpt_length', function( $length ) {
  return 50; // 抜粋文の文字数
}, 100);
add_filter('excerpt_more', function( $more ) {
  return "…";
});

//アイキャッチ画像の定義と切り抜き
add_action( 'after_setup_theme', 'baw_theme_setup' );
function baw_theme_setup() {
  add_image_size('page_eyecatch-image-lg', 800, 344, true );
  add_image_size('page_eyecatch-image-sq', 250, 250, true );
  add_image_size('page_eyecatch-sumne', 231, 100, true );
  add_image_size('page_eyecatch-960x250', 960, 250, true );
  add_image_size('page_eyecatch-600x200', 600, 200, true );
}

/*********************************************************************************
*
*　投稿画面
*
**********************************************************************************/


/********************************************************************
 *　メディアアップロード設定
********************************************************************/
/*
	function thumbnail_size_setup() {
		//サムネイルサイズ
		if(update_option('thumbnail_size_w', 120)) {
			//update_option('thumbnail_size_h', 86);
		}
		if(update_option('medium_size_w', 640)) {
			//update_option('medium_size_h', 457);
		}
		if(update_option('large_size_w', 960)) {
			//update_option('large_size_h', 686);
		}
	}
	add_action('after_setup_theme', 'thumbnail_size_setup');
*/

/****各追加生成用の設定
************************************/
/*
	if ( function_exists( 'add_image_size' ) ) { 
		add_image_size('single_image', 1200, 600);
		add_image_size('mainVImg', 1980, 9999);
		add_image_size('profileImg', 1000, 9999);
		add_image_size('archiveImg', 212, 9999);
		add_image_size('ogp_image', 600, 9999);
		add_image_size('discImg', 500, 9999);
		add_image_size('photothumbImg', 210, 140);
		add_image_size('cntssize', 800, 9999);
		add_image_size('logo1size', 228, 9999);
		add_image_size('archiveImg2', 260, 9999);
	}
*/

/****生成される画像のクオリティ
************************************/
	//add_filter('jpeg_quality', function($arg){return 69;});

/****画像を相対パスに変更して記述料を削減
************************************/
/*
	function delete_domain_from_attachment_url( $url ) { 
		if ( preg_match( '/^http(s)?:\/\/[^\/\s]+(.*)$/', $url, $match ) ) {
			$url = $match[2];
		}
		return $url;
	}
	add_filter( 'wp_get_attachment_url', 'delete_domain_from_attachment_url' );
*/

/*
	function delete_host_from_attachment_url($url) {
	$regex = '/^http(s)?:\/\/[^\/\s]+(.*)$/';
	if (preg_match($regex, $url, $m)) {
		$url = $m[2];
	}
	return $url;
	}
	add_filter('wp_get_attachment_url', 'delete_host_from_attachment_url');
	add_filter('attachment_link', 'delete_host_from_attachment_url');
*/


/**** 画像アップロード時にWebPに変換する機能を追加
************************************/

/*
	function convert_image_to_webp($metadata, $attachment_id) {
		// ファイルパスを取得
		$upload_dir = wp_upload_dir();
		$file_path = $upload_dir['basedir'] . '/' . $metadata['file'];

		// 変換対象の画像をチェック（JPEGとPNGのみ）
		$allowed_types = ['image/jpeg', 'image/png'];
		$mime_type = mime_content_type($file_path);

		if (!in_array($mime_type, $allowed_types)) {
			return $metadata;
		}

		// 変換後のWebPファイルパスを設定
		$webp_path = preg_replace('/\.(jpe?g|png)$/i', '.webp', $file_path);

		// GDライブラリまたはImagickで画像を読み込み
		if (extension_loaded('gd') && function_exists('imagewebp')) {
			$image = ($mime_type === 'image/jpeg') ? imagecreatefromjpeg($file_path) : imagecreatefrompng($file_path);
			if ($image !== false) {
				imagewebp($image, $webp_path);
				imagedestroy($image);
			}
		} elseif (extension_loaded('imagick')) {
			try {
				$imagick = new Imagick($file_path);
				$imagick->setImageFormat('webp');
				$imagick->writeImage($webp_path);
				$imagick->clear();
				$imagick->destroy();
			} catch (Exception $e) {
				error_log('WebP変換中にエラーが発生しました: ' . $e->getMessage());
			}
		}

		return $metadata;
	}
	add_filter('wp_generate_attachment_metadata', 'convert_image_to_webp', 10, 2);
*/



/********************************************************************
 *
 * 投稿画面関連（不用なら削除で）
 *  
********************************************************************/

/********************************************************************
 *　[カテゴリ新規追加]と[よく使うもの]を削除
********************************************************************/
/*
	function hide_post_add() {
		global $pagenow;
		global $post_type;//投稿タイプで切り分けたいときに使う
		//使用するカスタム投稿に$post_typeの条件分岐に設定するポストタイプのスラッグを入力
		if (is_admin() && ($pagenow=='post-new.php' || $pagenow=='post.php') && $post_type=="topinfo"){
			echo '<style type="text/css">
			#screen-options-link-wrap,
			#tax_topinfo-adder,
			#tax_topinfo-tabs{display:none;}
			</style>';
		}

		if (is_admin() && ($pagenow=='post-new.php' || $pagenow=='post.php') && $post_type=="topinfo"){

			echo '<style type="text/css">
			.acf-input-wrap input,
			.acf_postbox .field textarea{min-height:31px;}
			ul.acf-radio-list.horizontal li,
			ul.acf-checkbox-list.horizontal li{margin-right: 10px;}
			.acf_postbox .field select{width: 10%;}

			</style>';
		}
	}
	add_action( 'admin_head', 'hide_post_add'  );
*/



/********************************************************************
 *　特定のカスタムポストタイプのタクソノミーをラジオボタンに変更
********************************************************************/
/*
function my_print_footer_scripts(){
	global $post_type;
	if ( is_admin() || $post_type == 'topinfo'){
		echo '<script type="text/javascript">
			jQuery(function($){

				var Wind 			= $(window);
				var categorychecklist = $("#tax_topinfochecklist.categorychecklist input[type=checkbox]");
				categorychecklist.each(function(){
					$(this).attr("type","radio");
				});
			});
		</script>';
	}

}
add_action('admin_print_footer_scripts', 'my_print_footer_scripts', 21);

*/


/********************************************************************
 *
 * 管理画面の投稿一覧画面関連（不用なら削除で）
 *  
********************************************************************/


/********************************************************************
 *　新着ニュースにカテゴリーを表示
********************************************************************/
/*
function add_post_taxonomy_restrict_filter() {
	global $post_type;
	if ( 'news' == $post_type ) {
		?>
		<select name="tax_news">
			<option value="">カテゴリー指定なし</option>
			<?php
			$terms = get_terms('tax_news');
			foreach ($terms as $term) { ?>
				<option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
			<?php } ?>
		</select>
		<select name="set_news">
			<option value="">カテゴリー指定なし</option>
			<?php
			$terms = get_terms('set_news');
			foreach ($terms as $term) { ?>
				<option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
			<?php } ?>
		</select>
		<?php
	}elseif ( 'post' == $post_type ) {
		?>
		<select name="category">
			<option value="">カテゴリー指定なし</option>
			<?php
			$terms = get_terms('category');
			foreach ($terms as $term) { ?>
				<option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
			<?php } ?>
		</select>
		<?php
	}elseif ( 'topinfo' == $post_type ) {
		?>
		<select name="tax_topinfo">
			<option value="">カテゴリー指定なし</option>
			<?php
			$terms = get_terms('tax_topinfo');
			foreach ($terms as $term) { ?>
				<option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
			<?php } ?>
		</select>
		<?php
	}elseif ( 'case' == $post_type ) {
		?>
		<select name="tax_case">
			<option value="">カテゴリー指定なし</option>
			<?php
			$terms = get_terms('tax_case');
			foreach ($terms as $term) { ?>
				<option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
			<?php } ?>
		</select>
		<?php
	}
}
add_action( 'restrict_manage_posts', 'add_post_taxonomy_restrict_filter' );
*/


// カスタムフィールドの内容を表示
/*
function add_column($column_name, $post_id) {
    if( $column_name == 'schedule_data' ) {
        $stitle = get_post_meta($post_id, 'schedule_data', true);
		$syear  = mb_substr($stitle, 0, 4);
		$smonth = mb_substr($stitle, 4, 2);
		$sday   = mb_substr($stitle, 5, 2);
		$sc_data= date('Y.m.d',strtotime($stitle));
    }
    if ( isset($stitle) && $stitle ) {
        echo attribute_escape($sc_data);
    } else {
        echo __('None');
    }
}
add_action( 'manage_posts_custom_column', 'add_column', 10, 2 );
*/

// カラムの順序を変更する
/*
function sort_column($columns){
	$columns = array(
		'title' => 'イベント名',	// タイトル→書籍名にカラム名変更
		'schedule_data' => 'ライブ日時',
		'expirationdate' => '非表示期限',
		'taxonomy-tax_schedule' => '書籍カテゴリー',
		'date' => '投稿/更新日時',
		'gadwp_stats' => 'アナリティクス',
		'wpfc_column_clear_cache' => 'キャッシュ'
	);
	return $columns;
}
add_filter( 'manage_schedule_columns', 'sort_column');
*/


/*********************************************************************************************************************************************************
* 追加：ユーザーを使用するtemplate themeの中に登録するユーザー情報が格納されたCSVがあると自動で登録する。
**********************************************************************************************************************************************************/
// ユーザー登録時のメール送信を無効化
add_filter('wp_new_user_notification_email', '__return_false');
add_filter('wp_new_user_notification_email_admin', '__return_false');

// 現在のテーマディレクトリからCSVファイルのパスを指定
$csv_file_path = get_template_directory() . '/user_import.csv';

// ファイルが存在するか確認
if (!file_exists($csv_file_path)) {
    die('CSVファイルが見つかりません: ' . $csv_file_path);
}

// CSVファイルを読み込む
$csv_content = file_get_contents($csv_file_path);

// 文字コードをUTF-8に変換（Shift-JIS対応）
$encoding = mb_detect_encoding($csv_content, ['UTF-8', 'SJIS', 'SJIS-win', 'EUC-JP', 'ISO-2022-JP']);
if ($encoding !== 'UTF-8') {
    $csv_content = mb_convert_encoding($csv_content, 'UTF-8', $encoding);
}

// 各行を配列に変換（改行で分割）
$lines = array_filter(array_map('trim', explode("\n", $csv_content)));

// CSVデータを解析
$csv_data = [];
foreach ($lines as $line) {
    $csv_data[] = str_getcsv($line);
}

// ヘッダー行を取り除く
$headers = array_shift($csv_data);

// ヘッダー行と各行のカラム数が一致しているか確認
foreach ($csv_data as $index => $row) {
    if (count($row) !== count($headers)) {
        echo "";
        continue;
    }

    // 行のデータを連想配列に変換
    $user_data = array_combine($headers, $row);

    // 必要なデータを取得
    $username = sanitize_user($user_data['username']);
    $email = sanitize_email($user_data['email']);
    $password = $user_data['password'];
    $role = isset($user_data['role']) ? $user_data['role'] : 'subscriber';

    // 必須フィールドの確認
    if (empty($username) || empty($email) || empty($password)) {
        echo "";
        continue;
    }

    // ユーザーがすでに存在するかチェック
    if (username_exists($username)) {
        echo "";
        continue;
    }

    if (email_exists($email)) {
        echo "";
        continue;
    }

    // ユーザーを作成
    $user_id = wp_create_user($username, $password, $email);

    if (is_wp_error($user_id)) {
        echo "";
        continue;
    }

    // ロールを設定
    $user = new WP_User($user_id);
    $user->set_role($role);

    echo "";
}

?>