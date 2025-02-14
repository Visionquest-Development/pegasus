<?php

namespace benignware\wp\bootstrap_hooks;

function render_block_common($content, $block) {
  if (!current_theme_supports('bootstrap')
    || empty(trim($content))) {
    return $content;
  }

  // echo $block['blockName'];
  // echo '<br/>';

  return get_markup($content);
}

// add_filter('render_block', 'benignware\wp\bootstrap_hooks\render_block_common', 100, 2);