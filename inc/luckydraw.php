<?php
function tattoo_shop_manager_draw_winner() {
	$query = new WP_Query(
		array(
			'post_type' => 'tsm-clients',
			'orderby' => 'rand',
			'posts_per_page' => 1,
		)
	);
	while ( $query->have_posts() ) :
		$query->the_post();
		echo '<span class="tsmwinner"><a href="post.php?post=' . get_the_ID() . '&action=edit">';
		echo the_title();
		echo '</a></span>';
	endwhile;
	die( 1 );
}

add_action( 'wp_ajax_nopriv_tattoo_shop_manager_draw_winner', 'tattoo_shop_manager_draw_winner' );
add_action( 'wp_ajax_tattoo_shop_manager_draw_winner', 'tattoo_shop_manager_draw_winner' );
