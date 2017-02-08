<?php
global $wpdb;

$field_where = ( isset( $field_id ) && !is_null( $field_id ) ) ? "AND field_id = $field_id" : '';
// Display all fields for the selected form
$fields = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $this->field_table_name WHERE form_id = %d $field_where ORDER BY field_sequence ASC", $form_nav_selected_id ) );

$depth = 1;
$parent = $last = 0;
ob_start();

// Loop through each field and display
foreach ( $fields as &$field ) :
	// If we are at the root level
	if ( !$field->field_parent && $depth > 1 ) {
		// If we've been down a level, close out the list
		while ( $depth > 1 ) {
			echo '</li></ul>';
			$depth--;
		}

		// Close out the root item
		echo '</li>';
	}
	// first item of <ul>, so move down a level
	elseif ( $field->field_parent && $field->field_parent == $last ) {
		echo '<ul class="parent">';
		$depth++;
	}
	// Close up a <ul> and move up a level
	elseif ( $field->field_parent && $field->field_parent != $parent ) {
		echo '</li></ul></li>';
		$depth--;
	}
	// Same level so close list item
	elseif ( $field->field_parent && $field->field_parent == $parent )
		echo '</li>';

	// Store item ID and parent ID to test for nesting
	$last = $field->field_id;
	$parent = $field->field_parent;
?>
<li id="form_item_<?php echo $field->field_id; ?>" class="form-item<?php echo ( in_array( $field->field_type, array( 'submit', 'secret', 'verification' ) ) ) ? ' ui-state-disabled' : ''; ?><?php echo ( !in_array( $field->field_type, array( 'fieldset', 'section', 'verification' ) ) ) ? ' mjs-nestedSortable-no-nesting' : ''; ?>">
<dl class="menu-item-bar vfb-menu-item-inactive">
	<dt class="vfb-menu-item-handle vfb-menu-item-type-<?php echo esc_attr( $field->field_type ); ?>">
		<span class="item-title"><?php echo stripslashes( esc_attr( $field->field_name ) ); ?><?php echo ( $field->field_required == 'yes' ) ? ' <span class="is-field-required">*</span>' : ''; ?></span>
        <span class="item-controls">
			<span class="item-type"><?php echo strtoupper( str_replace( '-', ' ', $field->field_type ) ); ?></span>
			<a href="#" title="<?php _e( 'Редактировать' , 'visual-form-builder'); ?>" id="edit-<?php echo $field->field_id; ?>" class="item-edit"><?php _e( 'Edit Field Item' , 'visual-form-builder'); ?></a>
		</span>
	</dt>
</dl>

<div id="form-item-settings-<?php echo $field->field_id; ?>" class="menu-item-settings field-type-<?php echo $field->field_type; ?>" style="display: none;">
<?php if ( in_array( $field->field_type, array( 'fieldset', 'section', 'verification' ) ) ) : ?>

	<p class="description description-wide">
		<label for="edit-form-item-name-<?php echo $field->field_id; ?>"><?php echo ( in_array( $field->field_type, array( 'fieldset', 'verification' ) ) ) ? 'Legend' : 'Name'; ?>
            <br />
			<input type="text" value="<?php echo stripslashes( esc_attr( $field->field_name ) ); ?>" name="field_name-<?php echo $field->field_id; ?>" class="widefat" id="edit-form-item-name-<?php echo $field->field_id; ?>" maxlength="255" />
		</label>
	</p>
    <p class="description description-wide">
        <label for="edit-form-item-css-<?php echo $field->field_id; ?>">
            <?php _e( 'CSS класс' , 'visual-form-builder'); ?>
            <br />
            <input type="text" value="<?php echo stripslashes( esc_attr( $field->field_css ) ); ?>" name="field_css-<?php echo $field->field_id; ?>" class="widefat" id="edit-form-item-css-<?php echo $field->field_id; ?>" />
        </label>
    </p>

