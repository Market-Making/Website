<?php
/**
 * Woocommerce Tab For Theme Option.
 *
 * @package geekfolio
 */

Redux::setSection($geekfolio_pre, array(
	'title'  => esc_html__( 'Woocommerce', 'geekfolio' ),
	'icon' => 'el-icon-shopping-cart',
));

Redux::setSection($geekfolio_pre, array(
	'id' => 'geekfolio_woocommerce_config',
	"subsection" => true,
	'title' => esc_html__('Woocommerce settings', 'geekfolio'),
	'desc' => esc_html__('Configuration the Woocommerce', 'geekfolio'),
	'icon' => 'el el-brush',
	'fields' => array( 

		array(
			'id'       => 'geekfolio_header_cart',
			'type'     => 'select',
			'title'    => esc_html__('Cart Icon', 'geekfolio'), 
			'subtitle' => esc_html__('To show Cart icon in header', 'geekfolio'),
			'options' => array(
				'on' => esc_html__('On', 'geekfolio'),
				'off' => esc_html__('Off', 'geekfolio'),
			), 
			'default'  => 'off',
		)
	)
));

?>