<?php

defined( 'ABSPATH' ) || exit;

/**
* Geekfolio Theme Helper
*
*
* @class        Geekfolio_Theme_Helper
* @version      1.0
* @category     Class
* @author       ThemesCamp
*/

if (! class_exists('Geekfolio_Theme_Helper')) {
	class Geekfolio_Theme_Helper
	{
		public static function render_sidebars(){

			$sidebar_style = '';
			$sidebar_gap = geekfolio_option( 'single_sidebar_gap','0' );
			$layout = geekfolio_option( 'single_sidebar_layout' );

			if (isset($sidebar_gap) && $sidebar_gap != 'def' && $layout != 'default') {
				$layout_pos = $layout == 'left' ? 'right' : 'left';
				$sidebar_style = 'style="padding-'.$layout_pos.': '.$sidebar_gap.'px;"';
				return $sidebar_style;
			}
		}

	}
}