<?php elseif( $field->field_type == 'instructions' ) : ?>
	<!-- Instructions -->
	<p class="description description-wide">
		<label for="edit-form-item-name-<?php echo $field->field_id; ?>">
				<?php _e( 'Название' , 'visual-form-builder'); ?>
                <br />
				<input type="text" value="<?php echo stripslashes( esc_attr( $field->field_name ) ); ?>" name="field_name-<?php echo $field->field_id; ?>" class="widefat" id="edit-form-item-name-<?php echo $field->field_id; ?>" maxlength="255" />
		</label>
	</p>
	<!-- Description -->
	<p class="description description-wide">
		<label for="edit-form-item-description-<?php echo $field->field_id; ?>">
        	<?php _e( '', 'visual-form-builder' ); ?>
            <br />
			<textarea name="field_description-<?php echo $field->field_id; ?>" class="widefat edit-menu-item-description" cols="20" rows="3" id="edit-form-item-description-<?php echo $field->field_id; ?>" /><?php echo stripslashes( $field->field_description ); ?></textarea>
		</label>
	</p>
	<!-- CSS Classes -->
<p class="description description-thin">
    <label for="edit-form-item-css-<?php echo $field->field_id; ?>">
        <?php _e( 'CSS класс' , 'visual-form-builder-pro'); ?>
        <br />
        <input type="text" value="<?php echo stripslashes( esc_attr( $field->field_css ) ); ?>" name="field_css-<?php echo $field->field_id; ?>" class="widefat" id="edit-form-item-css-<?php echo $field->field_id; ?>" />
    </label>
</p>

<!-- Field Layout -->
<p class="description description-thin">
	<label for="edit-form-item-layout">
		<?php _e( 'Расположение' , 'visual-form-builder-pro'); ?>
        <br />
		<select name="field_layout-<?php echo $field->field_id; ?>" class="widefat" id="edit-form-item-layout-<?php echo $field->field_id; ?>">

			<option value="" <?php selected( $field->field_layout, '' ); ?>><?php _e( 'По умолчанию' , 'visual-form-builder-pro'); ?></option>
            <optgroup label="------------">
            <option value="left-half" <?php selected( $field->field_layout, 'left-half' ); ?>><?php _e( 'Слева' , 'visual-form-builder-pro'); ?></option>
            <option value="right-half" <?php selected( $field->field_layout, 'right-half' ); ?>><?php _e( 'Справа' , 'visual-form-builder-pro'); ?></option>
            </optgroup>
            <?php apply_filters( 'vfb_admin_field_layout', $field->field_layout ); ?>
		</select>
	</label>
</p>

<?php else: ?>

	<!-- Name -->
	<p class="description description-wide">
		<label for="edit-form-item-name-<?php echo $field->field_id; ?>">
			<?php _e( 'Название' , 'visual-form-builder'); ?>
            <br />
			<input type="text" value="<?php echo stripslashes( esc_attr( $field->field_name ) ); ?>" name="field_name-<?php echo $field->field_id; ?>" class="widefat" id="edit-form-item-name-<?php echo $field->field_id; ?>" maxlength="255" />
		</label>
	</p>
	<?php if ( $field->field_type == 'submit' ) : ?>
		<!-- CSS Classes -->
        <p class="description description-wide">
            <label for="edit-form-item-css-<?php echo $field->field_id; ?>">
                <?php _e( 'CSS класс' , 'visual-form-builder'); ?>
                <br />
                <input type="text" value="<?php echo stripslashes( esc_attr( $field->field_css ) ); ?>" name="field_css-<?php echo $field->field_id; ?>" class="widefat" id="edit-form-item-css-<?php echo $field->field_id; ?>" />
            </label>
        </p>
	<?php elseif ( $field->field_type !== 'submit' ) : ?>
		<!-- Description -->
		<p class="description description-wide">
			<label for="edit-form-item-description-<?php echo $field->field_id; ?>">
				<?php _e( 'Описание' , 'visual-form-builder'); ?>
                 <br />
				<textarea name="field_description-<?php echo $field->field_id; ?>" class="widefat edit-menu-item-description" cols="20" rows="3" id="edit-form-item-description-<?php echo $field->field_id; ?>" /><?php echo stripslashes( $field->field_description ); ?></textarea>
			</label>
		</p>

		<?php
			// Display the Options input only for radio, checkbox, and select fields
			if ( in_array( $field->field_type, array( 'radio', 'checkbox', 'select' ) ) ) : ?>
			<!-- Options -->
			<p class="description description-wide">
				<?php _e( 'Пункт' , 'visual-form-builder'); ?>
                <br />
			<?php
				// If the options field isn't empty, unserialize and build array
				if ( !empty( $field->field_options ) ) {
					if ( is_serialized( $field->field_options ) )
						$opts_vals = ( is_array( unserialize( $field->field_options ) ) ) ? unserialize( $field->field_options ) : explode( ',', unserialize( $field->field_options ) );
				}
				// Otherwise, present some default options
				else
					$opts_vals = array( 'Пункт 1', 'Пункт 2', 'Пункт 3' );

				// Basic count to keep track of multiple options
				$count = 1;
