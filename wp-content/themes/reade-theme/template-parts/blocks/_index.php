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

add_action('acf/init', 'theme_register_blocks');
function theme_register_blocks()
{
   if (!function_exists('acf_register_block')) {
      return;
   }

	/** Keep Alphabetic */
	$img_root = "./assets/img/blocks";
	$mode = 'edit';

	/** 
	 * Benefits
	 * */
	acf_register_block([
		'name'			=> 'benefits',
		'title'			=> 'Benefits',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/benefits.php",
		'category'		=> 'theme-blocks',
		'icon'			=> 'button',
		'image'        => $img_root . '/benefits.webp',
		'mode'			=> $mode,
		'keywords'		=> ['benefits', 'reade', 'theme', TEXTDOMAIN],
		'supports'     => ['align' => false],
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
		'supports'     => ['align' => false],
	]);

   /** 
    * Call To Action
    * */
   acf_register_block([
      'name'         => 'call-to-action',
      'title'         => 'Call To Action',
      'render_template'   => get_stylesheet_directory() . "/template-parts/blocks/call-to-action.php",
      'category'      => 'theme-blocks',
      'icon'         => 'button',
      'mode'         => $mode,
      'keywords'      => ['call-to-action', 'cta', 'reade', 'theme', TEXTDOMAIN],
      'supports'     => ['align' => false],
   ]);

	/** 
	 * Certificate CTA
	 * */
	acf_register_block([
		'name'			=> 'certificate-cta',
		'title'			=> 'Certificate CTA',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/certificate-cta.php",
		'category'		=> 'theme-blocks',
		'icon'			=> 'button',
		'image'        => $img_root . '/certificate-cta.webp',
		'mode'			=> $mode,
		'keywords'		=> ['certificate', 'cta', 'reade', 'theme', TEXTDOMAIN],
	 	]);
				
			/** 
				* Career Block
	 * */
	acf_register_block([
		'name'			=> 'career-block',
		'title'			=> 'Career Block',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/career-block.php",
		'category'		=> 'theme-blocks',
		'icon'			=> 'button',
		'mode'			=> $mode,
		'keywords'		=> ['career', 'reade', 'theme', TEXTDOMAIN],
		'supports'     => ['align' => false],
	]);

   /** 
    * Contact Dual CTA
    * */
   acf_register_block([
      'name'         => 'contact-dual-cta',
      'title'         => 'Contact Dual CTA',
      'render_template'   => get_stylesheet_directory() . "/template-parts/blocks/contact-dual-cta.php",
      'category'      => 'theme-blocks',
      'icon'         => 'button',
      'mode'         => $mode,
      'keywords'      => ['contact', 'cta', 'dual', 'reade', 'theme', TEXTDOMAIN],
      'supports'     => ['align' => false],
   ]);

   /** 
    * Contact Form
    * */
   acf_register_block([
      'name'         => 'contact-form',
      'title'         => 'Contact Form',
      'render_template'   => get_stylesheet_directory() . "/template-parts/blocks/contact-form.php",
      'category'      => 'theme-blocks',
      'icon'         => 'button',
      'mode'         => $mode,
      'keywords'      => ['contact', 'form', 'reade', 'theme', TEXTDOMAIN],
      'supports'     => ['align' => false],
   ]);

   /** 
    * Contact Hero
    * */
   acf_register_block([
      'name'         => 'contact-hero',
      'title'         => 'Contact Hero',
      'render_template'   => get_stylesheet_directory() . "/template-parts/blocks/contact-hero.php",
      'category'      => 'theme-blocks',
      'icon'         => 'button',
      'mode'         => $mode,
      'keywords'      => ['contact', 'hero', 'reade', 'theme', TEXTDOMAIN],
      'supports'     => ['align' => false],
   ]);

   /** 
    * Contact Location Information
    * */
   acf_register_block([
      'name'         => 'contact-location-information',
      'title'         => 'Contact Location Information',
      'render_template'   => get_stylesheet_directory() . "/template-parts/blocks/contact-location-information.php",
      'category'      => 'theme-blocks',
      'icon'         => 'button',
      'mode'         => $mode,
      'keywords'      => ['contact', 'location', 'reade', 'theme', TEXTDOMAIN],
      'supports'     => ['align' => false],
   ]);

   /** 
    * Content Grid
    * */
   acf_register_block([
      'name'         => 'content-grid',
      'title'         => 'Content Grid',
      'render_template'   => get_stylesheet_directory() . "/template-parts/blocks/content-grid.php",
      'category'      => 'theme-blocks',
      'icon'         => 'button',
      'image'        => $img_root . '/content-grid.webp',
      'mode'         => $mode,
      'keywords'      => ['content', 'grid', 'reade', 'theme', TEXTDOMAIN],
      'supports'     => ['align' => false],
   ]);

   /** 
    * Document Library Cards
    * */
   acf_register_block([
      'name'         => 'document-library-cards',
      'title'         => 'Document Library Cards',
      'render_template'   => get_stylesheet_directory() . "/template-parts/blocks/document-library-cards.php",
      'category'      => 'theme-blocks',
      'icon'         => 'button',
      'image'        => $img_root . '/document-library-cards.webp',
      'mode'         => $mode,
      'keywords'      => ['document', 'library', 'card', 'cards', 'reade', 'theme', TEXTDOMAIN],
      'supports'     => ['align' => false],
   ]);

   /** 
    * Dropshadow Cards
    * */
   acf_register_block([
      'name'         => 'dropshadow-cards',
      'title'         => 'Dropshadow Cards',
      'render_template'   => get_stylesheet_directory() . "/template-parts/blocks/dropshadow-cards.php",
      'category'      => 'theme-blocks',
      'icon'         => 'button',
      'image'        => $img_root . '/dropshadow-cards.webp',
      'mode'         => $mode,
      'keywords'      => ['dropshadow', 'card', 'cards', 'reade', 'theme', TEXTDOMAIN],
      'supports'     => ['align' => false],
   ]);

   /** 
    * Dual Block
    * */
   acf_register_block([
      'name'         => 'dual-block',
      'title'         => 'Dual Block',
      'render_template'   => get_stylesheet_directory() . "/template-parts/blocks/dual-block.php",
      'category'      => 'theme-blocks',
      'icon'         => 'button',
      'image'        => $img_root . '/dual-block.webp',
      'mode'         => $mode,
      'keywords'      => ['dual', 'block', 'reade', 'theme', TEXTDOMAIN]
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
			'mode'			=> $mode,
			'keywords'		=> ['faqs', 'reade', 'hero', 'theme', TEXTDOMAIN],
			'supports'     => ['align' => false],
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
			'image'        => $img_root . '/grid-hero.webp',
			'mode'			=> $mode,
			'keywords'		=> ['grid', 'reade', 'hero', 'theme', TEXTDOMAIN],
			'supports'     => ['align' => false],
		]);

		/** 
			* Icon block
			* */
		acf_register_block([
			'name'			=> 'icon-block',
			'title'			=> 'Icon Block',
			'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/icon-block.php",
			'category'		=> 'theme-blocks',
			'icon'			=> 'button',
			'image'        => $img_root . '/icon-block.webp',
			'mode'			=> $mode,
			'keywords'		=> ['icon', 'block', 'read', 'theme', TEXTDOMAIN],
			'supports'     => ['align' => false],
		]);
	
		/** 
			* Industry Slider
			* */
		acf_register_block([
			'name'			=> 'industry-slider',
			'title'			=> 'Industry Slider',
			'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/industry-slider.php",
			'category'		=> 'theme-blocks',
			'icon'			=> 'button',
			'image'        => $img_root . '/industry-slider.webp',
			'mode'			=> $mode,
			'keywords'		=> ['industry', 'reade', 'slider', 'theme', TEXTDOMAIN],
			'supports'     => ['align' => false],
		]);
	
		/** 
			* Leadership Slider
			* */
		acf_register_block([
			'name'			=> 'leadership-slider',
			'title'			=> 'Leadership Slider',
			'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/leadership-slider.php",
			'category'		=> 'theme-blocks',
			'icon'			=> 'button',
			'image'        => $img_root . '/leadership-slider.webp',
			'mode'			=> $mode,
			'keywords'		=> ['reade', 'leadership', 'slider', 'theme', TEXTDOMAIN],
			'supports'     => ['align' => false], //TODO
		]);

   /** 
    * FAQS Accordions
    * */
   acf_register_block([
      'name'         => 'faqs-accordions',
      'title'         => 'FAQs Accordions',
      'render_template'   => get_stylesheet_directory() . "/template-parts/blocks/faqs-accordions.php",
      'category'      => 'theme-blocks',
      'icon'         => 'button',
      'mode'         => $mode,
      'keywords'      => ['faqs', 'reade', 'theme', TEXTDOMAIN]
   ]);

   /** 
    * History
    * */
   acf_register_block([
      'name'         => 'history',
      'title'         => 'History',
      //callback
      'render_template'   => get_stylesheet_directory() . "/template-parts/blocks/history.php",
      'category'      => 'theme-blocks',
      'icon'         => 'button',
      'image'        => $img_root . '/history.webp',
      'mode'         => $mode,
      'keywords'      => ['history', 'reade', 'theme', TEXTDOMAIN]
   ]);
   /** 
    * FAQS Hero
    * */
   acf_register_block([
      'name'         => 'faqs-hero',
      'title'         => 'FAQs Hero',
      'render_template'   => get_stylesheet_directory() . "/template-parts/blocks/faqs-hero.php",
      'category'      => 'theme-blocks',
      'icon'         => 'button',
      'mode'         => $mode,
      'keywords'      => ['faqs', 'reade', 'hero', 'theme', TEXTDOMAIN],
      'supports'     => ['align' => false],
   ]);

	/** 
	 * Product RFQ
	 * */
	acf_register_block([
		'name'			=> 'product-rfq',
		'title'			=> 'Product RFQ',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/product-rfq.php",
		'category'		=> 'theme-blocks',
		'icon'			=> 'button',
		'image'        => $img_root . '/product-rfq.webp',
		'mode'			=> $mode,
		'keywords'		=> ['product', 'request', 'quote', 'rfq', 'reade', 'theme', TEXTDOMAIN],
		'supports'     => ['align' => false],
	]);


	/**
	 * News Category
	 * */
   /** 
    * Grid Hero
    * */
   acf_register_block([
      'name'         => 'grid-hero',
      'title'         => 'Grid Hero',
      'render_template'   => get_stylesheet_directory() . "/template-parts/blocks/grid-hero.php",
      'category'      => 'theme-blocks',
      'icon'         => 'button',
      'image'        => $img_root . '/grid-hero.webp',
      'mode'         => $mode,
      'keywords'      => ['grid', 'reade', 'hero', 'theme', TEXTDOMAIN],
      'supports'     => ['align' => false],
   ]);

   /** 
    * Industry Slider
    * */
   acf_register_block([
      'name'         => 'industry-slider',
      'title'         => 'Industry Slider',
      'render_template'   => get_stylesheet_directory() . "/template-parts/blocks/industry-slider.php",
      'category'      => 'theme-blocks',
      'icon'         => 'button',
      'image'        => $img_root . '/industry-slider.webp',
      'mode'         => $mode,
      'keywords'      => ['industry', 'reade', 'slider', 'theme', TEXTDOMAIN],
      'supports'     => ['align' => false],
   ]);

   /** 
    * Leadership Slider
    * */
   acf_register_block([
      'name'         => 'leadership-slider',
      'title'         => 'Leadership Slider',
      'render_template'   => get_stylesheet_directory() . "/template-parts/blocks/leadership-slider.php",
      'category'      => 'theme-blocks',
      'icon'         => 'button',
      'image'        => $img_root . '/leadership-slider.webp',
      'mode'         => $mode,
      'keywords'      => ['reade', 'leadership', 'slider', 'theme', TEXTDOMAIN],
      'supports'     => ['align' => false], //TODO
   ]);

   /** 
    * Materials Science Documents (MS Group)
    * */
   acf_register_block([
      'name'         => 'ms-group',
      'title'         => 'MS Group',
      'render_template'   => get_stylesheet_directory() . "/template-parts/blocks/ms-group.php",
      'category'      => 'theme-blocks',
      'icon'         => 'button',
      'image'        => $img_root . '/ms-group.webp',
      'mode'         => $mode,
      'keywords'      => ['materials', 'science', 'group', 'reade', 'theme', TEXTDOMAIN],
      'supports'     => ['align' => false], //TODO
   ]);

   /** 
    * Primary CTA
    * */
   acf_register_block([
      'name'         => 'primary-cta',
      'title'         => 'Primary CTA',
      'render_template'   => get_stylesheet_directory() . "/template-parts/blocks/primary-cta.php",
      'category'      => 'theme-blocks',
      'icon'         => 'button',
      'image'        => $img_root . '/primary-cta.webp',
      'mode'         => $mode,
      'keywords'      => ['reade', 'primary', 'cta', 'theme', TEXTDOMAIN],
      'supports'     => ['align' => false], //TODO
   ]);

   /**
    * News Category
    * */
   acf_register_block([
      'name'         => 'news-category',
      'title'         => 'News Category',
      'render_template'   => get_stylesheet_directory() . "/template-parts/blocks/news-category.php",
      'category'      => 'theme-blocks',
      'icon'         => 'button',
      'image'        => $img_root . '/news-category.webp',
      'mode'         => $mode,
      'keywords'      => ['news category', 'news', 'category', 'reade', 'theme', TEXTDOMAIN],
      'supports'     => ['align' => false],
   ]);

		/** 
			* Position Application
			* */
		acf_register_block([
			'name'			=> 'position-application',
			'title'			=> 'Position Application',
			'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/position-application.php",
			'category'		=> 'theme-blocks',
			'icon'			=> 'button',
			// 'image'        => $img_root . '/primary-cta.webp',
			'mode'			=> $mode,
			'keywords'		=> ['reade', 'position', 'application', 'theme', TEXTDOMAIN],
			'supports'     => ['align' => false], //TODO
		]);

		/** 
			* Position Hero
			* */
		acf_register_block([
			'name'			=> 'position-hero',
			'title'			=> 'Position Hero',
			'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/position-hero.php",
			'category'		=> 'theme-blocks',
			'icon'			=> 'button',
			// 'image'        => $img_root . '/primary-cta.webp',
			'mode'			=> $mode,
			'keywords'		=> ['reade', 'position', 'hero', 'theme', TEXTDOMAIN],
			'supports'     => ['align' => false], //TODO
		]);

		/** 
			* Position Qualifications
			* */
		acf_register_block([
			'name'			=> 'position-qualifications',
			'title'			=> 'Position Qualifications',
			'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/position-qualifications.php",
			'category'		=> 'theme-blocks',
			'icon'			=> 'button',
			// 'image'        => $img_root . '/primary-cta.webp',
			'mode'			=> $mode,
			'keywords'		=> ['reade', 'position', 'qualifications', 'theme', TEXTDOMAIN],
			'supports'     => ['align' => false], //TODO
		]);

		/** 
			* Primary CTA
			* */
		acf_register_block([
			'name'			=> 'primary-cta',
			'title'			=> 'Primary CTA',
			'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/primary-cta.php",
			'category'		=> 'theme-blocks',
			'icon'			=> 'button',
			'image'        => $img_root . '/primary-cta.webp',
			'mode'			=> $mode,
			'keywords'		=> ['reade', 'primary', 'cta', 'theme', TEXTDOMAIN],
			'supports'     => ['align' => false], //TODO
		]);

	// /** 
	//  * Page Hero 
	//  * */
	// acf_register_block([
	// 	'name'			 => 'page-hero',
	// 	'title'			 => 'Hero',
	// 	'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/page-hero.php",
	// 	'category'		 => 'theme-blocks',
	// 	'icon'			 => 'button',
	// 	'image'         => $img_root . '/page-hero.webp',
	// 	'mode'			 => $mode,
	// 	'keywords'		 => ['hero', 'reade', 'theme', TEXTDOMAIN],
	// 	'supports'      => ['align' => false],
     
	// ]);
   /**
    * News Hero
    * */

   acf_register_block([
      'name'         => 'news-hero',
      'title'         => 'News Hero',
      'render_template'   => get_stylesheet_directory() . "/template-parts/blocks/news-hero.php",
      'category'      => 'theme-blocks',
      'icon'         => 'button',
      'image'        => $img_root . '/news-hero.webp',
      'mode'         => $mode,
      'keywords'      => ['news hero', 'news', 'hero', 'reade', 'theme', TEXTDOMAIN],
      'supports'     => ['align' => false],
   ]);

   /**
    * News Featured
    * */

   acf_register_block([
      'name'         => 'news-featured',
      'title'         => 'News Featured',
      'render_template'   => get_stylesheet_directory() . "/template-parts/blocks/news-featured.php",
      'category'      => 'theme-blocks',
      'icon'         => 'button',
      'image'        => $img_root . '/news-featured.webp',
      'mode'         => $mode,
      'keywords'      => ['news featured', 'news', 'featured', 'reade', 'theme', TEXTDOMAIN],
      'supports'     => ['align' => false],
   ]);

   // /** 
   //  * Page Hero 
   //  * */
   // acf_register_block([
   // 	'name'			 => 'page-hero',
   // 	'title'			 => 'Hero',
   // 	'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/page-hero.php",
   // 	'category'		 => 'theme-blocks',
   // 	'icon'			 => 'button',
   // 	'image'         => $img_root . '/page-hero.webp',
   // 	'mode'			 => $mode,
   // 	'keywords'		 => ['hero', 'reade', 'theme', TEXTDOMAIN],
   // 	'supports'      => ['align' => false],

   // ]);

   /** 
    * Primary Footer CTA
    * */
   acf_register_block([
      'name'          => 'primary-footer-cta',
      'title'          => 'Primary Footer CTA',
      'render_template'   => get_stylesheet_directory() . "/template-parts/blocks/primary-footer-cta.php",
      'category'       => 'theme-blocks',
      'icon'          => 'button',
      'image'        => $img_root . '/primary-footer-cta.webp',
      'mode'          => $mode,
      'keywords'       => ['footer', 'cta', 'reade', 'theme', TEXTDOMAIN],
      'supports'      => ['align' => false],
   ]);

   /** 
    * Primary Hero Banner
    * */
   acf_register_block([
      'name'          => 'primary-hero-banner',
      'title'          => 'Primary Hero Banner',
      'render_template'   => get_stylesheet_directory() . "/template-parts/blocks/primary-hero-banner.php",
      'category'       => 'theme-blocks',
      'icon'          => 'button',
      'image'        => $img_root . '/primary-hero.webp',
      'mode'          => $mode,
      'keywords'       => ['hero', 'reade', 'theme', TEXTDOMAIN],
      'supports'      => ['align' => false],
   ]);

			/** 
				* RFQ Form
				* */
			acf_register_block([
				'name'			 => 'rfq-form',
				'title'			 => 'RFQ Form',
				'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/rfq-form.php",
				'category'		 => 'theme-blocks',
				'icon'			 => 'button',
				// 'image'        => $img_root . '/primary-hero.webp',
				'mode'			 => $mode,
				'keywords'		 => ['rfq', 'form', 'reade', 'theme', TEXTDOMAIN],
				'supports'      => ['align' => false],
			]);

   /** 
    * Secondary Hero
    * */
   acf_register_block([
      'name'          => 'secondary-hero',
      'title'          => 'Secondary Hero',
      'render_template'   => get_stylesheet_directory() . "/template-parts/blocks/secondary-hero.php",
      'category'       => 'theme-blocks',
      'icon'          => 'button',
      'image'        => $img_root . '/secondary-hero.webp',
      'mode'          => $mode,
      'keywords'       => ['secondary', 'hero', 'reade', 'theme', TEXTDOMAIN],
      'supports'      => ['align' => false],
   ]);

   /** 
    * Simple CTA
    * */
   acf_register_block([
      'name'          => 'simple-cta',
      'title'          => 'Simple CTA',
      'render_template'   => get_stylesheet_directory() . "/template-parts/blocks/simple-cta.php",
      'category'       => 'theme-blocks',
      'icon'          => 'button',
      'mode'          => $mode,
      'keywords'       => ['simple', 'cta', 'reade', 'theme', TEXTDOMAIN],
      'supports'      => ['align' => false],
   ]);

   /** 
    * Simple CTA
    * */
   acf_register_block([
      'name'          => 'split-content-block',
      'title'          => 'Split Content Block',
      'render_template'   => get_stylesheet_directory() . "/template-parts/blocks/split-content-block.php",
      'category'       => 'theme-blocks',
      'image'        => $img_root . '/split-content-block.webp',
      'icon'          => 'button',
      'mode'          => $mode,
      'keywords'       => ['split', 'content', 'block', 'reade', 'theme', TEXTDOMAIN],
      'supports'      => ['align' => false],
   ]);

   /** 
    * Static Testimonial
    * */
   acf_register_block([
      'name'          => 'static-testimonial',
      'title'          => 'Static Testimonial',
      'render_template'   => get_stylesheet_directory() . "/template-parts/blocks/static-testimonial.php",
      'category'       => 'theme-blocks',
      'icon'          => 'button',
      'mode'          => $mode,
      'keywords'       => ['static', 'testimonial', 'reade', 'theme', TEXTDOMAIN],
      'supports'      => ['align' => false],
   ]);

   /** 
    * Sustainable Dual CTA
    * */
   acf_register_block([
      'name'          => 'sustainable-dual-cta',
      'title'          => 'Sustainable Dual CTA',
      'render_template'   => get_stylesheet_directory() . "/template-parts/blocks/sustainable-dual-cta.php",
      'category'       => 'theme-blocks',
      'icon'          => 'button',
      'image'        => $img_root . '/sustainable-dual-cta.webp',
      'mode'          => $mode,
      'keywords'       => ['sustainable', 'dual', 'cta', 'reade', 'theme', TEXTDOMAIN],
      'supports'      => ['align' => false]
   ]);

   /** 
    * Tabbed Rotator
    * */
   acf_register_block([
      'name'          => 'tabbed-rotator',
      'title'          => 'Tabbed Rotator',
      'render_template'   => get_stylesheet_directory() . "/template-parts/blocks/tabbed-rotator.php",
      'category'       => 'theme-blocks',
      'icon'          => 'button', //TODO
      'image'         => $img_root . '/tabbed-rotator.webp',
      'mode'          => $mode,
      'keywords'       => ['tabbed', 'rotator', 'reade', 'theme', TEXTDOMAIN],
      'supports'      => ['align' => false],
      //TODO
      //'enqueue_style' => get_template_directory_uri() . '/template-parts/blocks/testimonial/testimonial.css',
   ]);

   /** 
    * Testimonial Slider
    * */
   acf_register_block([
      'name'          => 'testimonial-slider',
      'title'          => 'Testimonial Slider',
      'render_template'   => get_stylesheet_directory() . "/template-parts/blocks/testimonial-slider.php",
      'category'       => 'theme-blocks',
      'icon'          => 'button', //TODO
      // 'image'         => $img_root . '/testimonial-slider.webp',
      'mode'          => $mode,
      'keywords'       => ['testimonial', 'slider', 'reade', 'theme', TEXTDOMAIN],
      'supports'      => ['align' => false],
      //TODO
      //'enqueue_style' => get_template_directory_uri() . '/template-parts/blocks/testimonial/testimonial.css',
   ]);

   /**
    * Tile Slider
    */

   acf_register_block([
      'name'          => 'tile-slider',
      'title'          => 'Tile Slider',
      'render_template'   => get_stylesheet_directory() . "/template-parts/blocks/tile-slider.php",
      'category'       => 'theme-blocks',
      'icon'          => 'button',
      'mode'          => $mode,
      'keywords'       => ['tile', 'slider', 'reade', 'theme', TEXTDOMAIN],
      'supports'      => ['align' => false]
   ]);

   /**
    * Tools CTA
    */

	acf_register_block([
		'name'			 => 'tools-cta',
		'title'			 => 'Tools CTA',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/tools-cta.php",
		'category'		 => 'theme-blocks',
		'icon'			 => 'button',
		'mode'			 => $mode,
		'keywords'		 => ['tools', 'cta', 'reade', 'theme', TEXTDOMAIN],
		'supports'      => ['align' => false]
	]);

	/**
	 * Vertical Accordion
	 */

	acf_register_block([
		'name'			 => 'vertical-accordion',
		'title'			 => 'Vertical Accordion',
		'render_template'	=> get_stylesheet_directory() . "/template-parts/blocks/vertical-accordion.php",
		'category'		 => 'theme-blocks',
		'icon'			 => 'button',
		'mode'			 => $mode,
		'keywords'		 => ['vertical', 'accordion', 'reade', 'theme', TEXTDOMAIN],
		'supports'      => ['align' => false]
	]);
}


function theme_register_blocks_style()
{
   if (function_exists('register_block_style')) {
      // register_block_style( 
      //    'core/group', 
      //    array( 
      //       'name' =>'blue-bg', 
      //       'label'=> __('Blue Background', TEXTDOMAIN), 
      // 'is_default'   => false, // 'inline_style' => '.wp-block-group.is-style-blue-wave', 
      //    ) 
      // );
   }
}
add_action('acf/init', 'theme_register_blocks_style');
