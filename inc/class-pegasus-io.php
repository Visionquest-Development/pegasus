<?php
/**
 * Pegasus theme — options import/export.
 *
 * Configure the theme on one site (colors, header/footer, layout, menus, typography, custom
 * CSS, …) and move those settings to another site as a JSON file instead of re-entering
 * everything. Modeled on the pegasus-botify plugin's Import / Export feature.
 *
 * Behavior:
 *   - Export writes the whole `pegasus_options` array (minus any EXCLUDED_KEYS) to a JSON file.
 *   - Import MERGES: keys present in the file overwrite those keys; keys absent are left
 *     untouched, so importing never wipes settings the file doesn't mention.
 *
 * Note on media: image/logo fields store the source site's attachment URLs/IDs, which point
 * back at the source site's media library — re-set those on the destination after importing.
 *
 * @package Pegasus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Pegasus_IO {

	/** The option key the CMB2 theme-options page saves to (Pegasus_Admin::$key). */
	const OPTION_KEY = 'pegasus_options';

	/** Parent admin menu slug (Pegasus Options). */
	const PARENT_SLUG = 'pegasus_options';

	const PAGE_SLUG     = 'pegasus_io';
	const EXPORT_ACTION = 'pegasus_export';
	const IMPORT_ACTION = 'pegasus_import';

	/** Keys never exported or imported. None by default; add site-specific/secret keys here. */
	const EXCLUDED_KEYS = array();

	public static function init() {
		// Priority 20 so the parent "Pegasus Options" menu (registered on admin_menu @10) exists.
		add_action( 'admin_menu', array( __CLASS__, 'add_page' ), 20 );
		add_action( 'admin_post_' . self::EXPORT_ACTION, array( __CLASS__, 'handle_export' ) );
		add_action( 'admin_post_' . self::IMPORT_ACTION, array( __CLASS__, 'handle_import' ) );
	}

	public static function add_page() {
		add_submenu_page(
			self::PARENT_SLUG,
			__( 'Import / Export', 'pegasus' ),
			__( 'Import / Export', 'pegasus' ),
			'manage_options',
			self::PAGE_SLUG,
			array( __CLASS__, 'render' )
		);
	}

	/* ---------------------------------------------------------------- data */

	/**
	 * Build the export payload: metadata + theme options with excluded keys removed.
	 *
	 * @return array
	 */
	public static function export_data() {
		$opts = get_option( self::OPTION_KEY, array() );
		if ( ! is_array( $opts ) ) {
			$opts = array();
		}
		foreach ( self::EXCLUDED_KEYS as $key ) {
			unset( $opts[ $key ] );
		}

		$theme = wp_get_theme( get_template() );

		return array(
			'_meta'    => array(
				'theme'    => 'pegasus',
				'version'  => $theme ? $theme->get( 'Version' ) : '',
				'exported' => current_time( 'mysql' ),
				'site'     => home_url(),
			),
			'settings' => $opts,
		);
	}

	/**
	 * Merge imported settings into the saved option. Excluded keys are ignored even if present.
	 *
	 * @param array $settings
	 * @return int Number of keys imported.
	 */
	public static function import_settings( array $settings ) {
		$current = get_option( self::OPTION_KEY, array() );
		if ( ! is_array( $current ) ) {
			$current = array();
		}

		$count = 0;
		foreach ( $settings as $key => $value ) {
			if ( in_array( $key, self::EXCLUDED_KEYS, true ) ) {
				continue;
			}
			$current[ $key ] = $value;
			$count++;
		}

		update_option( self::OPTION_KEY, $current );
		return $count;
	}

	/* ---------------------------------------------------------------- handlers */

	public static function handle_export() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'You are not allowed to do that.', 'pegasus' ) );
		}
		check_admin_referer( self::EXPORT_ACTION );

		$json     = wp_json_encode( self::export_data(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
		$filename = 'pegasus-theme-settings-' . gmdate( 'Ymd-His' ) . '.json';

		nocache_headers();
		header( 'Content-Type: application/json; charset=utf-8' );
		header( 'Content-Disposition: attachment; filename="' . $filename . '"' );
		header( 'Content-Length: ' . strlen( $json ) );
		echo $json; // phpcs:ignore WordPress.Security.EscapeOutput -- JSON download, not HTML.
		exit;
	}

	public static function handle_import() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'You are not allowed to do that.', 'pegasus' ) );
		}
		check_admin_referer( self::IMPORT_ACTION );

		$redirect = add_query_arg( 'page', self::PAGE_SLUG, admin_url( 'admin.php' ) );

		if ( empty( $_FILES['pegasus_settings_file']['tmp_name'] ) || ! is_uploaded_file( $_FILES['pegasus_settings_file']['tmp_name'] ) ) {
			wp_safe_redirect( add_query_arg( 'pg_io', 'nofile', $redirect ) );
			exit;
		}

		$size = (int) $_FILES['pegasus_settings_file']['size'];
		if ( $size <= 0 || $size > 2 * MB_IN_BYTES ) {
			wp_safe_redirect( add_query_arg( 'pg_io', 'badsize', $redirect ) );
			exit;
		}

		$raw  = file_get_contents( $_FILES['pegasus_settings_file']['tmp_name'] ); // phpcs:ignore WordPress.WP.AlternativeFunctions
		$data = json_decode( $raw, true );

		if ( ! is_array( $data ) || ! isset( $data['settings'] ) || ! is_array( $data['settings'] ) ) {
			wp_safe_redirect( add_query_arg( 'pg_io', 'invalid', $redirect ) );
			exit;
		}

		$count = self::import_settings( $data['settings'] );
		wp_safe_redirect( add_query_arg( array( 'pg_io' => 'ok', 'pg_n' => $count ), $redirect ) );
		exit;
	}

	/* ---------------------------------------------------------------- UI */

	public static function render() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		$post_url = admin_url( 'admin-post.php' );
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Pegasus Import / Export', 'pegasus' ); ?></h1>
			<?php self::notice(); ?>
			<p><?php esc_html_e( 'Move your Pegasus theme settings between sites — colors, header &amp; footer, layout, menus, typography, and custom CSS. Image/logo fields reference the source site\'s media, so re-set those on the destination after importing.', 'pegasus' ); ?></p>

			<h2><?php esc_html_e( 'Export', 'pegasus' ); ?></h2>
			<p><?php esc_html_e( 'Download all theme options as a JSON file.', 'pegasus' ); ?></p>
			<form method="post" action="<?php echo esc_url( $post_url ); ?>">
				<input type="hidden" name="action" value="<?php echo esc_attr( self::EXPORT_ACTION ); ?>" />
				<?php wp_nonce_field( self::EXPORT_ACTION ); ?>
				<?php submit_button( __( 'Export settings', 'pegasus' ), 'primary', 'submit', false ); ?>
			</form>

			<hr />

			<h2><?php esc_html_e( 'Import', 'pegasus' ); ?></h2>
			<p><?php esc_html_e( 'Upload a file exported from another Pegasus site. Matching settings are overwritten; anything not in the file is left as-is.', 'pegasus' ); ?></p>
			<form method="post" enctype="multipart/form-data" action="<?php echo esc_url( $post_url ); ?>">
				<input type="hidden" name="action" value="<?php echo esc_attr( self::IMPORT_ACTION ); ?>" />
				<?php wp_nonce_field( self::IMPORT_ACTION ); ?>
				<input type="file" name="pegasus_settings_file" accept="application/json,.json" required />
				<?php submit_button( __( 'Import settings', 'pegasus' ), 'secondary', 'submit', false ); ?>
			</form>
		</div>
		<?php
	}

	private static function notice() {
		if ( ! isset( $_GET['pg_io'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
			return;
		}
		$code = sanitize_key( wp_unslash( $_GET['pg_io'] ) ); // phpcs:ignore WordPress.Security.NonceVerification
		$map  = array(
			'ok'      => array( 'success', sprintf( __( 'Imported %d settings.', 'pegasus' ), isset( $_GET['pg_n'] ) ? (int) $_GET['pg_n'] : 0 ) ), // phpcs:ignore WordPress.Security.NonceVerification
			'nofile'  => array( 'error', __( 'No file was uploaded.', 'pegasus' ) ),
			'badsize' => array( 'error', __( 'That file is empty or too large.', 'pegasus' ) ),
			'invalid' => array( 'error', __( 'That file is not a valid Pegasus settings export.', 'pegasus' ) ),
		);
		if ( ! isset( $map[ $code ] ) ) {
			return;
		}
		printf(
			'<div class="notice notice-%s is-dismissible"><p>%s</p></div>',
			esc_attr( $map[ $code ][0] ),
			esc_html( $map[ $code ][1] )
		);
	}
}
