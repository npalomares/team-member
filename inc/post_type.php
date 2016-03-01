<?
function create_team_member() {
	$labels = array(
		'name'                => 'Team Member',
		'singular_name'       => 'Team Member',
		'menu_name'           => 'Team Member',
		'parent_item_colon'   => 'Parent Team Member:',
		'all_items'           => 'All Team Member',
		'view_item'           => 'View Team Member',
		'add_new_item'        => 'Add New Team Member',
		'add_new'             => 'New Team Member',
		'edit_item'           => 'Edit Team Member',
		'update_item'         => 'Update Team Member',
		'search_items'        => 'Search Team Member',
		'not_found'           => 'No team member found',
		'not_found_in_trash'  => 'No team member found in Trash',
	);

	$args = array(
		'label'               => 'team_member',
		'description'         => 'Team Member post type',
		'labels'              => $labels,
		'supports'            => array( 'title', 'excerpt', 'thumbnail', 'revisions', 'page-attributes', 'editor', 'custom-fields'),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'capability_type'     => 'page',
		//'menu_icon' => plugins_url( 'gm_icon_bw.png', __FILE__ ),
	);

	register_post_type( 'team_member', $args );
}

// Hook into the 'init' action
add_action( 'init', 'create_team_member', 0 );
?>