<?
/**
* Page: MEMBER GOOGLE LOGIN PAGE
*
* @version  9.0
* @created  Sat 25 Oct  2008
* @related  /inc/func/func_login.php & func_login_page.php
*/
defined( 'KEY_ID' ) or die( 'Restricted access' );

?>
<script type="text/javascript">
function onSignIn(googleUser) {
	alert("hello");
	var profile = googleUser.getBasicProfile();
	console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
	console.log('Name: ' + profile.getName());
	console.log('Image URL: ' + profile.getImageUrl());
	console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
}
</script>