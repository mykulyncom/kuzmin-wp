<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */

namespace MWF\General;

require_once MWF_PATH . '/core/Helpers/class-tgm-plugin-activation.php';

class TGM {
	public function __construct() {
		add_action( 'tgmpa_register', [ $this, 'mwf_register_required_plugins' ] );
	}

	public function mwf_register_required_plugins(): void {
		$webp = [
			'name'     => 'WebP Express',
			'slug'     => 'webp-express',
			'required' => true,
		];

		$tolat = [
			'name'     => 'Ukr-To-Lat',
			'slug'     => 'ukr-to-lat',
			'required' => true,
		];

		// if ( ! get_locale() == 'en_US' ) {
		// 	$plugins = [$webp, $tolat];
		// } else {
		// 	$plugins = [$webp];
		// }

		$plugins = [$webp, $tolat];


		$config = [
			'id'           => 'mwf',
			'default_path' => '',
			'menu'         => 'tgmpa-install-plugins',
			'has_notices'  => true,
			'dismissable'  => false,
			'dismiss_msg'  => '',
			'is_automatic' => true,
			'message'      => '',

			'strings' => [
				'page_title'                      => __( 'Install Required Plugins', 'mwf' ),
				'menu_title'                      => __( 'Install Plugins', 'mwf' ),
				'installing'                      => __( 'Installing Plugin: %s', 'mwf' ),
				'updating'                        => __( 'Updating Plugin: %s', 'mwf' ),
				'oops'                            => __( 'Something went wrong with the plugin API.', 'mwf' ),
				'notice_can_install_required'     => _n_noop(
					'This theme requires the following plugin: %1$s.',
					'This theme requires the following plugins: %1$s.',
					'mwf'
				),
				'notice_can_install_recommended'  => _n_noop(
					'This theme recommends the following plugin: %1$s.',
					'This theme recommends the following plugins: %1$s.',
					'mwf'
				),
				'notice_ask_to_update'            => _n_noop(
					'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
					'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
					'mwf'
				),
				'notice_ask_to_update_maybe'      => _n_noop(
					'There is an update available for: %1$s.',
					'There are updates available for the following plugins: %1$s.',
					'mwf'
				),
				'notice_can_activate_required'    => _n_noop(
					'The following required plugin is currently inactive: %1$s.',
					'The following required plugins are currently inactive: %1$s.',
					'mwf'
				),
				'notice_can_activate_recommended' => _n_noop(
					'The following recommended plugin is currently inactive: %1$s.',
					'The following recommended plugins are currently inactive: %1$s.',
					'mwf'
				),
				'install_link'                    => _n_noop(
					'Begin installing plugin',
					'Begin installing plugins',
					'mwf'
				),
				'update_link'                     => _n_noop(
					'Begin updating plugin',
					'Begin updating plugins',
					'mwf'
				),
				'activate_link'                   => _n_noop(
					'Begin activating plugin',
					'Begin activating plugins',
					'mwf'
				),
				'return'                          => __( 'Return to Required Plugins Installer', 'mwf' ),
				'plugin_activated'                => __( 'Plugin activated successfully.', 'mwf' ),
				'activated_successfully'          => __( 'The following plugin was activated successfully:', 'mwf' ),
				'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'mwf' ),
				'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'mwf' ),
				'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'mwf' ),
				'dismiss'                         => __( 'Dismiss this notice', 'mwf' ),
				'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'mwf' ),
				'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'mwf' ),

				'nag_type' => '',
			],
		];

		tgmpa( $plugins, $config );
	}
}
