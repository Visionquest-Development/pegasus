<?php

use function benignware\wp\bootstrap_hooks\rgb;
use function benignware\wp\bootstrap_hooks\rgb2hex;
use function benignware\wp\bootstrap_hooks\brightness;
use function benignware\wp\bootstrap_hooks\query_object;
use function benignware\wp\bootstrap_hooks\find_by_class;

function _bootstrap_is_block_editor() {
	global $current_screen;

	if (!function_exists('get_current_screen')) {
		return false;
	}

	$current_screen = get_current_screen();

	if ( $current_screen && method_exists($current_screen, 'is_block_editor') && $current_screen->is_block_editor() ) {
			return true;
	}

	return false;
}


 /**
* Add color styling from settings
* Inserted with an enqueued CSS file
*/

function _bootstrap_get_theme_json() {
	$merged_data = \WP_Theme_JSON_Resolver::get_merged_data();

	if (!method_exists($merged_data, 'get_data')) {
		return [];
	}

	$theme_json = $merged_data->get_data();
	$default_theme_json = json_decode(file_get_contents(ABSPATH . WPINC . '/theme.json'), true);

	$theme_json = array_merge(
		$default_theme_json,
		$theme_json,
		[
			'settings' => array_merge(
				$default_theme_json['settings'],
				query_object($theme_json, 'settings') ?: [],
				[
					'color' => array_merge(
						$default_theme_json['settings']['color'],
						query_object($theme_json, 'settings.color') ?: [],
						[
							'palette' => query_object($default_theme_json, 'settings.color.defaultPalette')
								? array_merge(
									query_object($default_theme_json, 'settings.color.palette') ?: [],
									query_object($theme_json, 'settings.color.palette') ?: []
								)
								: query_object($theme_json, 'settings.color.palette')
						]
					),
					'typography' => array_merge(
						query_object($default_theme_json, 'settings.typography') ?: [],
						query_object($theme_json, 'settings.typography') ?: [],
						[
							'fontSizes' => !empty(query_object($theme_json, 'settings.typography.fontSizes'))
								? query_object($theme_json, 'settings.typography.fontSizes')
								: query_object($default_theme_json, 'settings.typography.fontSizes')
						]
					)
				]
			)
		]
	);

	return $theme_json;
}

function _bootstrap_get_preset_resolver($theme_json) {
	$resolve_preset = function($value) use ($theme_json) {
		if (preg_match('/var\(\s*--wp--preset--([\w+-]+)--([\w+-]+)\s*\)/', $value, $matches)) {
			$type = $matches[1];
			$slug = $matches[2];

			if ($type === 'font-family') {
				$font_families = query_object($theme_json, 'settings.typography.fontFamilies');

				if ($font_families) {
					$font_family = current(array_values(array_filter($font_families, function($obj) use ($slug) {
						return $obj['slug'] === $slug;
					})));

					if ($font_family) {
						return $font_family['fontFamily'];
					}
				}
			}

			if ($type === 'font-size') {
				$font_sizes = query_object($theme_json, 'settings.typography.fontSizes');

				if ($font_sizes) {
					$font_size = current(array_values(array_filter($font_sizes, function($obj) use ($slug) {
						return $obj['slug'] === $slug;
					})));

					if ($font_size) {
						return $font_size['size'];
					}
				}
			}

			if ($type === 'color') {
				$palette = query_object($theme_json, 'settings.color.palette');

				if ($palette) {
					$color = current(array_values(array_filter($palette, function($obj) use ($slug) {
						return $obj['slug'] === $slug;
					})));

					if ($color) {
						return $color['color'];
					}
				}
			}
		}

		return $value;
	};

	return $resolve_preset;
};


