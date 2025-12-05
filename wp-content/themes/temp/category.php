<?php get_header(); ?>

<?php $url = $_SERVER['REQUEST_URI']; ?>
<?php
$cat_id = get_queried_object()->cat_ID;
$post_id = 'category_'.$cat_id;
$category = get_the_category();

if (!empty($category) && is_array($category)) {
    $cat_name = $category[0]->cat_name;
    $cat_slug = $category[0]->category_nicename;
}
?>

<main>
  <div id="category">
    <?php if (!empty($category) && is_array($category)): ?>
      <h2 class="category-title"><?php echo esc_html($cat_name); ?>の商品一覧</h2>
    <?php
    $posts = get_field('ランキング',$post_id);
    if( $posts ):
    ?>
    <?php $linkUrl = home_url()."/re".post_custom('リファラー_ID')."?".$_SESSION["link_param"];?>
    <div class="single-inner">
      <h3 class="title"><?php the_title(); ?></h3>
      <div class="item-inner">
        <div class="box-banner">
          <div class="banner">
            <a href="<?php echo $linkUrl;?>" target="_blank">
              <img src="<?php the_field('バナー'); ?>" />
            </a>
          </div>
        </div>
        <div class="box-text">
          <div class="box-point">
            <div class="ttl-point"><i class="fas fa-check"></i>おすすめポイント</div>
            <div class="text-point"><p><?php the_field('商品の特徴'); ?></p></div>
          </div>
          <?php if(get_field('リンク') == "on"): ?>
            <div class="btn-cv">
              <a href="<?php echo $linkUrl;?>" target="_blank">
                <i class="fas fa-chevron-circle-right"></i>保険会社サイトで見積・申込
              </a>
            </div>
          <?php elseif(get_field('リンク') == "off"): ?>
          <?php endif; ?>
          <p class="text-number">
            <?php the_field('募集文章登録番号'); ?>
          </p>
        </div><!--.box-text-->
      </div><!--.item-inner-->
    </div><!--.single-inner-->

    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
    <?php endif; ?>
  </div><!--#category-->
</main>

<?php get_footer(); ?>
