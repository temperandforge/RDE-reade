<?php

// Block categories
add_filter('block_categories_all', function ($categories, $post) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'theme-blocks',
				'title' => 'Theme Blocks',
			),
		)
	);
}, 10, 2);

// foreach([
//    'new-block'
// ]
// as $idx => $label) {
//    require_once get_stylesheet_directory() . "/template-parts/blocks/$label/$label.php";
// }

add_action('acf/init', 'theme_register_blocks');
function theme_register_blocks()
{
	if (!function_exists('acf_register_block')) {
		return;
	}

	/** Keep Alphabetic */ //TODO //STARTER
	//TODO - https://stackoverflow.com/questions/65886937/show-preview-image-for-custom-gutenberg-blocks
	$img_root = "./assets/img/blocks";
	$mode = 'edit';
	/** 
	 * Call To Action
	 * */
	acf_register_block([
		'name'			=> 'call-to-action',
		'title'			=> 'Call To Action',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/call-to-action.php",
		'category'		=> 'theme-blocks',
		'icon'			=> 'button',
		'image'        => $img_root . '/faq-accordion.webp',
		'mode'			=> $mode,
		'keywords'		=> ['call-to-action', 'cta', 'reade', 'theme', TEXTDOMAIN],
		'supports'     => ['align' => false], //TODO
	]);

	/** 
	 * Contact Hero
	 * */
	acf_register_block([
		'name'			=> 'contact-dual-cta',
		'title'			=> 'Contact Dual CTA',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/contact-dual-cta.php",
		'category'		=> 'theme-blocks',
		'icon'			=> 'button',
		'image'        => $img_root . '/faq-accordion.webp',
		'mode'			=> $mode,
		'keywords'		=> ['contact', 'cta', 'dual', 'reade', 'theme', TEXTDOMAIN],
		'supports'     => ['align' => false], //TODO
	]);

	/** 
	 * Contact Form
	 * */
	acf_register_block([
		'name'			=> 'contact-form',
		'title'			=> 'Contact Form',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/contact-form.php",
		'category'		=> 'theme-blocks',
		'icon'			=> 'button',
		'image'        => $img_root . '/faq-accordion.webp',
		'mode'			=> $mode,
		'keywords'		=> ['contact', 'form', 'reade', 'theme', TEXTDOMAIN],
		'supports'     => ['align' => false], //TODO
	]);

	/** 
	 * Contact Hero
	 * */
	acf_register_block([
		'name'			=> 'contact-hero',
		'title'			=> 'Contact Hero',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/contact-hero.php",
		'category'		=> 'theme-blocks',
		'icon'			=> 'button',
		'image'        => $img_root . '/faq-accordion.webp',
		'mode'			=> $mode,
		'keywords'		=> ['contact', 'hero', 'reade', 'theme', TEXTDOMAIN],
		'supports'     => ['align' => false], //TODO
	]);

	/** 
	 * Contact Location Information
	 * */
	acf_register_block([
		'name'			=> 'contact-location-information',
		'title'			=> 'Contact Location Information',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/contact-location-information.php",
		'category'		=> 'theme-blocks',
		'icon'			=> 'button',
		'image'        => $img_root . '/faq-accordion.webp',
		'mode'			=> $mode,
		'keywords'		=> ['contact', 'location', 'reade', 'theme', TEXTDOMAIN],
		'supports'     => ['align' => false], //TODO
	]);
	
   /** 
	 * Calculator
	 * */
	acf_register_block([
		'name'			=> 'calculator',
		'title'			=> 'Calculator',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/calculator.php",
		'category'		=> 'theme-blocks',
		'icon'			=> 'button',
		'image'        => $img_root . '/calculator.webp',
		'mode'			=> $mode,
		'keywords'		=> ['hero', 'reade', 'theme', TEXTDOMAIN],
		'supports'     => ['align' => false], //TODO
	]);

	/** 
	 * FAQS Accordions
	 * */
	acf_register_block([
		'name'			=> 'faqs-accordions',
		'title'			=> 'FAQs Accordions',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/faqs-accordions.php",
		'category'		=> 'theme-blocks',
		'icon'			=> 'button',
		'image'        => $img_root . '/call-to-action.webp',
		'mode'			=> $mode,
		'keywords'		=> ['faqs', 'reade', 'theme', TEXTDOMAIN]
	]);
	
		/** 
			* FAQS Hero
			* */
		acf_register_block([
			'name'			=> 'faqs-hero',
			'title'			=> 'FAQs Hero',
			'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/faqs-hero.php",
			'category'		=> 'theme-blocks',
			'icon'			=> 'button',
			'image'        => $img_root . '/call-to-action.webp',
			'mode'			=> $mode,
			'keywords'		=> ['faqs', 'reade', 'hero', 'theme', TEXTDOMAIN],
			'supports'     => ['align' => false], //TODO
		]);
	
		/** 
			* Grid Hero
			* */
		acf_register_block([
			'name'			=> 'grid-hero',
			'title'			=> 'Grid Hero',
			'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/grid-hero.php",
			'category'		=> 'theme-blocks',
			'icon'			=> 'button',
			'image'        => $img_root . '/call-to-action.webp',
			'mode'			=> $mode,
			'keywords'		=> ['grid', 'reade', 'hero', 'theme', TEXTDOMAIN],
			'supports'     => ['align' => false], //TODO
		]);

	/**
	 * News Category
	 * */

	 acf_register_block([
		'name'			=> 'news-category',
		'title'			=> 'News Category',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/news-category.php",
		'category'		=> 'theme-blocks',
		'icon'			=> 'button', //TODO
		'image'        => $img_root . '/news-category.webp',
		'mode'			=> $mode,
		'keywords'		=> ['news category', 'news', 'category', 'reade', 'theme', TEXTDOMAIN],
		'supports'     => ['align' => false], //TODO
	]);

	/**
	 * News Hero
	 * */

	 acf_register_block([
		'name'			=> 'news-hero',
		'title'			=> 'News Hero',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/news-hero.php",
		'category'		=> 'theme-blocks',
		'icon'			=> 'button', //TODO
		'image'        => $img_root . '/news-hero.webp',
		'mode'			=> $mode,
		'keywords'		=> ['news hero', 'news', 'hero', 'reade', 'theme', TEXTDOMAIN],
		'supports'     => ['align' => false], //TODO
	]);

	/**
	 * News Featured
	 * */

	 acf_register_block([
		'name'			=> 'news-featured',
		'title'			=> 'News Featured',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/news-featured.php",
		'category'		=> 'theme-blocks',
		'icon'			=> 'button', //TODO
		'image'        => $img_root . '/news-featured.webp',
		'mode'			=> $mode,
		'keywords'		=> ['news featured', 'news', 'featured', 'reade', 'theme', TEXTDOMAIN],
		'supports'     => ['align' => false], //TODO
	]);

	/** 
	 * Page Hero 
	 * */
	acf_register_block([
		'name'			 => 'page-hero',
		'title'			 => 'Hero',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/page-hero.php",
		'category'		 => 'theme-blocks',
		'icon'			 => 'button', //TODO
		'image'         => $img_root . '/page-hero.webp',
		'mode'			 => $mode,
		'keywords'		 => ['hero', 'reade', 'theme', TEXTDOMAIN],
		'supports'      => ['align' => false],
      //TODO
		//'enqueue_style' => get_template_directory_uri() . '/template-parts/blocks/testimonial/testimonial.css',
	]);

	/** 
	 * Primary Hero Banner
	 * */
	acf_register_block([
		'name'			 => 'primary-hero-banner',
		'title'			 => 'Primary Hero Banner',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/primary-hero-banner.php",
		'category'		 => 'theme-blocks',
		'icon'			 => 'button', //TODO
		'image'         => $img_root . '/page-hero.webp',
		'mode'			 => $mode,
		'keywords'		 => ['hero', 'reade', 'theme', TEXTDOMAIN],
		'supports'      => ['align' => false],
      //TODO
		//'enqueue_style' => get_template_directory_uri() . '/template-parts/blocks/testimonial/testimonial.css',
	]);

	/** 
	 * Simple CTA
	 * */
	acf_register_block([
		'name'			 => 'secondary-hero',
		'title'			 => 'Secondary Hero',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/secondary-hero.php",
		'category'		 => 'theme-blocks',
		'icon'			 => 'button', //TODO
		'image'         => $img_root . '/page-hero.webp',
		'mode'			 => $mode,
		'keywords'		 => ['secondary', 'hero', 'reade', 'theme', TEXTDOMAIN],
		'supports'      => ['align' => false],
      //TODO
		//'enqueue_style' => get_template_directory_uri() . '/template-parts/blocks/testimonial/testimonial.css',
	]);

	/** 
	 * Simple CTA
	 * */
	acf_register_block([
		'name'			 => 'simple-cta',
		'title'			 => 'Simple CTA',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/simple-cta.php",
		'category'		 => 'theme-blocks',
		'icon'			 => 'button', //TODO
		'image'         => $img_root . '/page-hero.webp',
		'mode'			 => $mode,
		'keywords'		 => ['simple', 'cta', 'reade', 'theme', TEXTDOMAIN],
		'supports'      => ['align' => false],
      //TODO
		//'enqueue_style' => get_template_directory_uri() . '/template-parts/blocks/testimonial/testimonial.css',
	]);

	/** 
	 * Static Testimonial
	 * */
	acf_register_block([
		'name'			 => 'static-testimonial',
		'title'			 => 'Static Testimonial',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/static-testimonial.php",
		'category'		 => 'theme-blocks',
		'icon'			 => 'button', //TODO
		'image'         => $img_root . '/page-hero.webp',
		'mode'			 => $mode,
		'keywords'		 => ['static', 'testimonial', 'reade', 'theme', TEXTDOMAIN],
		'supports'      => ['align' => false],
      //TODO
		//'enqueue_style' => get_template_directory_uri() . '/template-parts/blocks/testimonial/testimonial.css',
	]);

	/** 
	 * Tools CTA
	 * */
	acf_register_block([
		'name'			 => 'tools-cta',
		'title'			 => 'Tools CTA',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/tools-cta.php",
		'category'		 => 'theme-blocks',
		'icon'			 => 'button', //TODO
		'image'         => $img_root . '/tools-cta.webp',
		'mode'			 => $mode,
		'keywords'		 => ['tools', 'cta', 'reade', 'theme', TEXTDOMAIN],
		'supports'      => ['align' => false],
      //TODO
		//'enqueue_style' => get_template_directory_uri() . '/template-parts/blocks/testimonial/testimonial.css',
	]);
}