function _bootstrap_presets_css_action() {
	$is_editor = isset($_GET['is_editor']) ? stripslashes($_GET['is_editor']) == 1 : false;
	$body_selector = $is_editor ? '.editor-styles-wrapper' : 'body';

	$theme_json = _bootstrap_get_theme_json();
	$resolve_preset = _bootstrap_get_preset_resolver($theme_json);

  $background_color = query_object($theme_json, 'styles.color.background') ?: (
    get_background_color()
      ? '#' . get_background_color()
      : ''
  );

	$palette = query_object($theme_json, 'settings.color.palette');

	$palette_vars = array_reduce($palette, function($acc, $color) {
		[$r, $g, $b] = rgb($color['color']);
		$hex = rgb2hex([$r, $g, $b]);
		$rgb = implode(', ', [$r, $g, $b]);


		$acc["--bs-{$color['slug']}"] = $hex;
		$acc["--bs-{$color['slug']}-rgb"] = $rgb;
		$acc["--bs-{$color['slug']}-r"] = $r;
		$acc["--bs-{$color['slug']}-g"] = $g;
		$acc["--bs-{$color['slug']}-b"] = $b;
		return $acc;
	}, []);

	$blocks = query_object($theme_json, 'styles.blocks');

	// $block_css = array_reduce(array_keys($blocks), function($acc, $key) use ($blocks) {
	// 	$block = $blocks[$key];

	// 	if ($key === 'core/navigation') {
	// 		$selector = '.navbar';

	// 		$x = query_object($block, 'spacing.padding.left');
	// 		$y = query_object($block, 'spacing.padding.top');

	// 		$acc["$selector"] = [
	// 			'--bs-navbar-padding-x' => $x,
	// 			'--bs-navbar-padding-y' => $y
	// 		];

	// 		$lx = query_object($block, 'elements.link.spacing.padding.left');
	// 		$ly = query_object($block, 'elements.link.spacing.padding.top');

	// 		$acc[".navbar-nav .nav-link"] = [
	// 			'--bs-navbar-nav-link-padding-x' => $lx,
	// 			'--bs-navbar-nav-link-padding-y' => $ly,
	// 		];
	// 	}

	// 	return $acc;
	// }, []);
	$block_css = [];

	$shadow_presets = query_object($theme_json, 'settings.shadow.presets');

	$shadow_vars = [];

	if ($shadow_presets) {
		$shadow_vars = array_reduce($shadow_presets, function($acc, $preset) {
			$slug = $preset['slug'];
			// $acc["--bs-shadow-{$slug}"] = $preset['shadow'];
			$acc["--bs-shadow-{$slug}"] = "var(--wp--preset--shadow--{$slug}, {$preset['shadow']})";
			return $acc;
		}, []);
	}

	$link_color = query_object($theme_json, 'styles.elements.link.color.text');

	$button_border_radius = query_object($theme_json, 'styles.elements.button.border.radius');

	if (!$button_border_radius) {
		$button_border_radius = query_object($theme_json, 'styles.blocks.core/button.border.radius');
	}

	$css = array_merge([
		$body_selector => array_merge([
			'--bs-body-bg' => $background_color,
      '--bs-body-bg-rgb' => implode(', ', rgb($background_color) ?: []),
			'--bs-body-color' => query_object($theme_json, 'styles.color.text'),
			'--bs-body-font-family' => query_object($theme_json, 'styles.typography.fontFamily'),
			'--bs-body-font-size' => query_object($theme_json, 'styles.typography.fontSize'),
			'--bs-body-font-weight' => query_object($theme_json, 'styles.typography.fontWeight'),
			'--bs-gutter-x' => query_object($theme_json, 'styles.spacing.gutter.x'),
			'--bs-gutter-y' => query_object($theme_json, 'styles.spacing.gutter.y'),
			'--bs-link-color' => $link_color,
		], $palette_vars, $shadow_vars),
		// "$body_selector a" => [
		// 	'--bs-link-color-rgb' => implode(', ', rgb($resolve_preset(query_object($theme_json, 'styles.elements.link.color.text'))) ?: []),
		// 	'--bs-link-hover-color-rgb' => implode(', ', rgb($resolve_preset(query_object($theme_json, 'styles.elements.link.:hover.color.text'))) ?: [])
		// ],
		".container" => [
			'max-width' => 'var(--wp--style--global--wide-size, 1200px)',
		],
		".container-fluid.alignfull" => [
			'margin-left' => 'auto',
			'margin-right' => 'auto',
			'padding-left' => 'var(--wp--style--root--padding-left)',
			'padding-right' => 'var(--wp--style--root--padding-right)'
		],
		"figure.alignfull,figure.alignwide" => [
			'display' => 'block',
			'max-width' => 'none'
		],
		".wp-site-blocks" => [
			// 'min-height' => '100vh',
			'display' => 'flex',
			'flex-direction' => 'column',
			'flex-grow' => '1'
		],
		".card-img-top:not(img)" => [
			'overflow' => 'clip'
		],
		".navbar-brand" => [
			'position' => 'relative'
		],
		".navbar-brand a" => [
			'text-decoration' => 'inherit',
      'color' => 'inherit'
		],
		".navbar-brand a:after" => [
			'position' => 'absolute',
			'top' =>  '0',
			'left' => '0',
			'bottom' => '0',
			'right' => '0',
			'content' => '\'\'',
			'z-index' => '3'
		],
		".navbar-brand a:hover,.navbar-brand a:focus" => [
			'color' => 'inherit'
		],
		".btn" => [
			'border-radius' => $button_border_radius
		],
	], $block_css);


	$css = implode("\n", array_map(function($selector, $properties) {
		// $properties = array_filter($properties);
		$prop_css = implode("\n", array_map(function($prop, $value) {
			return $value !== null && $value !== '' ? "\t$prop: $value;" : '';
		}, array_keys($properties), array_values($properties)));

		return sprintf("%s {\n%s\n}\n", $selector, $prop_css);
	}, array_keys($css), array_values($css)));

	header('Content-Type: text/css');
	echo $css;
	exit;
}

