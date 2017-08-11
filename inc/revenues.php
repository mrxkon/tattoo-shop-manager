<?php
function tattoo_shop_manager_fetch_revenues() {
	$tsm_options = get_option( 'tattoo_shop_manager_options' );

	$strDate = sanitize_text_field( $_POST['startDate'] );
	$endDate = sanitize_text_field( $_POST['endDate'] );

	if ( ! preg_match( '/^[0-9]{4}-[0-9]{2}-[0-9]{2}\s[0-9]{2}:[0-9]{2}:[0-9]{1}\z/', $strDate ) || ! preg_match( '/^[0-9]{4}-[0-9]{2}-[0-9]{2}\s[0-9]{2}:[0-9]{2}:[0-9]{1}\z/', $endDate ) ) {
		echo '<span style="color:red">' . __( 'Please use a correct date format', 'tattoo-shop-manager' ) . '</span><br/>';
		die();
	}
	?>
	<h2><?php echo __( 'Revenue Per Appoinment Type', 'tattoo-shop-manager' ); ?></h2>
	<table id="apprevenuetable" class="wp-list-table widefat fixed striped">
		<thead>
		<tr>
			<th><strong><?php echo __( 'Type', 'tattoo-shop-manager' ); ?></strong></th>
			<th><strong><?php echo __( 'Total', 'tattoo-shop-manager' ); ?></strong></th>
		</tr>
		</thead>
		<tbody>
		<?php
		$apptypes = get_terms( array(
			'taxonomy' => 'tsm-appointments-taxonomy',
			'hide_empty' => false,
		) );
		foreach ( $apptypes as $apptype ) {
			echo '<tr>';
			echo '<td>';
			echo $apptype->name;
			echo '</td>';
			echo '<td>';

			$aptrev = new WP_Query( array(
				'post_type' => 'tsm-appointments',
				'posts_per_page' => '-1',
				'tax_query' => array(
					array(
						'taxonomy' => 'tsm-appointments-taxonomy',
						'field' => 'term_id',
						'terms' => array( $apptype->term_id ),
					),
				),
				'meta_query' => array(
					array(
						'key' => 'tsm_appointment_meta_date',
						'value' => array( $strDate, $endDate ),
						'compare' => 'BETWEEN',
						'type' => 'DATE',
					),
				),
			) );
			$tposts_ids = wp_list_pluck( $aptrev->posts, 'ID' );
			$ttotalrev = 0;
			foreach ( $tposts_ids as $tpost_id ) {
				$tprice = get_post_meta( $tpost_id, 'tsm_appointment_meta_price', true );
				$ttotalrev += $tprice;
			}
			echo $tsm_options['tattoo_shop_manager_currency_string'] . ' ' . $ttotalrev;
			echo '</td>';
			echo '</tr>';
		}
		?>
		</tbody>
	</table>
	<hr/>
	<h2><?php echo __( 'Revenue Per Employee', 'tattoo-shop-manager' ); ?></h2>
	<table id="emprevenuetable" class="wp-list-table widefat fixed striped">
		<thead>
		<tr>
			<th><strong><?php echo __( 'Name', 'tattoo-shop-manager' ); ?></strong></th>
			<th><strong><?php echo __( 'Total', 'tattoo-shop-manager' ); ?></strong></th>
		</tr>
		</thead>
		<tbody>
		<?php
		$revEmployees = new WP_Query(
			array(
				'post_type' => 'tsm-employees',
			)
		);
		$revEmployeesID = wp_list_pluck( $revEmployees->posts, 'ID' );
		foreach ( $revEmployeesID as $revemp ) {
			echo '<tr>';
			echo '<td>';
			echo get_the_title( $revemp );
			echo '</td>';
			echo '<td>';

			$trev = new WP_Query( array(
				'post_type' => 'tsm-appointments',
				'orderby' => 'meta_value',
				'order' => 'ASC',
				'posts_per_page' => '-1',
				'meta_query' => array(
					array(
						'key' => 'tsm_appointment_meta_artist',
						'value' => array( $revemp ),
					),
					array(
						'key' => 'tsm_appointment_meta_date',
						'value' => array( $strDate, $endDate ),
						'compare' => 'BETWEEN',
						'type' => 'DATE',
					),
				),
			) );
			$posts_ids = wp_list_pluck( $trev->posts, 'ID' );
			$totalrev = 0;
			foreach ( $posts_ids as $post_id ) {
				$price = get_post_meta( $post_id, 'tsm_appointment_meta_price', true );
				$totalrev += $price;
			}
			echo $tsm_options['tattoo_shop_manager_currency_string'] . ' ' . $totalrev;
			echo '</td>';
			echo '</tr>';
		}
		?>
		</tbody>
	</table>
	<?php
	die( 1 );
}

add_action( 'wp_ajax_nopriv_tattoo_shop_manager_fetch_revenues', 'tattoo_shop_manager_fetch_revenues' );
add_action( 'wp_ajax_tattoo_shop_manager_fetch_revenues', 'tattoo_shop_manager_fetch_revenues' );
