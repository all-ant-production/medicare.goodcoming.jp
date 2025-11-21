<?php
session_start();

// セッション初期化（初回のみ）
if (!isset($_SESSION['initialized'])) {
    $_SESSION = array_merge($_SESSION, [
        "PPC_keyVal" => "",
        "gclid_param" => "",
        "yclid_param" => "",
        "msclkid_param" => "",
        "wbraid_param" => "",
        "gbraid_param" => "",
        "link_param" => "",
        "initialized" => true
    ]);
}

// 更新対象のパラメーター
$parameters = ['gclid', 'yclid', 'msclkid', 'wbraid', 'gbraid'];

// GET パラメーターの存在とセッション値の一致確認
foreach ($parameters as $param) {
    if (isset($_GET[$param]) && $_GET[$param] !== ($_SESSION["{$param}_param"] ?? "")) {
        foreach ($parameters as $reset_param) {
            $_SESSION["{$reset_param}_param"] = ""; // リセット
        }
        break;
    }
}

// GET パラメーターのセッション更新
$_SESSION["PPC_keyVal"] = $_GET['PPC_key'] ?? $_SESSION["PPC_keyVal"];
foreach ($parameters as $param) {
    if (isset($_GET[$param])) {
        $_SESSION["{$param}_param"] = $_GET[$param];
    }
}

// URL パラメーターの結合
$link_parts = array_filter(array_map(function ($param) {
    return !empty($_SESSION["{$param}_param"]) ? ".{$param}_" . $_SESSION["{$param}_param"] : null;
}, $parameters));

$_SESSION["link_param"] = $_SESSION["PPC_keyVal"] . implode('', $link_parts);
?>

<?php $url = $_SERVER['REQUEST_URI']; ?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex">
<meta name="description" content="SBI生命の資料請求・web通販サイト">
<meta name="referrer" content="no-referrer-when-downgrade"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Zen+Maru+Gothic:wght@400;500;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/ress@4.0.0/dist/ress.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link href="<?php echo get_template_directory_uri(); ?>/css/design.css" rel="stylesheet">

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-579BQNQJ');</script>
<!-- End Google Tag Manager -->

<link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico">
<?php wp_head(); ?>
</head>

<body>

  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-579BQNQJ"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <header id="header_area">
    <?php if ( wp_is_mobile() ) : ?>
      <div class="wrapper">
        <div class="area-flex">
          <h1 class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="メディケア生命"></a></h1>
          <div class="right-area">
            <div class="box-line-sp">
              <a href="https://lin.ee/XSALxvk" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icon/icon-line.png" alt="LINE">
                <p>LINEで相談</p>
              </a>
            </div>
            <div class="box-tel-sp">
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>tel-contact/">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <p>お問合せ</p>
              </a>
            </div>
          </div>
        </div>
        <p class="company-name">［募集代理店］アントプロダクション株式会社</p>
      </div>
    <?php else: ?>
    <div class="wrapper">
      <h1 class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="メディケア生命"></a></h1>
      <div class="content-area">
        <div class="box-line">
          <div class="img-icon">
            <a href="https://lin.ee/XSALxvk" target="_blank">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icon/icon-line.png" alt="LINE">
            </a>
          </div>
          <div class="text-line">
            <a href="https://lin.ee/XSALxvk" target="_blank">
              <p>LINEで相談</p>
            </a>
          </div>
        </div>
        <div class="box-tel">
          <div class="img-icon">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>tel-contact/" target="_blank">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icon/icon-tel.png" alt="TEL">
            </a>
          </div>
          <div class="text-tel">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>tel-contact/">
              <p>お問合せ</p>
            </a>
          </div>
        </div>
        <div class="box-logo">
          <p class="company-name">［募集代理店］アントプロダクション株式会社</p>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-ant.png" alt="アントプロダクション">
        </div>
      </div>
    </div>
    <?php endif; ?>

    <nav>
      <ul>
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#medical">医療保険<i class="fas fa-caret-down"></i></a></li>
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#cancer">がん保険<i class="fas fa-caret-down"></i></a></li>
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#medical_for_chronic">持病がある型向け保険<i class="fas fa-caret-down"></i></a></li>
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#term">定期保険<i class="fas fa-caret-down"></i></a></li>
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#three-major">三大疾病保険<i class="fas fa-caret-down"></i></a></li>
      </ul>
    </nav>

  </header>
