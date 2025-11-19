<?php

/*********************************************************************************
**********************************************************************************
* 2025.01.28
* auther:emrt
*　［説明］fuctions.phpの分割
**********************************************************************************
**********************************************************************************/

/******************************************************************** 
* 元々のテーマ内記載物
*********************************************************************/
// カスタム投稿タイプのパーマリンクを数字ベース(投稿ID)に変更
function articles_post_type_link( $link, $post ){
    if ( $post->post_type === 'media' ) {
      return home_url( '/media/' . $post->ID );
    } else {
      return $link;
    }
  }
  add_filter( 'post_type_link', 'articles_post_type_link', 1, 2 );
  
  function articles_rewrite_rules_array( $rules ) {
    $new_rewrite_rules = array(
      'media/([0-9]+)/?$' => 'index.php?post_type=media&p=$matches[1]',
    );
    return $new_rewrite_rules + $rules;
  }
  add_filter( 'rewrite_rules_array', 'articles_rewrite_rules_array' );
  
  //ショートコードを使ったphpファイルの呼び出し方法
  function my_php_Include($params = array()) {
   extract(shortcode_atts(array('file' => 'default'), $params));
   ob_start();
   include(STYLESHEETPATH . "/$file.php");
   return ob_get_clean();
  }
  add_shortcode('myphp', 'my_php_Include');
  
  //目次の前に追加
  function insert_html_before_first_h2($content) {
    $request_uri = $_SERVER['REQUEST_URI'];
    $html_to_insert = '[myphp file="singleauthor"][toc]';
    $first_h2_pos = strpos($content, '<h2');
    if ($first_h2_pos !== false) {
      $content = substr_replace($content, $html_to_insert, $first_h2_pos, 0);
    }
    return $content;
  }
  add_filter('the_content', 'insert_html_before_first_h2');
  
  //welcartが吐き出すOGPプロパティーを削除
  remove_action( 'wp_head', 'usces_action_ogp_meta');
  
  add_filter( 'usces_filter_cart_row',  'my_filter_cart_row', 10, 3 );
  function my_filter_cart_row( $row, $cart, $materials ) {
      //処理
      return $row;
  }

?>