<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<?php $input_titles = ! empty( $instance['input_titles'] ) ? $instance['input_titles'] : 'labels'; ?>

<?php echo wp_kses( $args['before_widget'], wp_kses_allowed_html( 'post' ) ); ?>

<?php if ( ! empty( $instance['title'] ) ) : ?>
    <?php echo wp_kses( $args['before_title'], wp_kses_allowed_html( 'post' ) ); ?>
    <?php echo esc_attr( $instance['title'] ); ?>
    <?php echo wp_kses( $args['after_title'], wp_kses_allowed_html( 'post' ) ); ?>
<?php endif; ?>

<form method="get" action="<?php echo get_post_type_archive_link( 'property' ); ?>">
	<?php $skip = array(
		'filter-id', 'filter-location', 'filter-status', 'price-from', 'price-to', 'beds', 'baths', 'garages', 'area'
	); ?>

    <?php foreach ( $_GET as $key => $value ) : ?>
    	<?php if ( ! in_array( $key, $skip ) ) : ?>
        	<input type="hidden" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_html( $value ); ?>">
        <?php endif; ?>
    <?php endforeach; ?>

    <?php if ( empty( $instance['hide_property_id'] ) ) : ?>
		<!-- PROPERTY ID -->
		<div class="form-group">
				<?php if ( $input_titles == 'labels' ) : ?>
					<label for="<?php echo esc_attr( $args['widget_id'] ); ?>_property_id"><?php echo __( 'Property ID', 'realia' ); ?></label>
				<?php endif; ?>

			<input type="text" name="filter-id" class="form-control"
				   <?php if( $input_titles == 'placeholders' ) : ?>placeholder="<?php echo __( 'Property ID', 'realia' ); ?>"<?php endif; ?>
				   value="<?php echo ! empty( $_GET['filter-id']) ? $_GET['filter-id'] : ''; ?>"
                   id="<?php echo esc_attr( $args['widget_id'] ); ?>_property_id">
		</div><!-- /.form-group -->
	<?php endif; ?>

	<?php if ( empty( $instance['hide_location'] ) ) : ?>
		<!-- LOCATION -->
		<div class="form-group">
			<?php if ( $input_titles == 'labels' ) : ?>
				<label for="<?php echo esc_attr( $args['widget_id'] ); ?>_location"><?php echo __( 'Location', 'realia' ); ?></label>
			<?php endif; ?>

			<select name="filter-location" id="<?php echo esc_attr( $args['widget_id'] ); ?>_location">
				<option value="">
					<?php if ( $input_titles == 'placeholders' ) : ?>
						<?php echo __( 'Location', 'realia' ); ?>
					<?php else: ?>
						<?php echo __( 'All locations', 'realia' ); ?>
					<?php endif; ?>
				</option>

				<?php $locations = get_terms( 'locations', array(
					'hide_empty' 	=> false,
					'parent'		=> 0
				) ); ?>

				<?php if ( is_array( $locations ) ) : ?>
					<?php foreach ( $locations as $location ) : ?>
						<option value="<?php echo esc_attr( $location->term_id ); ?>" <?php if ( ! empty($_GET['filter-location'] ) && $_GET['filter-location'] == $location->term_id ) : ?>selected="selected"<?php endif; ?>><?php echo esc_html( $location->name ); ?></option>

						<?php $sublocations = get_terms( 'locations', array(
							'hide_empty' => false,
							'parent' => $location->term_id,
						) ); ?>

						<?php if ( is_array( $sublocations ) ) : ?>
							<?php foreach ( $sublocations as $sublocation ) : ?>
								<option value="<?php echo esc_attr( $sublocation->term_id ); ?>" <?php if ( ! empty($_GET['filter-location'] ) && $_GET['filter-location'] == $sublocation->term_id ) : ?>selected="selected"<?php endif; ?>>
									&raquo;&nbsp; <?php echo esc_html( $sublocation->name ); ?>
								</option>

								<?php $subsublocations = get_terms( 'locations', array(
									'hide_empty' 	=> false,
									'parent' 		=> $sublocation->term_id,
								) ); ?>

								<?php if ( is_array( $subsublocations ) ) : ?>
									<?php foreach ( $subsublocations as $subsublocation ) : ?>
										<option value="<?php echo esc_attr( $subsublocation->term_id ); ?>" <?php if ( ! empty($_GET['filter-location'] ) && $_GET['filter-location'] == $subsublocation->term_id ) : ?>selected="selected"<?php endif; ?>>
											&nbsp;&nbsp;&nbsp;&raquo;&nbsp; <?php echo esc_html( $subsublocation->name ); ?>
										</option>
									<?php endforeach; ?>
								<?php endif; ?>
							<?php endforeach; ?>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php endif; ?>
			</select>
		</div><!-- /.form-group -->
	<?php endif; ?>

	<?php if ( empty( $instance['hide_property_type'] ) ) : ?>
		<!-- PROPERTY TYPE -->
		<div class="form-group">
			<?php if ( $input_titles == 'labels' ) : ?>
				<label for="<?php echo esc_attr( $args['widget_id'] ); ?>_property_type"><?php echo __( 'Property type', 'realia' ); ?></label>
			<?php endif; ?>

			<select name="filter-property-type" id="<?php echo esc_attr( $args['widget_id'] ); ?>_property_type">
				<?php $property_types = get_terms( 'property_types', array( 'hide_empty' => false ) ); ?>
				<option value="">
					<?php if ( $input_titles == 'placeholders' ) : ?>
						<?php echo __( 'Property type', 'realia' ); ?>
					<?php else: ?>
						<?php echo __( 'All property types', 'realia' ); ?>
					<?php endif; ?>
				</option>

				<?php if ( is_array( $property_types ) ) : ?>
					<?php foreach ( $property_types as $property_type ) : ?>
						<option value="<?php echo esc_attr( $property_type->term_id ); ?>" <?php if ( ! empty( $_GET['filter-property-type'] ) && $_GET['filter-property-type'] == $property_type->term_id ) : ?>selected="selected"<?php endif; ?>><?php echo esc_html( $property_type->name ); ?></option>
					<?php endforeach ?>
				<?php endif; ?>
			</select>
		</div><!-- /.form-group -->
	<?php endif; ?>

	<?php if ( empty( $instance['hide_amenity'] ) ) : ?>
		<!-- AMENITY -->
		<div class="form-group">
			<?php if ( $input_titles == 'labels' ) : ?>
				<label for="<?php echo esc_attr( $args['widget_id'] ); ?>_property_type"><?php echo __( 'Amenity', 'realia' ); ?></label>
			<?php endif; ?>

			<select name="filter-property-type" id="<?php echo esc_attr( $args['widget_id'] ); ?>_property_type">
				<?php $amenities = get_terms( 'amenities', array( 'hide_empty' => false ) ); ?>
				<option value="">
					<?php if ( $input_titles == 'placeholders' ) : ?>
						<?php echo __( 'Amenity', 'realia' ); ?>
					<?php else: ?>
						<?php echo __( 'All amenities', 'realia' ); ?>
					<?php endif; ?>
				</option>

				<?php if ( is_array( $amenities ) ) : ?>
					<?php foreach ( $amenities as $amenity ) : ?>
						<option value="<?php echo esc_attr( $amenity->term_id ); ?>" <?php if ( ! empty( $_GET['filter-amenity'] ) && $_GET['filter-amenity'] == $amenity->term_id ) : ?>selected="selected"<?php endif; ?>><?php echo esc_html( $amenity->name ); ?></option>
					<?php endforeach ?>
				<?php endif; ?>
			</select>
		</div><!-- /.form-group -->
	<?php endif; ?>

	<?php if ( empty( $instance['hide_status'] ) ) : ?>
		<!-- STATUS TYPE-->
		<div class="form-group">
			<?php if ( $input_titles == 'labels' ) : ?>
				<label for="<?php echo esc_attr( $args['widget_id'] ); ?>_status"><?php echo __( 'Status', 'realia' ); ?></label>
			<?php endif; ?>

			<select name="filter-status" id="<?php echo esc_attr( $args['widget_id'] ); ?>_status">
				<?php $statuses = get_terms( 'statuses', array( 'hide_empty' => false ) ); ?>

				<option value="">
					<?php if ( $input_titles == 'placeholders' ) : ?>
						<?php echo __( 'Status', 'realia' ); ?>
					<?php else: ?>
						<?php echo __( 'All statuses', 'realia' ); ?>
					<?php endif; ?>
				</option>

				<?php if ( is_array( $statuses ) ) : ?>
					<?php foreach ( $statuses as $status ) : ?>
						<option value="<?php echo esc_attr( $status->term_id ); ?>" <?php if ( ! empty( $_GET['filter-status'] ) &&  $_GET['filter-status'] == $status->term_id ) : ?>selected="selected"<?php endif; ?>><?php echo esc_html( $status->name ); ?></option>
					<?php endforeach ?>
				<?php endif; ?>
			</select>
		</div><!-- /.form-group -->
	<?php endif; ?>

	<?php if ( empty( $instance['hide_contract'] ) ) : ?>
		<!-- CONTRACT -->
		<div class="form-group">
			<?php if ( $input_titles == 'labels' ) : ?>
				<label for="<?php echo esc_attr( $args['widget_id'] ); ?>_status"><?php echo __( 'Contract', 'realia' ); ?></label>
			<?php endif; ?>

			<select name="filter-contract" id="<?php echo esc_attr( $args['widget_id'] ); ?>_status">
				<option value=""><?php echo __( 'All contracts', 'realua' ); ?></option>
				<option value="<?php echo REALIA_CONTRACT_SALE; ?>" <?php if ( ! empty( $_GET['filter-contract'] ) &&  $_GET['filter-contract'] == REALIA_CONTRACT_SALE ) : ?>selected="selected"<?php endif; ?>><?php echo __( 'Sale', 'realia' ); ?></option>
				<option value="<?php echo REALIA_CONTRACT_RENT; ?>" <?php if ( ! empty( $_GET['filter-contract'] ) &&  $_GET['filter-contract'] == REALIA_CONTRACT_RENT ) : ?>selected="selected"<?php endif; ?>><?php echo __( 'Rent', 'realia' ); ?></option>
			</select>
		</div><!-- /.form-group -->
	<?php endif; ?>

	<?php if ( empty( $instance['hide_material'] ) ) : ?>
		<!-- STATUS TYPE-->
		<div class="form-group">
			<?php if ( $input_titles == 'labels' ) : ?>
				<label for="<?php echo esc_attr( $args['widget_id'] ); ?>_status"><?php echo __( 'Material', 'realia' ); ?></label>
			<?php endif; ?>

			<select name="filter-material" id="<?php echo esc_attr( $args['widget_id'] ); ?>_status">
				<?php $materials = get_terms( 'materials', array( 'hide_empty' => false ) ); ?>

				<option value="">
					<?php if ( $input_titles == 'placeholders' ) : ?>
						<?php echo __( 'Material', 'realia' ); ?>
					<?php else: ?>
						<?php echo __( 'All materials', 'realia' ); ?>
					<?php endif; ?>
				</option>

				<?php if ( is_array( $materials ) ) : ?>
					<?php foreach ( $materials as $material ) : ?>
						<option value="<?php echo esc_attr( $material->term_id ); ?>" <?php if ( ! empty( $_GET['filter-material'] ) &&  $_GET['filter-material'] == $status->term_id ) : ?>selected="selected"<?php endif; ?>><?php echo esc_html( $material->name ); ?></option>
					<?php endforeach ?>
				<?php endif; ?>
			</select>
		</div><!-- /.form-group -->
	<?php endif; ?>

	<?php if ( empty( $instance['hide_price'] ) ) : ?>
		<!-- PRICE -->
		<div class="form-group">
			<?php if ( $input_titles == 'labels' ) : ?>
				<label for="<?php echo esc_attr( $args['widget_id'] ); ?>_price_from"><?php echo __( 'Price from', 'realia' ); ?></label>
			<?php endif; ?>

			<input type="text" name="filter-price-from"
			       <?php if( $input_titles == 'placeholders' ) : ?>placeholder="<?php echo __( 'Price from', 'realia' ); ?>"<?php endif; ?>
			       class="form-control" value="<?php echo ! empty( $_GET['filter-price-from'] ) ? $_GET['filter-price-from'] : ''; ?>"
                   id="<?php echo esc_attr( $args['widget_id'] ); ?>_price_from">
		</div><!-- /.form-group -->

		<div class="form-group">
			<?php if ( $input_titles == 'labels' ) : ?>
				<label for="<?php echo esc_attr( $args['widget_id'] ); ?>_price_to"><?php echo __( 'Price to', 'realia' ); ?></label>
			<?php endif; ?>

			<input type="text" name="filter-price-to"
			       <?php if( $input_titles == 'placeholders' ) : ?>placeholder="<?php echo __( 'Price to', 'realia' ); ?>"<?php endif; ?>
			       class="form-control" value="<?php echo ! empty( $_GET['filter-price-to'] ) ? $_GET['filter-price-to'] : ''; ?>"
                   id="<?php echo esc_attr( $args['widget_id'] ); ?>_price_to">
		</div><!-- /.form-group -->
	<?php endif; ?>

	<?php if ( empty( $instance['hide_rooms'] ) ) : ?>
		<!-- ROOMS -->
		<?php if ( empty( $instance['hide_rooms'] ) ) : ?>
			<div class="form-group">
				<?php if ( $input_titles == 'labels' ) : ?>
					<label for="<?php echo esc_attr( $args['widget_id'] ); ?>_baths"><?php echo __( 'Rooms', 'realia' ); ?></label>
				<?php endif; ?>

				<input type="text" name="filter-baths"
				       <?php if( $input_titles == 'placeholders' ) : ?>placeholder="<?php echo __( 'Rooms', 'realia' ); ?>"<?php endif; ?>
				       class="form-control" value="<?php echo ! empty( $_GET['filter-rooms'] ) ? $_GET['filter-rooms'] : ''; ?>"
				       id="<?php echo esc_attr( $args['widget_id'] ); ?>_baths">
			</div><!-- /.form-group -->
		<?php endif; ?>
	<?php endif; ?>

	<?php if ( empty( $instance['hide_baths'] ) ) : ?>
		<!-- BATHS -->
		<div class="form-group">
			<?php if ( $input_titles == 'labels' ) : ?>
				<label for="<?php echo esc_attr( $args['widget_id'] ); ?>_baths"><?php echo __( 'Baths', 'realia' ); ?></label>
			<?php endif; ?>

			<input type="text" name="filter-baths"
				   <?php if( $input_titles == 'placeholders' ) : ?>placeholder="<?php echo __( 'Baths', 'realia' ); ?>"<?php endif; ?>
			       class="form-control" value="<?php echo ! empty( $_GET['filter-baths'] ) ? $_GET['filter-baths'] : ''; ?>"
                   id="<?php echo esc_attr( $args['widget_id'] ); ?>_baths">
		</div><!-- /.form-group -->
	<?php endif; ?>

	<?php if ( empty( $instance['hide_beds'] ) ) : ?>
		<!-- BEDS -->
		<div class="form-group">
			<?php if ( $input_titles == 'labels' ) : ?>
				<label for="<?php echo esc_attr( $args['widget_id'] ); ?>_beds"><?php echo __( 'Beds', 'realia' ); ?></label>
			<?php endif; ?>

			<input type="text" name="filter-beds"
				   <?php if( $input_titles == 'placeholders' ) : ?>placeholder="<?php echo __( 'Beds', 'realia' ); ?>"<?php endif; ?>
				   class="form-control" value="<?php echo ! empty( $_GET['filter-beds'] ) ? $_GET['filter-beds'] : ''; ?>"
                   id="<?php echo esc_attr( $args['widget_id'] ); ?>_beds">
		</div><!-- /.form-group -->
	<?php endif;?>

	<?php if ( empty ( $instance['hide_area'] ) ) : ?>
		<!-- AREA -->
		<div class="form-group">
			<?php if ( $input_titles == 'labels' ) : ?>
				<label for="<?php echo esc_attr( $args['widget_id'] ); ?>_area"><?php echo __( 'Area', 'realia' ); ?></label>
			<?php endif; ?>

			<input type="text" name="filter-area"
				   <?php if( $input_titles == 'placeholders' ) : ?>placeholder="<?php echo __( 'Area', 'realia' ); ?>"<?php endif; ?>
				   class="form-control" value="<?php echo ! empty( $_GET['filter-area'] ) ? $_GET['filter-area'] : ''; ?>"
                   id="<?php echo esc_attr( $args['widget_id'] ); ?>_area">
		</div><!-- /.form-group -->
	<?php endif; ?>

	<?php if ( empty ( $instance['hide_garages'] ) ) : ?>
		<!-- GARAGES -->
		<div class="form-group">
			<?php if ( $input_titles == 'labels' ) : ?>
				<label for="<?php echo esc_attr( $args['widget_id'] ); ?>_garages"><?php echo __( 'Garages', 'realia' ); ?></label>
			<?php endif; ?>

			<input type="text" name="filter-garages"
			       <?php if( $input_titles == 'placeholders' ) : ?>placeholder="<?php echo __( 'Garages', 'realia' ); ?>"<?php endif; ?>
			       class="form-control" value="<?php echo ! empty( $_GET['filter-garages'] ) ? $_GET['filter-garages'] : ''; ?>"
                   id="<?php echo esc_attr( $args['widget_id'] ); ?>_garages">
		</div><!-- /.form-group -->
	<?php endif; ?>

	<?php if ( ! empty( $instance['button_text'] ) ) : ?>
		<div class="form-group">
			<button class="btn"><?php echo esc_attr( $instance['button_text'] ); ?></button>
		</div><!-- /.form-group -->
	<?php endif; ?>
</form>

<?php echo wp_kses( $args['after_widget'], wp_kses_allowed_html( 'post' ) ); ?>
