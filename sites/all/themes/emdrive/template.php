<?php

function emdrive_preprocess(&$variables, $hook) {
	drupal_add_js(drupal_get_path('theme', 'emdrive') . '/js/ng-infinite-scroll.min.js');
	drupal_add_css(drupal_get_path('theme', 'emdrive') . '/css/emdrive.css');
	drupal_add_js('//ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular-sanitize.js', 'external');	
	angularjs_init_application('emdrive');
	drupal_add_js(drupal_get_path('theme', 'emdrive') . '/js/emdrive.js');

	if(($hook == 'region' || $hook == 'block') && $variables['is_front'] == true) {
		$variables['theme_hook_suggestions'][] = $hook . '__front';
	}
	
	$alias = drupal_get_path_alias($_GET['q']);
	if ($alias != $_GET['q']) {
		$paths = explode('/', $alias);
		$path_part = $paths[0];
		if($path_part == 'home') {
			$template_filename = $hook;
			$template_filename .= '__' . str_replace('-', '_', $path_part);
			$variables['theme_hook_suggestions'][] = $template_filename;
		}
	}
}
