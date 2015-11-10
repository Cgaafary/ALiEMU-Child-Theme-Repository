<?php
 if ( is_user_logged_in() ) {
	$user = new WP_User( $user_ID );
	if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
		foreach ( $user->roles as $role )
			echo $role;
	}
}
?>
