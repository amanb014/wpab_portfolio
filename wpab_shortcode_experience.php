<?php

function wpab_register_shortcode_experience($atts, $content=null) {
	$atts = shortcode_atts( array(
	), $atts );

	$query_results = new WP_Query(
		array(
			'post_type' 		=> 'experience',
			'post_status' 		=> 'publish',
			'orderby' 			=> 'meta_value',
			'meta-key' 			=> 'start_date',
			'order' 			=> 'ASC',
			'no_found_rows' 	=> true,
			)
	);

	$html_out = '<section id="experience">';

	if($query_results->have_posts()) {
		while($query_results->have_posts()) {

			$query_results->the_post();
			global $post;

			$start_date = new DateTime(get_post_meta(get_the_ID(), 'start_date', true));
			$end_date = new DateTime(get_post_meta(get_the_ID(), 'end_date', true));

			$html_out .= '<div class="projectItem">';
			$html_out .= '<div id="skillsUsed">';
			$html_out .= '<h2 class="projectTitle">' . the_title('','',false) . '</h2>';
			$html_out .= '<h3>Skills Used</h3>';
			$html_out .= '<ul>';
				$i = 0;
				$skills = wp_get_post_terms(get_the_ID(), 'skill',
					array(
						'orderby' => 'name',
						'order' => 'DESC',
						'fields' => 'all'
					));

				foreach($skills as $s) {
					if($i <= 5) {
						$html_out .= '<li>' .  $s->name . '</li>';
					}
					$i++;
				};
			$html_out .= '</ul>';
			$html_out .= '</div>';
			$html_out .= '<div id="projectDesc">';
			$html_out .= '<h2 class="dates">' . $start_date->format('F Y') . ' - ' . $end_date->format('F Y') . '</h2>';
			$html_out .= '<p>' . get_the_content() . '</p>';
			$html_out .= '</div>'; //close projectDesc
			$html_out .= '<div id="expImage"><img src="' . get_the_post_thumbnail_url() . '"\></div>';
			$html_out .= '</div>'; //close projectItem
		}

	}
	else {
		$html_out .= 'Please check your shortcode for validation or check if you have saved any experiences.';
	}

	$html_out .= '</section>';
	return $html_out;
}
add_shortcode('experience', 'wpab_register_shortcode_experience');