<?php
function wpab_register_display_projects_shortcode($atts, $content = null) {
	//if one of the parameters is not defined from the shortcode, these are the defaults to be used.
	$atts = shortcode_atts( array(
		'pagination' => true,
		'count' => 7,
	), $atts );

	//Pagination is dependent on this.
	$paged = get_query_var('paged') ? get_query_var('paged') : 1;

	//The query for the post type, to get all the posts.
	$query_results = new WP_Query(
		array(
			'post_type' 		=> 'project',
			'post_status' 		=> 'publish',
			'orderby' 			=> 'meta_value',
			'meta-key' 			=> 'start_date',
			'order' 			=> 'ASC',
			'no_found_rows' 	=> false,
			'posts_per_page' 	=> $atts['count'],
			'paged' 			=> $paged,
			'tax_query' 		=> array(
										array(
											'taxonomy' => 'study_field',
											'field'    => 'slug',
											'terms'    => 'computer-science',
										),
									),
			)
	);

	// echo '<pre>';
	// var_dump($query_results);
	// echo '</pre>';

	$html_out = '<section id="projects">';

	if($query_results->have_posts()) {
		while($query_results->have_posts()) {

			$query_results->the_post();
			global $post;

			$my_excerpt = apply_filters('the_excerpt', get_the_excerpt());

			$html_out .= '<div class="projectItem">';
			$html_out .= '<div id="imageHolder"><img src="' . get_the_post_thumbnail_url() . '"\></div>';
			$html_out .= '<div id="skillsUsed">';
			$html_out .= '<h2>' . the_title('','',false) . '</h2>';
			$html_out .= '<h3>Skills Used</h3>';
			$html_out .= '<ul>';
			/* LOOP AND ADD THE LIST OF SKILLS USED in <li> */
			$html_out .= '</ul>';
			$html_out .= '</div>';
			$html_out .= '<div id="projectDesc">';
			$html_out .= '<p>' . $my_excerpt . '</p>';
			$html_out .= '</div>'; //close projectDesc
			$html_out .= '</div>'; //close projectItem
		}
	}

	else {
		$html_out .= '<p class="error">There are no projects for this study field.</p>';
	}
	$html_out .= '</section>';

	wp_reset_postdata();

	//Pagination if there are more than one page to be displayed. Pagination is always on, and the default number of items per page is 5. The user can set this number by defining "count" in the shortcode.
	if($query_results->max_num_pages > 1 && is_page()) {
		$html_out .= '<nav class="prev-next-posts">';
		$html_out .= '<div class="nav-previous">';
		$html_out .= get_next_posts_link('<span class="meta-nav">&larr;</span> Older', $query_results->max_num_pages);
		$html_out .= '</div>';
		$html_out .= '<div class="nav-next">';
		$html_out .= get_previous_posts_link('<span class="meta-nav">&rarr;</span> Newer');
		$html_out .= '</div>';
		$html_out .= '</nav>';
	}


	return $html_out;
}
add_shortcode('projectlist', 'wpab_register_display_projects_shortcode');


?>