?>
			<div class="vfb-cloned-options">
			<?php foreach ( $opts_vals as $options ) : ?>
			<div id="clone-<?php echo $field->field_id . '-' . $count; ?>" class="option">
				<label for="edit-form-item-options-<?php echo $field->field_id . "-$count"; ?>" class="clonedOption">
					<input type="radio" value="<?php echo esc_attr( $count ); ?>" name="field_default-<?php echo $field->field_id; ?>" <?php checked( $field->field_default, $count ); ?> />
					<input type="text" value="<?php echo stripslashes( esc_attr( $options ) ); ?>" name="field_options-<?php echo $field->field_id; ?>[]" class="widefat" id="edit-form-item-options-<?php echo $field->field_id . "-$count"; ?>" />
				</label>

				<a href="#" class="deleteOption vfb-interface-icon vfb-interface-minus" title="Delete Option">
					<?php _e( 'Удалить', 'visual-form-builder' ); ?>
				</a>
				<span class="vfb-interface-icon vfb-interface-sort" title="<?php esc_attr_e( '', 'visual-form-builder-pro' ); ?>"></span>
			</div>
			<?php
					$count++;
				endforeach;
			?>

			</div> <!-- .vfb-cloned-options -->
			<div class="clear"></div>
			<div class="vfb-add-options-group">
				<a href="#" class="vfb-button vfb-add-option" title="Add Option">
					<?php _e( 'Добавит пункт', 'visual-form-builder' ); ?>
					<span class="vfb-interface-icon vfb-interface-plus"></span>
				</a>
			</div>
			</p>
		<?php
			// Unset the options for any following radio, checkboxes, or selects
			unset( $opts_vals );
			endif;
		?>

		<?php if ( in_array( $field->field_type, array( 'file-upload' ) ) ) : ?>
        	<!-- File Upload Accepts -->
			<p class="description description-wide">
                <?php
				$opts_vals = array( '' );

				// If the options field isn't empty, unserialize and build array
				if ( !empty( $field->field_options ) ) {
					if ( is_serialized( $field->field_options ) )
						$opts_vals = ( is_array( unserialize( $field->field_options ) ) ) ? unserialize( $field->field_options ) : unserialize( $field->field_options );
				}

				// Loop through the options
				foreach ( $opts_vals as $options ) {
			?>
				<label for="edit-form-item-options-<?php echo $field->field_id; ?>">
					<?php _e( '' , 'visual-form-builder'); ?>
                    <br />
                    <input type="text" value="<?php echo stripslashes( esc_attr( $options ) ); ?>" name="field_options-<?php echo $field->field_id; ?>[]" class="widefat" id="edit-form-item-options-<?php echo $field->field_id; ?>" />
				</label>
            </p>
        <?php
				}
			// Unset the options for any following radio, checkboxes, or selects
			unset( $opts_vals );
			endif;
		?>

		<?php if ( in_array( $field->field_type, array( 'date' ) ) ) : ?>
	    	<!-- Date Format -->
			<p class="description description-wide">
				<?php
					$opts_vals = maybe_unserialize( $field->field_options );
					$dateFormat = ( isset( $opts_vals['dateFormat'] ) ) ? $opts_vals['dateFormat'] : 'mm/dd/yy';
				?>
				<label for="edit-form-item-date-dateFormat-<?php echo $field->field_id; ?>">
					<?php _e( 'Дата', 'visual-form-builder' ); ?>
					<br />
					<input type="text" value="<?php echo esc_attr( $dateFormat ); ?>" name="field_options-<?php echo $field->field_id; ?>[dateFormat]" class="widefat" id="edit-form-item-date-dateFormat-<?php echo $field->field_id; ?>" />
				</label>
	        </p>
		<?php
			// Unset the options for any following radio, checkboxes, or selects
			unset( $opts_vals );
			endif;
		?>
		<!-- Validation -->
		<p class="description description-thin">
			<label for="edit-form-item-validation">
				<?php _e( 'Проверка' , 'visual-form-builder'); ?>
                <br />

			   <?php if ( in_array( $field->field_type , array( 'text', 'time', 'number' ) ) ) : ?>
				   <select name="field_validation-<?php echo $field->field_id; ?>" class="widefat" id="edit-form-item-validation-<?php echo $field->field_id; ?>">
				   		<?php if ( $field->field_type == 'time' ) : ?>
						<option value="time-12" <?php selected( $field->field_validation, 'time-12' ); ?>><?php _e( '12 Hour Format' , 'visual-form-builder'); ?></option>
						<option value="time-24" <?php selected( $field->field_validation, 'time-24' ); ?>><?php _e( '24 Hour Format' , 'visual-form-builder'); ?></option>
						<?php elseif ( in_array( $field->field_type, array( 'number' ) ) ) : ?>
                        <option value="number" <?php selected( $field->field_validation, 'number' ); ?>><?php _e( 'Number' , 'visual-form-builder'); ?></option>
						<option value="digits" <?php selected( $field->field_validation, 'digits' ); ?>><?php _e( 'Digits' , 'visual-form-builder'); ?></option>
						<?php else : ?>
						<option value="" <?php selected( $field->field_validation, '' ); ?>><?php _e( 'None' , 'visual-form-builder'); ?></option>
						<option value="email" <?php selected( $field->field_validation, 'email' ); ?>><?php _e( 'Email' , 'visual-form-builder'); ?></option>
						<option value="date" <?php selected( $field->field_validation, 'date' ); ?>><?php _e( 'Date' , 'visual-form-builder'); ?></option>
						<option value="number" <?php selected( $field->field_validation, 'number' ); ?>><?php _e( 'Number' , 'visual-form-builder'); ?></option>
						<option value="digits" <?php selected( $field->field_validation, 'digits' ); ?>><?php _e( 'Digits' , 'visual-form-builder'); ?></option>
						<option value="phone" <?php selected( $field->field_validation, 'phone' ); ?>><?php _e( 'Phone' , 'visual-form-builder'); ?></option>
						<?php endif; ?>
				   </select>
			   <?php else :
				   $field_validation = '';

				   switch ( $field->field_type ) {
					    case 'email' :
						case 'phone' :
							$field_validation = $field->field_type;
						break;

						case 'number' :
							$field_validation = 'digits';
						break;
				   }

			   ?>
			   <input type="text" class="widefat" name="field_validation-<?php echo $field->field_id; ?>" value="<?php echo $field_validation; ?>" readonly="readonly" />
			   <?php endif; ?>

			</label>
		</p>

		<!-- Required -->
		<p class="field-link-target description description-thin">
			<label for="edit-form-item-required">
				<?php _e( 'Обязательный' , 'visual-form-builder'); ?>
                <br />
				<select name="field_required-<?php echo $field->field_id; ?>" class="widefat" id="edit-form-item-required-<?php echo $field->field_id; ?>">
					<option value="no" <?php selected( $field->field_required, 'no' ); ?>><?php _e( 'Нет' , 'visual-form-builder'); ?></option>
					<option value="yes" <?php selected( $field->field_required, 'yes' ); ?>><?php _e( 'Да' , 'visual-form-builder'); ?></option>
				</select>
			</label>
		</p>

			<!-- Field Layout -->
			<p class="description description-thin">
				<label for="edit-form-item-layout">
					<?php _e( 'Расположение' , 'visual-form-builder'); ?>
                    <br />
					<select name="field_layout-<?php echo $field->field_id; ?>" class="widefat" id="edit-form-item-layout-<?php echo $field->field_id; ?>">

						<option value="" <?php selected( $field->field_layout, '' ); ?>><?php _e( 'По умолчанию' , 'visual-form-builder'); ?></option>
                        <optgroup label="------------">
                        <option value="left-half" <?php selected( $field->field_layout, 'left-half' ); ?>><?php _e( 'Слева' , 'visual-form-builder'); ?></option>
                        <option value="right-half" <?php selected( $field->field_layout, 'right-half' ); ?>><?php _e( 'Спрва' , 'visual-form-builder'); ?></option>
                        </optgroup>
					</select>
				</label>
			</p>
		<?php if ( !in_array( $field->field_type, array( 'radio', 'select', 'checkbox', 'time', 'address' ) ) ) : ?>
		<!-- Default Value -->
		<p class="description description-wide">
            <label for="edit-form-item-default-<?php echo $field->field_id; ?>">
                <?php _e( 'Значение по умолчанию' , 'visual-form-builder'); ?>
                <br />
                <input type="text" value="<?php echo stripslashes( esc_attr( $field->field_default ) ); ?>" name="field_default-<?php echo $field->field_id; ?>" class="widefat" id="edit-form-item-default-<?php echo $field->field_id; ?>" maxlength="255" />
            </label>
		</p>
		<?php elseif( in_array( $field->field_type, array( 'address' ) ) ) : ?>
		<!-- Default Country -->
		<p class="description description-wide">
            <label for="edit-form-item-default-<?php echo $field->field_id; ?>">
                <?php _e( 'Страна' , 'visual-form-builder'); ?>
                <br />
                <select name="field_default-<?php echo $field->field_id; ?>" class="widefat" id="edit-form-item-default-<?php echo $field->field_id; ?>">
                <?php
                foreach ( $this->countries as $country ) {
					echo '<option value="' . $country . '" ' . selected( $field->field_default, $country, 0 ) . '>' . $country . '</option>';
				}
				?>
				</select>
            </label>
		</p>
		<?php endif; ?>
		<!-- CSS Classes -->
		<p class="description description-wide">
            <label for="edit-form-item-css-<?php echo $field->field_id; ?>">
                <?php _e( 'CSS класс' , 'visual-form-builder'); ?>
                <br />
                <input type="text" value="<?php echo stripslashes( esc_attr( $field->field_css ) ); ?>" name="field_css-<?php echo $field->field_id; ?>" class="widefat" id="edit-form-item-css-<?php echo $field->field_id; ?>" maxlength="255" />
            </label>
		</p>

	<?php endif; ?>
<?php endif; ?>

<?php if ( !in_array( $field->field_type, array( 'verification', 'secret', 'submit' ) ) ) : ?>
		<!-- Delete link -->
		<a href="<?php echo esc_url( wp_nonce_url( admin_url('admin.php?page=visual-form-builder&amp;action=delete_field&amp;form=' . $form_nav_selected_id . '&amp;field=' . $field->field_id ), 'delete-field-' . $form_nav_selected_id ) ); ?>" class="vfb-button vfb-delete item-delete submitdelete deletion">
			<?php _e( 'Удалить' , 'visual-form-builder'); ?>
			<span class="vfb-interface-icon vfb-interface-trash"></span>
		</a>
<?php endif; ?>

<input type="hidden" name="field_id[<?php echo $field->field_id; ?>]" value="<?php echo $field->field_id; ?>" />
</div>
<?php
endforeach;

// This assures all of the <ul> and <li> are closed
if ( $depth > 1 ) {
	while( $depth > 1 ) {
		echo '</li>
			</ul>';
		$depth--;
	}
}

// Close out last item
echo '</li>';
echo ob_get_clean();
