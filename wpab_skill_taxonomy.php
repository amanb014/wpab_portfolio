<?php
function wpab_register_skill_taxonomy() {

	$s 	= 'Skill';
	$p 	= 'Skills';

	$labels = array (
		'name' => $p,
		'singular_name' => $s,
		'menu_name' => $p,
		'all_items' => 'All '.$p,
		'edit_item' => 'Edit '.$s,
		'view_item' => 'View '.$s,
		'update_item' => 'Update '.$s,
		'add_new_item' => 'Add New '.$s,
		'new_item_name' => 'New '.$s.' Name',
		'parent_name' => 'Parent '.$s,
		'search_items' => 'Search '.$p,
		'separate_items_with_commas' => 'Separate '.$p.'with commas',
		'add_or_remove_items' => 'Add or Remove '.$p
	);

	$args = array(
		'labels' => $labels,
		'pubic' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'description' => 'The skills used in an experience or project.',
		'show_admin_column' => true,
		'hierarchical' => true,
		'rewrite' => array('slug' => 'status'),
		'sort' => true
	);
	register_taxonomy('skill', null, $args);
}
add_action('init', 'wpab_register_skill_taxonomy');

?>