function theme_register_blocks_style()
{
	if (function_exists('register_block_style')) {
		register_block_style( 
         'core/heading', 
         array( 'name' =>'heading-size-1', 'label'=> __('Size 1', TEXTDOMAIN), 
            // 'is_default'   => false, // 'inline_style' => '.wp-block-group.is-style-blue-wave', 
         ) 
      );
		// register_block_style( 'core/heading', array( 'name'=>'heading-size-2','label'=> __('Size 1', TEXTDOMAIN)));
		// register_block_style( 'core/heading', array( 'name'=>'heading-size-2','label'=> __('Size 2', TEXTDOMAIN)));
		// register_block_style( 'core/heading', array( 'name'=>'heading-size-3','label'=> __('Size 3', TEXTDOMAIN)));
		// register_block_style( 'core/heading', array( 'name'=>'heading-size-4','label'=> __('Size 4', TEXTDOMAIN)));
		// register_block_style( 'core/heading', array( 'name'=>'heading-size-5','label'=> __('Size 5', TEXTDOMAIN)));
		// register_block_style( 'core/heading', array( 'name'=>'heading-size-6','label'=> __('Size 6', TEXTDOMAIN)));
		// register_block_style( 'core/paragraph', array( 'name'=>'paragraph-size-1','label'=> __('Size 1', TEXTDOMAIN)));
		// register_block_style( 'core/paragraph', array( 'name'=>'paragraph-size-2','label'=> __('Size 2', TEXTDOMAIN)));
		// register_block_style( 'core/paragraph', array( 'name'=>'paragraph-size-3','label'=> __('Size 3', TEXTDOMAIN)));
		// register_block_style( 'core/paragraph', array( 'name'=>'paragraph-size-4','label'=> __('Size 4', TEXTDOMAIN)));
		// register_block_style( 'core/paragraph', array( 'name'=>'paragraph-size-5','label'=> __('Size 5', TEXTDOMAIN)));
		// register_block_style( 'core/paragraph', array( 'name'=>'paragraph-size-6','label'=> __('Size 6', TEXTDOMAIN)));
		// register_block_style( 'core/paragraph', array( 'name'=>'paragraph-size-7','label'=> __('Size 6 test', TEXTDOMAIN)));
		// register_block_style( 'core/group', array( 'name' =>'bg-themed', 'label'=> __(' Themed Background', TEXTDOMAIN), ) );
		// register_block_style( 'core/cover', array( 'name' =>'wide', 'label'=> __('Wide', TEXTDOMAIN), ) );
		// register_block_style( 'acf/page-hero', array( 'name' =>'hero-wide', 'label'=> __('Wide', TEXTDOMAIN), ) );
		
		// register_block_style( 
      //    'core/group', 
      //    array( 
      //       'name' =>'blue-bg', 
      //       'label'=> __('Blue Background', TEXTDOMAIN), 
      //    ) 
      // );
	}
}
// add_action('acf/init', 'theme_register_blocks_style');
