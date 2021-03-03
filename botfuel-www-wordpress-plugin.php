<?php
/*
Plugin Name: botfuel-www-wordpress-plugin
Plugin URI: https://botfuel.io/
Description: Botfuel main website /htdocs/wp-content/plugins/botfuel-www-wordpress-plugin
Version: 1.0.0
Author: botfuel
*/


add_action( 'enqueue_block_editor_assets', function() {
  wp_enqueue_style( 'my-block-editor-styles', '/wp-content/plugins/botfuel-www-wordpress-plugin/block-editor.css', false, '1.0', 'all' );
} );

function botfuel_is_in_posts_list() {
  return !is_front_page() && (
    is_home() || is_category() || is_tag() || is_author() || is_search()
  );
}

add_action('wp_head', function() {
  if (botfuel_is_in_posts_list()) :
  ?>
    <link rel='stylesheet' href='/wp-content/plugins/botfuel-www-wordpress-plugin/bootstrap-grid.css' media='all' />
    <style>
      .site-content .content-area {
        padding-top: 3em;
        width: 100% !important;
      }

      .is-right-sidebar {
        display: none;
      }

      .botfuel-blog-row {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
      }

      .inside-article {
        box-shadow: 0 2px 3px rgb(10 10 10 / 10%), 0 0 0 1px rgb(10 10 10 / 10%);
        height: 100%;
      }

      .inside-article > :not(.post-image) {
        padding-left: 2em;
        padding-right: 2em;
      }

      .inside-article > .post-image > a > img {
        object-fit: cover;
        width: 100%;
        height: 180px;
      }

      .inside-article > :last-child {
        padding-bottom: 2em;
      }

      .inside-article .entry-content {
        display: none;
      }

      .page-header {
        margin-bottom: 80px !important;
        width: 100%;
      }

      .paging-navigation {
        text-align: center;
        width: 100%;
        margin: 2em;
      }
    </style>
  <?php
  endif;
});

add_filter('post_class', function ($classes, $class, $post_id) {
  if (botfuel_is_in_posts_list()) $classes[] = 'col-xs-12 col-md-4';
  return $classes;
}, 100, 3);

add_action('generate_before_main_content', function () {
  if (!botfuel_is_in_posts_list()) return;
  ?><div class="row botfuel-blog-row"><?php
}, 1);

add_action('generate_after_main_content', function () {
  if (!botfuel_is_in_posts_list()) return;
  ?></div><?php
}, 100);
