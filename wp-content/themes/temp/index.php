<?php get_header(); ?>

<?php
$category = get_the_category();
$cat_name = $category[0]->cat_name;
$cat_slug = $category[0]->category_nicename;
$cat_id = $category[0]->cat_ID;
$post_id = 'category_'.$cat_id;
$slug = $post->post_name;
?>

  <div class="cover-eml">
    <div class="contents">
      <p class="sub-txt">該当する方を選択してください</p>
      <ul class="tab pop-up-tab">
          <li>
            <a href="#header_area" class="pop-up-a linkbtn1"><i class="fas fa-chevron-circle-right"></i>初めてのお申し込みはこちら</a>
          </li>
          <li>
            <a href="<?php echo home_url(); ?>/tel-contact/" class="pop-up-a linkbtn2" target="_blank">
              <i class="fas fa-chevron-circle-right"></i>すでに申し込み済みの方はこちら
            </a>
        </li>
      </ul>
    </div>
  </div>

<div class="wrapper">
  <div class="container">

  <h1 class="mainvisual">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>#item-list">
      <?php if ( wp_is_mobile() ) : ?>
        <img src="<?php echo get_template_directory_uri(); ?>/img/mainvisual/mainvisual-sp.jpg" alt="メディケア生命">
      <?php else: ?>
        <img src="<?php echo get_template_directory_uri(); ?>/img/mainvisual/mainvisual-pc.jpg" alt="メディケア生命">
      <?php endif; ?>
    </a>
  </h1>

  <main>

    <div id="item-list">
      <?php
      // 各カテゴリーごとに投稿を取得
      $categories = array(
          'medical' => '医療保険',
          'cancer' => 'がん保険',
          'medical_for_chronic' => '持病がある方向け医療保険',
          'term' => '定期保険',
          'three-major' => '三大疾病保険',
      );

      foreach ($categories as $slug => $category_name) {
          // カテゴリーごとの投稿を取得
          $args = array(
              'post_type' => 'post',
              'posts_per_page' => -1, // すべての投稿を表示する場合は-1を指定
              'category_name' => $slug, // カテゴリースラッグを指定
              'post_status' => 'publish' // 公開された投稿のみ取得
          );
          $query = new WP_Query($args);

        // カテゴリーごとの投稿を表示
        if ($query->have_posts()) :
            ?>
          <h2 class="category-title" id="<?php echo $slug; ?>"><?php echo $category_name; ?></h2>
          <div class="item-wrap">
              <?php while ($query->have_posts()) :
                  $query->the_post();
                  $linkUrl = home_url()."/re".post_custom('リファラー_ID')."?".$_SESSION["link_param"]."&".date_i18n("Hi");
              ?>
                  <div class="item">
                    <h3><?php the_title(); ?></h3>
                    <a href="<?php echo $linkUrl;?>" target="_blank">
                      <div class="logo"><img src="<?php the_field('バナー'); ?>" /></div>
                      <div class="catch-text"><p><?php the_field('商品の特徴'); ?></p></div>
                    </a>
                    <div class="btn-cv">
                      <a href="<?php echo $linkUrl;?>" target="_blank"><span>今すぐ簡単見積り！</span><i class="fas fa-chevron-circle-right"></i>保険シュミレーションはこちら</a>
                    </div>
                  </div>
              <?php endwhile; ?>
          </div>
        <?php wp_reset_postdata(); endif;
        }
        ?>
    </div><!-- #item-list-->

    <div class="text-info">
      <p>
        このページでは､保険商品の商品の概要をご案内しています｡保険商品の詳細につきましては、<br>
        「商品パンフレット」「契約概要」「注意喚起情報」「ご契約のしおり」「約款」などをご覧ください。
      </p>
    </div>

    <div class="contact-area">
      <div class="mail-btn">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>contact/">
          <i class="fas fa-envelope" aria-hidden="true"></i>お問い合わせ・資料請求はこちら
        </a>
      </div>
      <div class="line-btn">
        <a href="https://lin.ee/XSALxvk" target="_blank">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icon/icon-line.png" alt="LINE">
          <strong>LINEで無料相談</strong>
          <div class="text-02">24時間受付</div>
        </a>
      </div>
    </div>

    </main>

<?php get_footer(); ?>

<script>
$(document).ready(function () {
  $('body').css({
    'overflow': 'hidden',
    'position': 'fixed',
    'width': '100%',
    'height': '100%'
  });
  $('.pop-up-a').on('click', function () {
    $('.cover-eml').hide();
    $('body').css({
      'overflow': 'auto',
      'position': 'static'
    });
  });
});
</script>
