<?php
/*
Template Name: page-re
*/
; ?>

<?php
session_start();
$_SESSION["temp_pram"] = $_SERVER['QUERY_STRING'];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="referrer" content="no-referrer-when-downgrade"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Zen+Maru+Gothic:wght@400;500;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/ress@4.0.0/dist/ress.min.css">
<link href="<?php echo get_template_directory_uri(); ?>/css/design.css" rel="stylesheet">
<link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico">

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-579BQNQJ');</script>
<!-- End Google Tag Manager -->

<?php if(strstr($_SESSION["temp_pram"],'GAD')): ?>
  <meta http-equiv="Refresh" content="1.2;<?php echo get_field('リファラー_URL-GAD');?><?php echo $_SESSION["temp_pram"];?>"/>
<?php elseif(strstr($_SESSION["temp_pram"],'YSS')): ?>
  <meta http-equiv="Refresh" content="1.2;<?php echo get_field('リファラー_URL-YSS');?><?php echo $_SESSION["temp_pram"];?>"/>
<?php elseif(strstr($_SESSION["temp_pram"],'MSA')): ?>
  <meta http-equiv="Refresh" content="1.2;<?php echo get_field('リファラー_URL-MSA');?><?php echo $_SESSION["temp_pram"];?>"/>
<?php else: ?>
  <meta http-equiv="Refresh" content="1.2;<?php echo get_field('リファラー_URL-NUL');?><?php echo $_SESSION["temp_pram"];?>"/>
<?php endif; ?>

<?php wp_head(); ?>
</head>

<body>

  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-579BQNQJ"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <main>
    <div id="page-content">
      <div id="page-re">
        <div class="page-re-content">
          <h1><?php the_title(); ?></h1>
          <?php if(strstr($_SESSION["temp_pram"],'GAD')): ?>
            <a href="<?php echo get_field('リファラー_URL-GAD'); ?><?php echo $_SESSION["temp_pram"];?>" rel="nofollow">
          <?php elseif(strstr($_SESSION["temp_pram"],'YSS')): ?>
            <a href="<?php echo get_field('リファラー_URL-YSS'); ?><?php echo $_SESSION["temp_pram"];?>" rel="nofollow">
          <?php elseif(strstr($_SESSION["temp_pram"],'MSA')): ?>
            <a href="<?php echo get_field('リファラー_URL-MSA'); ?><?php echo $_SESSION["temp_pram"];?>" rel="nofollow">
          <?php else: ?>
            <a href="<?php echo get_field('リファラー_URL-NUL'); ?><?php echo $_SESSION["temp_pram"];?>" rel="nofollow">
          <?php endif; ?>
            <span>ページが移動しない場合は、こちらをクリックして移動してください。</span>
          </a>
          <img src="<?php echo get_template_directory_uri(); ?>/img/loading.gif" class="loading">
        </div>
      </div>
    </div>
  </main>

</body>
</html>
