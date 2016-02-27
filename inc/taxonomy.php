<?
function team_member_categories_init() {
	register_taxonomy(
		'team_member_type',
		'team_member',
		array(
			'label' => __( 'Team Member Types' ),
			'rewrite' => array( 
				'slug' => 'team_member_type',
				'show_ui' => true,
			),
			'hierarchical' => true,
		)
	);
}
add_action( 'init', 'team_member_categories_init' );
?>