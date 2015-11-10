<?php
/**
 * Displays the Educator Dashboard
 */

//Variable Declarations
$community_role = um_user('role_name');
$user_ID = get_current_user_id();
$residency_us_em = get_user_meta($user_ID, 'residency_us_em', 1);
?>
<div><p>My account type is <?php echo $community_role;?></p></div>
<div><p>My user ID is <?php echo $user_ID;?></p></div>
<div><p>My residency program is <?php echo $residency_us_em;?></p></div>
<?php

// The Query
$user_query = new WP_User_Query( );

// User Loop
if ( ! empty( $user_query->results ) ) {
	foreach ( $user_query->results as $user ) {
		echo '<p>' . $user->display_name . '</p>';
	}
} else {
	echo 'No users found.';
}

?>
