<?php
/* https://awhitepixel.com/blog/wordpress-menu-walkers-tutorial/
/* https://developer.wordpress.org/reference/classes/walker_nav_menu/

- start_lvl — Starts the list before the elements are added.
- start_el — Starts the element output.
- end_el — Ends the element output, if needed.
- end_lvl — Ends the list of after the elements are added.
/*/
//TODO
class Theme_Menu_Walker extends Walker_Nav_Menu {
   // function start_lvl(&$output, $depth=0, $args=null) {  }
   
   function start_el(&$output, $item, $depth=0, $args=null, $id=0) {
		$output .= "<li class='" .  implode(" ", $item->classes) . "'>";
 
		if ($item->url && $item->url != '#') {
			if (in_array('external-link', $item->classes)) {
				$output .= '<a class="header-link" href="' . $item->url . '" target="_blank">';
			} else {
				$output .= '<a class="header-link" href="' . $item->url . '">';
			}
		} else {
			$output .= '<span class="header-span">';
		}
		// if($item->description) {
			$output .= '<span class="link-title">'.$item->title.'</span>';
		// } else {
		// 	$output .= $item->title;
		// }
		
		//TODO
		// if (in_array('btn', $item->classes)) {
		// 	$output .= svg('arrow-right', false);
		// }
		
		
		if ($args->show_carets && ($args->walker->has_children || in_array('menu-item-has-children', $item->classes))) {
         $output .= '<svg class="svg-caret" aria-hidden="true" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" clip-rule="evenodd" d="M4.6762 5.87832C4.45158 6.0889 4.4402 6.4417 4.65078 6.66631L7.86704 10.097C7.97243 10.2094 8.11965 10.2732 8.27375 10.2732C8.42784 10.2732 8.57506 10.2094 8.68046 10.097L11.8967 6.66631C12.1073 6.4417 12.0959 6.0889 11.8713 5.87832C11.6467 5.66774 11.2939 5.67912 11.0833 5.90374L8.27375 8.9006L5.46419 5.90374C5.25361 5.67912 4.90082 5.66774 4.6762 5.87832Z" fill="#003C71"/> </svg> ';
		}
      
		// if($item->description) {
		// 	$output .= '<span class="link-descr">' . wp_trim_words($item->description, 10) . '</span>';
		// }
 
		if ($item->url && $item->url != '#') {
			$output .= '</a>';
		} else {
			$output .= '</span>';
		}
	}
   
   // function end_el(&$output, $item, $depth=0, $args=null, $id=0) { 
	// 	if($item->menu_item_parent != "0") {
	// 		$output .= "<div class='sub-menu-side'></div>";
	// 	}
	// }
	
   // function end_lvl(&$output, $depth=0, $args=null) { 
	// 	// error_log(json_encode($output, JSON_PRETTY_PRINT));//debug
	// }
   
   // function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output) { }
}