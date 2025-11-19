<?php get_header(); ?>

<?php $url = $_SERVER['REQUEST_URI']; ?>

  <?php get_template_part('parts/single/loop','single');?>

<?php get_footer(); ?>
