//するするスクロール
$('a[href*="#"]').click(function () {
  var elmHash = $(this).attr('href');
  var pos = $(elmHash).offset().top;
  $('body,html').animate({scrollTop: pos}, 500);
  return false;
});

//ページトップボタン
function PageTopAnime() {
  var scroll = $(window).scrollTop();
  if (scroll >= 200){
    $('#page-top').removeClass('DownMove');
    $('#page-top').addClass('UpMove');
  }else{
    if($('#page-top').hasClass('UpMove')){
      $('#page-top').removeClass('UpMove');
      $('#page-top').addClass('DownMove');
    }
  }
  var wH = window.innerHeight;
  var footerPos =  $('#footer').offset().top;
  if(scroll+wH >= (footerPos+10)) {
    var pos = (scroll+wH) - footerPos+10
    $('#page-top').css('bottom',pos);
  }else{
    if($('#page-top').hasClass('UpMove')){
      $('#page-top').css('bottom','10px');
    }
  }
}
$(window).scroll(function () {
	PageTopAnime();
});
$('#page-top').click(function () {
  $('body,html').animate({
    scrollTop: 0
  }, 500);
  return false;
});

//動くマーカーのアニメーション
$(window).scroll(function (){
  $(".marker-animation").each(function(){
    var position = $(this).offset().top;
    var scroll = $(window).scrollTop();
    var windowHeight = $(window).height();
    if (scroll > position - windowHeight){
      $(this).addClass('active');
    }
    else{
      $(this).removeClass('active');
    }
  });
});

//タブ
jQuery(function($){
  $('.tab').click(function(){
    $('.is-active').removeClass('is-active');
    $(this).addClass('is-active');
    $('.is-show').removeClass('is-show');
    const index = $(this).index();
    $('.panel').eq(index).addClass('is-show');
  });
});

//アコーディオン
jQuery(function () {
  $(".accordion-title").on("click", function () {
    $(this).next().slideToggle(300);
    $(this).toggleClass("open", 300);
  });
});
