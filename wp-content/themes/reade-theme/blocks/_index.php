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

// require_once get_stylesheet_directory() . '/blocks/blue-section/blue-section.php';
// require_once get_stylesheet_directory() . '/blocks/gutenpride-es5/gutenpride-es5.php';

add_action('acf/init', 'theme_register_blocks');
function theme_register_blocks()
{
	if (!function_exists('acf_register_block')) {
		return;
	}
	
	foreach([ //TODO autogenerate field group for new blocks
		'call-to-action',
		'page-hero',
	] as $label) {
		acf_register_block([ //TODO
			'name'			=> $label,
			'title'			=> implode(' ', array_map(function($w) {return ucfirst($w);}, explode('-', $label))),
			'render_template'	=> "blocks/$label.php",
			'category'		=> 'theme-blocks',
			'icon'			=> 'button',
			'mode'			=> 'edit',
			'keywords'		=> [$label, TEXTDOMAIN],
			'supports' => ['align' => false],
		]);
	}
}


function theme_register_blocks_style()
{
	if (function_exists('register_block_style')) {
		register_block_style( 
         'core/heading', 
         array( 
            'name' =>'heading-size-1', 
            'label'=> __('Size 1', TEXTDOMAIN), 
            // 'is_default'   => false, // 'inline_style' => '.wp-block-group.is-style-blue-wave', 
         ) 
      );
		register_block_style( 'core/heading', array( 'name'=>'heading-size-2','label'=> __('Size 1', TEXTDOMAIN)));
		register_block_style( 'core/heading', array( 'name'=>'heading-size-2','label'=> __('Size 2', TEXTDOMAIN)));
		register_block_style( 'core/heading', array( 'name'=>'heading-size-3','label'=> __('Size 3', TEXTDOMAIN)));
		register_block_style( 'core/heading', array( 'name'=>'heading-size-4','label'=> __('Size 4', TEXTDOMAIN)));
		register_block_style( 'core/heading', array( 'name'=>'heading-size-5','label'=> __('Size 5', TEXTDOMAIN)));
		register_block_style( 'core/heading', array( 'name'=>'heading-size-6','label'=> __('Size 6', TEXTDOMAIN)));
		register_block_style( 'core/paragraph', array( 'name'=>'paragraph-size-1','label'=> __('Size 1', TEXTDOMAIN)));
		register_block_style( 'core/paragraph', array( 'name'=>'paragraph-size-2','label'=> __('Size 2', TEXTDOMAIN)));
		register_block_style( 'core/paragraph', array( 'name'=>'paragraph-size-3','label'=> __('Size 3', TEXTDOMAIN)));
		register_block_style( 'core/paragraph', array( 'name'=>'paragraph-size-4','label'=> __('Size 4', TEXTDOMAIN)));
		register_block_style( 'core/paragraph', array( 'name'=>'paragraph-size-5','label'=> __('Size 5', TEXTDOMAIN)));
		register_block_style( 'core/paragraph', array( 'name'=>'paragraph-size-6','label'=> __('Size 6', TEXTDOMAIN)));
		register_block_style( 'core/paragraph', array( 'name'=>'paragraph-size-7','label'=> __('Size 6 test', TEXTDOMAIN)));
		register_block_style( 'core/group', array( 'name' =>'bg-themed', 'label'=> __(' Themed Background', TEXTDOMAIN), ) );
		register_block_style( 'core/cover', array( 'name' =>'wide', 'label'=> __('Wide', TEXTDOMAIN), ) );
		
		// register_block_style( 
      //    'core/group', 
      //    array( 
      //       'name' =>'blue-bg', 
      //       'label'=> __('Blue Background', TEXTDOMAIN), 
      //    ) 
      // );
	}
}
add_action('acf/init', 'theme_register_blocks_style');
