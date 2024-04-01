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


	protected function render() {
		global $product;
	
		if (is_a($product, 'WC_Product')) {
			$attachment_ids = $product->get_gallery_image_ids();
	
			if (!empty($attachment_ids)) {
				echo '<div class="woo-gallery h-full flex flex-col">';
				echo '<div class="swiper gallery-slider">';
				echo '<div class="swiper-wrapper">';
				foreach ($attachment_ids as $attachment_id) {
					$image_url = wp_get_attachment_url($attachment_id);
					echo '<div class="swiper-slide"><img src="' . esc_url($image_url) . '" alt=""></div>';
				}
				echo '</div>';
				
				echo '</div>';
	
				echo '<div class="swiper gallery-thumbs h-[160px]">';
				echo '<div class="swiper-wrapper">';
				foreach ($attachment_ids as $attachment_id) {
					$image = wp_get_attachment_image($attachment_id, 'medium');
					echo '<div class="swiper-slide">' . $image . '</div>';
				}
				echo '</div>';
				echo '<div class="swiper-arrow-left absolute left-0 h-full w-[50px] top-0 bg-black/25 z-10 flex items-center justify-center rotate-180">
				<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M9.345 5.655L12 3L27 18L12 33L9.345 30.345L21.69 18L9.345 5.655Z" fill="white"/>
				</svg>
				</div>';
				echo 
				'<div class="swiper-arrow-right absolute right-0 h-full w-[50px] top-0 bg-black/25 z-10 flex items-center justify-center">
				<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M9.345 5.655L12 3L27 18L12 33L9.345 30.345L21.69 18L9.345 5.655Z" fill="white"/>
				</svg>				
				</div>';
				
				echo '</div>';
				echo '</div>';
			} else {
				echo '<p>Brak zdjęć dla tego produktu.</p>';
			}
		} else {
			echo '<p>Nie znaleziono produktu.</p>';
		}
	}

}
