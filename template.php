<?php

/**
 * @file
 * This file is empty by default because the base theme chain (Alpha & Omega) provides
 * all the basic functionality. However, in case you wish to customize the output that Drupal
 * generates through Alpha & Omega this file is a good place to do so.
 * 
 * Alpha comes with a neat solution for keeping this file as clean as possible while the code
 * for your subtheme grows. Please read the README.txt in the /preprocess and /process subfolders
 * for more information on this topic.
 */

/**
 *	Implements template_preprocess_node().
 */ 
function wi_base_preprocess_node(&$vars) {
	 // Format the submission display information for article content
	 if ($vars['display_submitted'] && $vars['type'] == 'article') {
			$vars['submitted'] = format_date($vars['node']->created, 'custom', 'F jS, Y');
	 }
}

/**
 * Implements hook_process_zone().
 */
function wi_base_alpha_process_zone(&$vars) {
  $theme = alpha_get_theme();

  if ($vars['elements']['#zone'] == 'meta') {
    $vars['messages'] = $theme->page['messages'];
  }
}

/**
 * Implements theme_delta_blocks_logo().
 */
function wi_base_delta_blocks_logo(&$vars) {
  if ($vars['logo']) {
    $image = array(
      '#theme' => 'image',
      '#path' => $vars['logo'],
      '#alt' => $vars['site_name'],
    );
    $image = render($image);
    if ($vars['logo_linked']) {
      $options['html'] = TRUE;
      $options['attributes']['id'] = 'logo';
      $options['attributes']['title'] = $vars['site_name'];
      $image = l($image, '<front>', $options);
    }
    return '<div class="logo-img">' . $image . '</div>';
  }
}

/**
 *  Implements template_preprocess_search_result().
 */
function wi_base_preprocess_search_result(&$vars) {
  // Do not display publishing information in search results
  $vars['info'] = FALSE;
}
