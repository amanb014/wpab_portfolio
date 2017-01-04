<?php

function wpab_project_metabox() {
	add_meta_box(
		'project_info',
		'Project Information',
		'wpab_project_info_output',
		'project',
		'normal',
		'core'
	);
}
add_action('add_meta_boxes', 'wpab_project_metabox');

function wpab_project_info_output($post) {
	wp_nonce_field(basename(__FILE__), 'wpab_project_nonce');

	$project = get_post_meta($post->ID);
?>

	<table class="form-table">
		<tr class="meta-row">
			<th class="meta-th" scope="row">Start Date</th>
			<td><input type="date" name="start_date" id="start_date" value="<?php if(!empty($project['start_date'])) echo esc_attr($project['start_date'][0]); ?>"\></td>
		</tr>

		<tr class="meta-row">
			<th class="meta-th" scope="row">End Date</th>
			<td><input type="date" name="end_date" id="end_date" value="<?php if(!empty($project['end_date'])) echo esc_attr($project['end_date'][0]); ?>"\></td>
		</tr>
	</table>

<?php
}

function wpab_project_info_save($post_id){

	$is_autosave = wp_is_post_autosave($post_id);
	$is_revision = wp_is_post_revision($post_id);
	$is_valid_nonce = (isset($_POST['wpab_project_nonce']) && wp_verify_nonce($_POST['wpab_project_nonce'], basename(__FILE__))) ? 'true' : 'false';

	if($is_autosave || $is_revision || !$is_valid_nonce) {
		return;
	}

	if(isset($_POST['start_date'])) {
		update_post_meta($post_id, 'start_date', sanitize_text_field($_POST['start_date']));
	}
	if(isset($_POST['end_date'])) {
		update_post_meta($post_id, 'end_date', sanitize_text_field($_POST['end_date']));
	}
}
add_action('save_post', 'wpab_project_info_save');

?>

