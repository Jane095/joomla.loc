<form method="post" id="visual-form-builder-new-form" action="">
	<input name="action" type="hidden" value="create_form" />
    <?php
    	wp_nonce_field( 'create_form' );

    	if ( !current_user_can( 'manage_options' ) )
    		wp_die( __( 'Ошибка!', 'visual-form-builder' ) );
    ?>
	<h3><?php _e( 'Создайте форму' , 'visual-form-builder'); ?></h3>

	<table class="form-table">
		<tbody>
			<!-- Form Name -->
			<tr valign="top">
				<th scope="row"><label for="form-name"><?php _e( 'Название формы*' , 'visual-form-builder'); ?></label></th>
				<td>
					<input type="text" autofocus="autofocus" class="regular-text required" id="form-name" name="form_title" />
                </td>
			</tr>
			<!-- Sender Name -->
			<tr valign="top">
				<th scope="row"><label for="form-email-sender-name"><?php _e( 'Ваше имя*' , 'visual-form-builder'); ?></label></th>
				<td>
					<input type="text" value="" placeholder="" class="regular-text required" id="form-email-sender-name" name="form_email_from_name" />
                </td>
			</tr>
			<!-- Reply-to Email -->
			<tr valign="top">
				<th scope="row"><label for="form-email-from"><?php _e( 'Почта*' , 'visual-form-builder'); ?></label></th>
				<td>
					<input type="text" value="" placeholder="" class="regular-text required" id="form-email-from" name="form_email_from" />
                </td>
			</tr>
			<!-- Email Subject -->
			<tr valign="top">
				<th scope="row"><label for="form-email-subject"><?php _e( 'Тема письма*' , 'visual-form-builder'); ?></label></th>
				<td>
					<input type="text" value="" placeholder="" class="regular-text" id="form-email-subject" name="form_email_subject" />
                </td>
			</tr>
			<!-- E-mail To -->
			<tr valign="top">
				<th scope="row"><label for="form-email-to"><?php _e( 'Почта для данных' , 'visual-form-builder'); ?></label></th>
				<td>
					<input type="text" value="" placeholder="" class="regular-text" id="form-email-to" name="form_email_to[]" />
				</td>
			</tr>

		</tbody>
	</table>
	<?php submit_button( __( 'Создать форму', 'visual-form-builder' ) ); ?>
</form>