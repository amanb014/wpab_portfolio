<?php

function wpab_register_cpt_experience() {

  $singular = 'Experience';
  $plural = 'Experiences';


  //All the labels that wordpress uses at several places. Plural name is used when needed. 
  $labels = array(
      'name'                => $plural,
      'singular_name'       => $singular,
      'add_name'            => 'Add New',
      'add_new_item'        => 'Add New ' . $singular,
      'edit'                => 'Edit',
      'edit_item'           => 'Edit ' . $singular,
      'new_item'            => 'New ' . $singular,
      'view'                => 'View ' . $singular,
      'view_item'           => 'View ' . $singular,
      'search_term'         => 'Search ' . $plural,
      'parent'              => 'Parent ' . $singular,
      'not_found'           => 'No ' . $plural . ' Found.',
      'not_found_in_trash'  => 'No ' . $plural . ' Found.',
      'all_items'           => 'All ' . $plural,
      'featured_image'      => $singular . ' Image',
      'set_featured_image'  => 'Set ' . $singular . ' Image',
      'remove_featured_image' => 'Remove ' . $singular . 'Image'
  );

  //Public means that everyone (admins) can access and edit the post type.
  //Shows in menu, and admin bar (to create)
  //supports the title (which is used for Book title), and thumbnail which is the book cover.
  $args = array(
      'labels' => $labels,
      'public' => true,
      'exclude_from_search' => false,
      'publicly_queryable' => true,
      'show_in_nav_menus' => true,
      'show_in_admin_bar' => true,
      'menu_position' => 25,
      'menu_icon' => 'dashicons-exerpt-view',
      'show_in_menu' => true,
      'delete_with_user' => false,
      'has_archive' => true,
      'query_var' => true,
      'capability_type' => 'page',
      'supports' => array(
        'title',
        'thumbnail',
        'revisions'
        ),
      'can_export' => true
  );

  //Registers the post type with wordpress
  //This keyword is really important for any other reference made to the post type in code. 
  register_post_type('experience', $args);
}

add_action('init', 'wpab_register_cpt_experience');

?>