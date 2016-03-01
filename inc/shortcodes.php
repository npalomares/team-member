<?
function ek_team_member_shortcode( $atts ) {
	extract( shortcode_atts( array(
		'orderby' => 'menu_order',
		'team_member_type' => '',
		'display' => 'excerpt'
	), $atts ) );

	$db_args = array(
		'post_type' => 'team_member',
		'order' => 'ASC', 
		'posts_per_page' => 12,
		'orderby' => $orderby,
		'team_member_type' => $team_member_type
	);

	$original_query = $wp_query;
	$tm_loop = new WP_Query( $db_args );

	if($tm_loop->have_posts()) {
		switch($display) {		
			case "content":
				$content .= "<div class=\"team_wrapper clearfix\">";
				while( $tm_loop->have_posts() ) : $tm_loop->the_post();
					$content_filtered = get_the_content();
					$content_filtered = apply_filters('the_content', $content_filtered);
					$content_filtered = str_replace(']]>', ']]&gt;', $content_filtered);
					$content .= "<div class=\"tm_single text-center col-sm-6 col-md-3\">";
					$content .= "<div class=\"tm_headshot\">".get_the_post_thumbnail()."</div>";

					$content .= "<h3 class=\"tm_title\">".get_the_title()."</h3>";

					$content .= "<div class=\"social-wrap\">";
					$content .= "<a href=\"#\" target=\"_blank\" class=\"social-link fb-link\">FB</a>";
					$content .= "<a href=\"#\" target=\"_blank\" class=\"social-link insta-link\">Insta</a>";
					$content .= "<a href=\"#\" target=\"_blank\" class=\"social-link web-link\">website</a>";
					$content .= "<a href=\"#\" target=\"_blank\" class=\"social-link email-link\">email</a>";
					$content .= "</div>";
					
					$content .= "<div class=\"tm_content\">$content_filtered</div>";
					$content .= "</div>";
				endwhile;
				$content .= "</div>";
				break;
			case "excerpt":
				$content .= "<div class=\"team_wrapper\">";
				while( $tm_loop->have_posts() ) : $tm_loop->the_post();
					$content .= "<div class=\"tm_single\">";
					$content .= "<h3 class=\"tm_title\"><a href=".get_permalink().">".get_the_title()."</a></h3>";
					$content .= "<div><span class=\"tm_excerpt\">".get_the_excerpt()."</span></div>";
					$content .= "</div>";
				endwhile;
				$content .= "</div>";
				break;
			case "list":
				$content .= "<ul class=\"tm_wrapper\">";
				while( $tm_loop->have_posts() ) : $tm_loop->the_post();
					$content .= "<li class=\"tm_single\">";
					$content .= "<span class=\"tm_title\"><a href=".get_permalink().">".get_the_title()."</a></span>";
					$content .= "</li>";
				endwhile;
				$content .= "</ul>";
				break;

			//apply accordion markup for the collapsing option
			case "accordion":
				$content .= "<div class=\"panel-group tm_wrapper\" id=\"accordion\">";

				$i = 0;
				while( $tm_loop->have_posts() ) : $tm_loop->the_post();
				
					if($i == 0) { $first = ""; } else { $first = ''; }
				
					$content_filtered = get_the_content();
					$content_filtered = apply_filters('the_content', $content_filtered);
					$content_filtered = str_replace(']]>', ']]&gt;', $content_filtered);
					
				    $content .= "<div class=\"panel panel-default\">";
					$content .= '<div class="panel-heading">';
					$content .= "<h3 class=\"panel-title\">";
					$content .= '<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$i.'">'.get_the_title();
					$content .= '</a>';					
					$content .= '</h3>';
					$content .= '</div>';
					$content .= '<div id="collapse'.$i.'" class="panel-collapse collapse '.$first.'">';
					$content .= "<div class=\"panel-body\">$content_filtered</div>";
					$content .= "</div></div>";
					$i++;
				endwhile;
				$content .= "</div>"; //close the panel-group
				break;
			//end case accordion

		}
			
	}
	$wp_query = null;
	$wp_query = $original_query;
	wp_reset_postdata();
	return $content;
				
}
add_shortcode( 'ek_team_member', 'ek_team_member_shortcode' );