add_action('wp_ajax_nopriv_bootstrap_presets_css', '_bootstrap_presets_css_action');
add_action('wp_ajax_bootstrap_presets_css', '_bootstrap_presets_css_action');

add_action( 'wp_enqueue_scripts', function() {
	if (!is_admin_bar_showing()) {
		return;
	}

	$custom_css = <<<EOT
	@media screen and (min-width: 601px) {
		.sticky-top {
			top: var(--wp-admin--admin-bar--height, 0);
		}
	}

	body {
		min-height: calc(100vh - var(--wp-admin--admin-bar--height, 0));
	}

	.modal {
		z-index: 100000;
	}
	EOT;

	wp_register_style( 'bootstrap-admin-bar', false,  );
	wp_enqueue_style( 'bootstrap-admin-bar' );
	wp_add_inline_style( 'bootstrap-admin-bar', $custom_css );
}, 11);

add_action( 'enqueue_block_assets', function() {
	if (_bootstrap_is_block_editor()) {
		$url = add_query_arg('action', 'bootstrap_presets_css', admin_url( 'admin-ajax.php' ));
		$url = add_query_arg('is_editor', '1', $url);

		wp_register_style('bootstrap-presets', $url);
		wp_enqueue_style('bootstrap-presets');

    wp_enqueue_script( 'bootstrap-editor',  plugin_dir_url( dirname(__FILE__) ) . '/assets/editor.js' );
	}
});

function _bootstrap_filter_body_html($buffer) {
  $theme_json = _bootstrap_get_theme_json();
  $resolve_preset = _bootstrap_get_preset_resolver($theme_json);
  $background_color = query_object($theme_json, 'styles.color.background') ?: (
    get_background_color()
      ? '#' . get_background_color()
      : ''
  );

  $bs_theme = '';

  if ($background_color) {
    $brightness = brightness($background_color);

    if ($brightness < 100) {
      $bs_theme = 'dark';
    }
  }

  $bs_theme = apply_filters('bootstrap_theme', $bs_theme);

  if ($bs_theme) {
    $buffer = preg_replace('/<body([^>]+)/', sprintf('<body$1 data-bs-theme="%s"', $bs_theme), $buffer);
  }

  return $buffer;
}


ob_start();

add_action('shutdown', function() {
    $final = '';
    $levels = ob_get_level();

    for ($i = 0; $i < $levels; $i++) {
      $final .= ob_get_clean();
    }

    echo _bootstrap_filter_body_html($final);
}, 0);

add_action( 'wp_enqueue_scripts', function() {
  wp_enqueue_style(
    'bootstrap-global-styles',
    add_query_arg('action', 'bootstrap_presets_css', admin_url( 'admin-ajax.php' )),
    array(),
    wp_get_theme()->get( 'Version' )
  );
}, 100000);
