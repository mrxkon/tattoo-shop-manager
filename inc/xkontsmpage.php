<?php
///////////////////////
// Create Admin Page //
///////////////////////

function tattoo_shop_manager_admin_page() {
	$tsm_options = get_option( 'tattoo_shop_manager_options' );
	$today = date( 'Y-m-d' );
	$upcdate = $tsm_options['tattoo_shop_manager_upcappointmets_string'];
	$expirationdate = $tsm_options['tattoo_shop_manager_expirationdate_string'];
	$date1 = date( 'Y-m-d', strtotime( $today ) );
	$date2 = date( 'Y-m-d', strtotime( $today . "+$upcdate days" ) );
	$date3 = date( 'Y-m-d', strtotime( $today . "+$expirationdate days" ) );
	?>
	<div class="wrap">
		<h1>Tattoo Shop Manager</h1>
		<div id="dashboard-widgets-wrap">
			<div id="dashboard-widgets" class="metabox-holder">
				<div class="postbox-container">
					<div class="meta-box-sortables ui-sortable">
						<div class="postbox">
							<h2>
								<span><?php echo __( 'Forthcoming Appointments in the next', 'tattoo-shop-manager' ) . ' ' . $tsm_options['tattoo_shop_manager_upcappointmets_string'] . ' ' . __( 'Days', 'tattoo-shop-manager' ); ?></span>
							</h2>
							<hr/>
							<div class="inside">
								<div class="main">
									<?php
									$upcappointments = new WP_Query( array(
										'post_type' => 'tsm-appointments',
										'orderby' => 'meta_value',
										'meta_key' => 'tsm_appointment_meta_date',
										'order' => 'ASC',
										'posts_per_page' => '-1',
										'meta_query' => array(
											array(
												'key' => 'tsm_appointment_meta_date',
												'value' => array( $date1, $date2 ),
												'compare' => 'BETWEEN',
												'type' => 'DATE',
											),
										),
									) );
									echo '<table class="wp-list-table widefat fixed striped">';
									echo '<thead>';
									echo '<tr>';
									echo '<th><strong>';
									echo __( 'Title', 'tattoo-shop-manager' );
									echo '</strong></th>';
									echo '<th><strong>';
									echo __( 'Type', 'tattoo-shop-manager' );
									echo '</strong></th>';
									echo '<th><strong>';
									echo __( 'Date<br/>Time', 'tattoo-shop-manager' );
									echo '</strong></th>';
									echo '<th><strong>';
									echo __( 'Price', 'tattoo-shop-manager' );
									echo '</strong></th>';
									echo '</tr>';
									echo '</thead>';
									echo '<tbody>';
									while ( $upcappointments->have_posts() ) :
										$upcappointments->the_post();
										echo '<tr><td><a href="post.php?post=' . get_the_ID() . '&action=edit">';
										echo the_title();
										echo '</a></td>';
										echo '<td>';
										$upcapptax = get_the_terms( get_the_ID(), 'tsm-appointments-taxonomy' );
										$i = 0;
										$len = count( $upcapptax );
										foreach ( $upcapptax as $uptax ) {
											echo $uptax->name;
											if ( $i != $len - 1 ) {
												echo ', ';
											}
											$i++;
										}
										echo '</td>';
										echo '<td>' . date( 'd-M-Y', strtotime( get_post_meta( get_the_ID(), 'tsm_appointment_meta_date', true ) ) ) . '<br/>' . get_post_meta( get_the_ID(), 'tsm_appointment_meta_time', true ) . '</td>';
										echo '<td>' . $tsm_options['tattoo_shop_manager_currency_string'] . ' ' . get_post_meta( get_the_ID(), 'tsm_appointment_meta_price', true ) . '</td>';
									endwhile;
									echo '</tbody>';
									echo '</table>';
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="tsmrevenues" class="postbox-container">
					<div class="meta-box-sortables ui-sortable">
						<div class="postbox">
							<h2><span><?php echo __( 'Total Revenue', 'tattoo-shop-manager' ); ?></span></h2>
							<hr/>
							<div class="inside">
								<div class="main">
									<div class="ajxresponse">
										<!-- ajax content -->
									</div>
									<br/>
									<div id="major-publishing-actions">
										<div id="publishing-action">
											<form id="tsmrevenueform" action="" method="post">
												<table class="wp-list-table fixed updatetable">
													<tr>
														<td>
															<label for="strdate">From</label>
															<input type="text" name="strdate" id="strdate"/>
														</td>
														<td>
															<label for="enddate">To</label>
															<input type="text" name="enddate" id="enddate"/>
														</td>
													</tr>
													<tr>
														<td colspan="2">
															<input type="submit" name="refresh" id="refresh"
																	class="button button-primary button-large"
																	value="<?php echo __( 'Refresh', 'tattoo-shop-manager' ); ?>">
														</td>
													</tr>
												</table>
											</form>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="postbox-container">
					<div class="meta-box-sortables ui-sortable">
						<div id="luckyraffle" class="postbox">
							<h2><span><?php echo __( 'Lucky Raffle', 'tattoo-shop-manager' ); ?></span></h2>
							<hr/>
							<div class="inside">
								<div class="main">
									<form id="tsmluckyform" action="" method="post">
										<div id="minor-publishing-actions">
											<!-- ajax content -->
											<p class="tsmwinnerp"><?php echo __( 'Click the <strong>Draw!</strong> button to select one random winner from your clients to win a prize!', 'tattoo-shop-manager' ); ?></p>
										</div>
										<div id="major-publishing-actions">
											<div id="publishing-action">
												<input type="submit" name="draw" id="draw"
														class="button button-primary button-large"
														value="<?php echo __( 'Draw!', 'tattoo-shop-manager' ); ?>">
											</div>
											<div class="clear"></div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="tsm_info_box" class="postbox-container">
					<div class="meta-box-sortables ui-sortable">

						<div id="toexpire" class="postbox">
							<h2 class="h2red"><span><?php echo __( 'About To Expire', 'tattoo-shop-manager' ); ?></span>
							</h2>
							<hr/>
							<div class="inside">
								<div class="main">
									<h2><span><?php echo __( 'Inks', 'tattoo-shop-manager' ); ?></span></h2>
									<?php
									$inkexpires = new WP_Query( array(
										'post_type' => 'tsm-inks',
										'orderby' => 'meta_value',
										'meta_key' => 'tsm_ink_meta_expiration',
										'order' => 'ASC',
										'posts_per_page' => '-1',
										'meta_query' => array(
											array(
												'key' => 'tsm_ink_meta_expiration',
												'value' => array( $date1, $date3 ),
												'compare' => 'BETWEEN',
												'type' => 'DATE',
											),
										),
									) );
									echo '<table class="wp-list-table widefat fixed striped">';
									echo '<thead>';
									echo '<tr>';
									echo '<th><strong>';
									echo __( 'Name', 'tattoo-shop-manager' );
									echo '</strong></th>';
									echo '<th><strong>';
									echo __( 'Company', 'tattoo-shop-manager' );
									echo '</strong></th>';
									echo '<th><strong>';
									echo __( 'Expires on', 'tattoo-shop-manager' );
									echo '</strong></th>';
									echo '</tr>';
									echo '</thead>';
									echo '<tbody>';
									while ( $inkexpires->have_posts() ) :
										$inkexpires->the_post();
										echo '<tr><td><a href="post.php?post=' . get_the_ID() . '&action=edit">';
										echo the_title();
										echo '</a></td>';
										echo '<td>';
										$inkexptax = get_the_terms( get_the_ID(), 'tsm-inks-taxonomy' );
										$i = 0;
										$len = count( $inkexptax );
										foreach ( $inkexptax as $inktax ) {
											echo $inktax->name;
											if ( $i != $len - 1 ) {
												echo ', ';
											}
											$i++;
										}
										echo '</td>';
										echo '<td>' . date( 'd-M-Y', strtotime( get_post_meta( get_the_ID(), 'tsm_ink_meta_expiration', true ) ) ) . '</td>';
									endwhile;
									echo '</tbody>';
									echo '</table>';
									?>
									<hr/>
									<h2><span><?php echo __( 'Needles', 'tattoo-shop-manager' ); ?></span></h2>
									<?php
									$needleexpires = new WP_Query( array(
										'post_type' => 'tsm-needles',
										'orderby' => 'meta_value',
										'meta_key' => 'tsm_needle_meta_expiration',
										'order' => 'ASC',
										'posts_per_page' => '-1',
										'meta_query' => array(
											array(
												'key' => 'tsm_needle_meta_expiration',
												'value' => array( $date1, $date3 ),
												'compare' => 'BETWEEN',
												'type' => 'DATE',
											),
										),
									) );
									echo '<table class="wp-list-table widefat fixed striped">';
									echo '<thead>';
									echo '<tr>';
									echo '<th><strong>';
									echo __( 'Size & Type', 'tattoo-shop-manager' );
									echo '</strong></th>';
									echo '<th><strong>';
									echo __( 'Company', 'tattoo-shop-manager' );
									echo '</strong></th>';
									echo '<th><strong>';
									echo __( 'Expires on', 'tattoo-shop-manager' );
									echo '</strong></th>';
									echo '</tr>';
									echo '</thead>';
									echo '<tbody>';
									while ( $needleexpires->have_posts() ) :
										$needleexpires->the_post();
										echo '<tr><td><a href="post.php?post=' . get_the_ID() . '&action=edit">';
										echo the_title();
										echo '</a></td>';
										echo '<td>';
										$needleextax = get_the_terms( get_the_ID(), 'tsm-needles-taxonomy' );
										$i = 0;
										$len = count( $needleextax );
										foreach ( $needleextax as $needletax ) {
											echo $needletax->name;
											if ( $i != $len - 1 ) {
												echo ', ';
											}
											$i++;
										}
										echo '</td>';
										echo '<td>' . date( 'd-M-Y', strtotime( get_post_meta( get_the_ID(), 'tsm_needle_meta_expiration', true ) ) ) . '</td>';
									endwhile;
									echo '</tbody>';
									echo '</table>';
									?>
								</div>
							</div>
						</div>
						<div class="postbox">
							<h2>
								<span>Tattoo Shop Manager - <?php echo __( 'Information &amp; Settings', 'tattoo-shop-manager' ); ?></span>
							</h2>
							<hr/>
							<div class="inside">
								<div class="main">
									<hr/>
									<form method="post" action="options.php">
										<div id="minor-publishing-actions">
											<?php settings_fields( 'tattoo_shop_manager_options' ); ?>
											<?php do_settings_sections( 'tattoo-shop-manager' ); ?>
										</div>
										<div id="major-publishing-actions">
											<div id="publishing-action">
												<input type="submit" name="save" id="save"
														class="button button-primary button-large"
														value="<?php echo __( 'Save', 'tattoo-shop-manager' ); ?>">
											</div>
											<div class="clear"></div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		(function ( $ ) {

			$( document ).ready( function () {

				$( "#tsmluckyform" ).submit( function () {
					$.ajax( {
						type: 'POST',
						url: "<?php echo esc_js( admin_url( 'admin-ajax.php' ) ); ?>",
						crossDomain: true,
						dataType: 'html',
						data: {
							"action": "tattoo_shop_manager_draw_winner"
						},
						success: function ( response ) {
							$( ".tsmwinnerp" ).html( response );
							return false;
						}
					} );
					return false;
				} );

				$( "#tsmrevenueform" ).submit( function () {
					var strDate = $( '#strdate' ).val();
					var endDate = $( '#enddate' ).val();
					$.ajax( {
						type: 'POST',
						url: "<?php echo esc_js( admin_url( 'admin-ajax.php' ) ); ?>",
						crossDomain: true,
						dataType: 'html',
						data: {
							"action": "tattoo_shop_manager_fetch_revenues",
							"startDate": strDate,
							"endDate": endDate
						},
						success: function ( response ) {
							$( "#tsmrevenues .ajxresponse" ).html( response );
							return false;
						}
					} );
					return false;
				} );

			} );

		})( jQuery );
	</script>
	<?php
}
?>
