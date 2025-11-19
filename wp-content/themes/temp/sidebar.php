<aside id="sidebar">

<?php
if (class_exists('WPP_Query')) {
  global $post;
  $args = array(
    'range' => 'weekly',
    'order_by' => 'views',
    'post_type' => 'media',
    'limit' => 5,
  );
  $wpp_query = new \WordPressPopularPosts\Query($args);
  $wpp_posts = $wpp_query->get_posts();
  if ($wpp_posts) { ?>

    <h3><span>人気のコラム</span></h3>
    <ol class="block-side-column">
      <?php
      foreach ($wpp_posts as $wpp_post) {
        $post = get_post($wpp_post->id);
        setup_postdata($post);
        $cat = get_the_category();$cat = $cat[0];
      ?>
      <li>
        <div class="thumb"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'page_eyecatch-sumne') ;?></a></div>
        <div class="title">
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          <time><?php the_time('Y.m.d'); ?></time>
        </div>
      </li>
      <?php } ?>
    </ol>
    <?php wp_reset_postdata();}}?>

<h3><span>新着コラム一覧</span></h3>
<ul class="block-side-column">
<?php
$args = array(
  'post_type' => 'media',
  'posts_per_page' => 5,
);
$posts = get_posts( $args );
foreach ( $posts as $post ):
  setup_postdata( $post );
  ?>
  <li>
    <div class="thumb"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'page_eyecatch-sumne') ;?></a></div>
    <div class="title">
      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
      <time><?php the_time('Y.m.d'); ?></time>
    </div>
  </li>
<?php endforeach;wp_reset_postdata();?>
</ul>

</aside>
