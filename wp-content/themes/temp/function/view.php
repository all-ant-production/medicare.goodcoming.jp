<?php

/*********************************************************************************
**********************************************************************************
* 2025.01.28
* auther:emrt
*　［説明］fuctions.phpの分割
**********************************************************************************
**********************************************************************************/
//---------------------------------------------------------------------------
// ショートコード
//---------------------------------------------------------------------------

//　imgのショートコード（投稿記事内の[cvimg]を変換）
function template_directory_img() {
	$cvimg = 'https://moneru.jp/wp-content/uploads/';
	return $cvimg;
}

// CVimg呼び出し時のショートコードの名前
add_shortcode('cvimg', 'template_directory_img');

//================================= 内部リンクのブログカード自作（ショートコード）

// 記事IDを指定して更新日を取得する
function ltl_get_the_modified_date($post_id){
  global $post;
  $post_bu = $post;
  $post = get_post($post_id);
  setup_postdata($post_id);
  $output = get_the_modified_date('Y/m/d');
  $post = $post_bu;
  return $output;
}

//内部リンクをはてなカード風にするショートコード
function blogcard_scode($atts) {
	extract(shortcode_atts(array(
		'url'=>"",
		'title'=>"",
	),$atts));

	$id = url_to_postid($url);//URLから投稿IDを取得
	$img_width ="150";//画像サイズの幅指定
	$img_height = "100";//画像サイズの高さ指定
	$no_image = 'noimageに指定したい画像があればここにパス';//アイキャッチ画像がない場合の画像を指定

	//タイトルを取得
	if(empty($title)){
		$title = esc_html(get_the_title($id));
	}

	if(empty($date)){
		$date = esc_html(ltl_get_the_modified_date($id));
	}

  //アイキャッチ画像を取得
  if(has_post_thumbnail($id)) {
    $img = wp_get_attachment_image_src(get_post_thumbnail_id($id),array($img_width,$img_height));
    $img_tag = "<img src='" . $img[0] . "' alt='{$title}' width=" . $img[1] . " height=" . $img[2] . " />";
  }else{
		$img_tag ='<img src="'.$no_image.'" alt="" width="'.$img_width.'" height="'.$img_height.'" />';
  }

	$blogcard ='
<div class="blog-card">
	<div class="blog-card-kanren">合わせて読みたい</div>
  <a href="'. $url .'">
      <div class="blog-card-thumbnail">'. $img_tag .'</div>
      <div class="blog-card-content">
      <div class="blog-card-day">'. $date .'</div>
      <div class="blog-card-title">'. $title .'</div>
      <div class="more"><span>>続きを読む</span></div>
      </div>
  </a>
</div>';
	return $blogcard;
}

add_shortcode("blogcard", "blogcard_scode");

//---------------------------------------------------------------------------
// スマホ対応
//---------------------------------------------------------------------------

function is_mobile(){
  $useragents = array(
    'iPhone',          // iPhone
    'iPod',            // iPod touch
    'Android.*Mobile', // 1.5+ Android Only mobile
    'Windows.*Phone',  // Windows Phone
    'dream',           // Pre 1.5 Android
    'CUPCAKE',         // 1.5+ Android
    'blackberry9500',  // Storm
    'blackberry9530',  // Storm
    'blackberry9520',  // Storm v2
    'blackberry9550',  // Storm v2
    'blackberry9800',  // Torch
    'webOS',           // Palm Pre Experimental
    'incognito',       // Other iPhone browser
    'webmate'          // Other iPhone browser
  );
  $pattern = '/'.implode('|', $useragents).'/i';
  return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}
function is_ipad() {
  $is_ipad = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPad');
  if ($is_ipad) {
    return true;
  } else {
    return false;
  }
}
?>