<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php if ( method_exists( 'Realia_Utilities', 'protect' ) ) { Realia_Utilities::protect(); } ?>


<form method="post" action="<?php the_permalink(); ?>" class="change-profile-form">
	<div class="form-group">
		<label><?php echo __( 'Nickname', 'realia' ); ?></label>
		<input type="text" name="nickname" class="form-control" value="<?php echo esc_attr( $data->nickname ); ?>" required="required">
	</div><!-- /.form-group -->

	<div class="form-group">
		<label><?php echo __( 'E-mail', 'realia' ); ?></label>
		<input type="email" name="email" class="form-control" value="<?php echo esc_attr( $user->user_email ); ?>"  required="required">
	</div><!-- /.form-group -->

	<div class="form-group">
		<label><?php echo __( 'First name', 'realia' ); ?></label>
		<input type="text" name="first_name" class="form-control" value="<?php echo esc_attr( $data->first_name ); ?>">
	</div><!-- /.form-group -->

	<div class="form-group">
		<label><?php echo __( 'Last name', 'realia' ); ?></label>
		<input type="text" name="last_name" class="form-control" value="<?php echo esc_attr( $data->last_name ); ?>">
	</div><!-- /.form-group -->

	<button type="submit" name="change_profile_form"><?php echo __( 'Change Profile', 'realia' ); ?></button>
</form>