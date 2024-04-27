<?php
/**
 *
 * @author  Serhii Mykulyn
 * @link    https://mykulyn.com
 * @package mwf
 *
 */

namespace MWF;

final class Init {

	// All classes in an array
	public static function get_services(): array {
		return [
			//General\Vite::class, // Vite.js
			General\Assets::class, // Assets
			General\Optimization::class, // Optimization WordPress
			General\Setup::class, // Setup WordPress
			General\TGM::class, // Required plugins
			General\Image::class,

			Blocks\Blocks::class,

			//Custom\PostTypes::class, // Custom post types
			Custom\Menus::class, // Menus
			Custom\Forms::class,

			Plugins\CustomFields::class, // ACF
		];
	}

	// Call the register() method
	public static function register_services(): void {
		foreach ( self::get_services() as $class ) {
			$service = self::instantiate( $class );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}

	// Initializing classes
	private static function instantiate( $class ) {
		return new $class();
	}


}
