<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class WooGallery extends \Elementor\Widget_Base {

	public function get_name() {
		return 'my_custom_widget';
	}

    public function get_title() {
		return esc_html__( 'WooGallery', 'woo-gallery' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'woo-gallery' ),
			]
		);

		// Add your controls here. For example:
		$this->add_control(
			'text',
			[
				'label' => esc_html__( 'Text', 'woo-gallery' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default text', 'woo-gallery' ),
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		global $product;
	
		if (is_a($product, 'WC_Product')) {
			$attachment_ids = $product->get_gallery_image_ids();
	
			if (!empty($attachment_ids)) {
				echo '<div class="swiper gallery-slider">';
				echo '<div class="swiper-wrapper">';
				foreach ($attachment_ids as $attachment_id) {
					$image_url = wp_get_attachment_url($attachment_id);
					echo '<div class="swiper-slide"><img src="' . esc_url($image_url) . '" alt=""></div>';
				}
				echo '</div>';
				echo '<div class="swiper-button-next"></div>';
				echo '<div class="swiper-button-prev"></div>';
				echo '</div>';
	
				echo '<div class="swiper gallery-thumbs">';
				echo '<div class="swiper-wrapper">';
				foreach ($attachment_ids as $attachment_id) {
					$image_url = wp_get_attachment_url($attachment_id);
					echo '<div class="swiper-slide"><img src="' . esc_url($image_url) . '" alt=""></div>';
				}
				echo '</div>';
				echo '</div>';
			} else {
				echo '<p>No gallery images found for this product.</p>';
			}
		} else {
			echo '<p>No product found.</p>';
		}
	}

}
