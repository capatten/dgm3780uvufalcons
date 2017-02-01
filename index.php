<!DOCTYPE html>
<html>
	<head>
		<title>Facebook Login JavaScript Example</title>
		<meta charset="UTF-8">
		<meta property="og:url" 		content="https://omniru.com/3780/group-p1/" />
		<meta property="og:type"        content="Example" />
		<meta property="og:title"       content="UVU Falcons Are Awesome" />
		<meta property="og:description" content="We Love Calvin and Hobbs" />
		<meta property="og:image"       content="http://currentsurroundings.com/content/random/calvin-hobbes/large/calvin_and_hobbes_006.jpg" />
	</head>
	<body>
        
        
        
        <!-- facebook Sharing button script -->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=590347651155605";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    
    <!-- Facebook Sharing button -->
        <div class="fb-share-button" data-href="https://omniru.com/3780/group-p1/" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div>
    
        
        
        
        
		<div id="fb-root"></div>
		<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
		<script>

			(function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s); js.id = id;
					js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=590347651155605";
					fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));



			function statusChangeCallback(response) {
				console.log('statusChangeCallback');
				console.log(response);
				// The response object is returned with a status field that lets the
				// app know the current login status of the person.
				// Full docs on the response object can be found in the documentation
				// for FB.getLoginStatus().
				if (response.status === 'connected') {
					// Logged into your app and Facebook.
					testAPI();
				} else if (response.status === 'not_authorized') {
					// The person is logged into Facebook, but not your app.
					document.getElementById('status').innerHTML = 'Please log ' +
					'into this app.';
				} else {
					// The person is not logged into Facebook, so we're not sure if
					// they are logged into this app or not.
					document.getElementById('status').innerHTML = 'Please log ' +
					'into Facebook.';
				}
			}


			function checkLoginState() {
	
				FB.getLoginStatus(function(response) {
						statusChangeCallback(response);
					});
			}
			
			
			function logoutFacebook() {
				FB.logout(function(response) {
						// Person is now logged out
					});
			}

			window.fbAsyncInit = function() {
				FB.init({
						appId      : '{590347651155605}',
						cookie     : true,  // enable cookies to allow the server to access 
						// the session
						xfbml      : true,  // parse social plugins on this page
						version    : 'v2.8' // use graph api version 2.8
					});

				// Now that we've initialized the JavaScript SDK, we call 
				// FB.getLoginStatus().  This function gets the state of the
				// person visiting this page and can return one of three states to
				// the callback you provide.  They can be:
				//
				// 1. Logged into your app ('connected')
				// 2. Logged into Facebook, but not your app ('not_authorized')
				// 3. Not logged into Facebook and can't tell if they are logged into
				//    your app or not.
				//
				// These three cases are handled in the callback function.

				FB.getLoginStatus(function(response) {
						statusChangeCallback(response);
					});
  
				

			};
  
			function testAPI() {
				console.log('Welcome!  Fetching your information.... ');
				FB.api('/me', function(response) {
						console.log('Successful login for: ' + response.name);
						document.getElementById('status').innerHTML =
						'Thanks for logging in, ' + response.name + '!';
						
						checkFBPermissions();
					});
			}
			
			function checkFBPermissions()
			{
				FB.api('/me/permissions', function(response) {
						var declined = [];
						for (i = 0; i < response.data.length; i++) { 
							if (response.data[i].status == 'declined') {
								declined.push(response.data[i].permission)
							}
						}
						//alert(declined.toString())
						var declinedString = declined.toString()
						//alert(declinedString);
						if (declinedString.indexOf("public_profile") == -1)
						{
							$(document).find('.fbPPP').html('<font color="lime">✓</font>')
						}
						else
						{
							$(document).find('.fbPPP').html('<font color="red">x</font>')
						}
						
						if (declinedString.indexOf("email") == -1)
						{
							$(document).find('.fbPE').html('<font color="lime">✓</font>')
						}
						else
						{
							$(document).find('.fbPE').html('<font color="red">x</font>')
						}
						
						if (declinedString.indexOf("user_friends") == -1)
						{
							$(document).find('.fbPUF').html('<font color="lime">✓</font>')
						}
						else
						{
							$(document).find('.fbPUF').html('<font color="red">x</font>')
						}
					});
			}
  
  
 
  

		</script>

		<!--<div class="fb-login-button" data-max-rows="1" data-size="medium" data-show-faces="true" data-auto-logout-link="true"></div>-->
		<div id="fbLoginContainer">
			<fb:login-button autologoutlink="true" scope="public_profile,email,user_friends" onlogin="checkLoginState();">
			</fb:login-button></div>
			
		<table>
			<tr>
				<th>Approved</th>
				<th>Permissions</th>
			</tr>
			<tr>
				<td class="fbPPP"></td><td>public_profile</td>
			</tr>
			<tr>
				<td class="fbPE"></td><td>email</td>
			</tr>
			<tr>
				<td class="fbPUF"></td><td>user_friends</td>
			</tr>
		</table>






		<br><br>

		<div id="status">
		</div>



		<br><br>
		
		<div id="shareBtn" class="btn btn-success clearfix"><button style="color:white; padding: 5px; border-style: solid; border-radius:5px; background-color:#0000ff; border-color:#0000ff; cursor: pointer; ">Share this page to facebook</button></div>
		<script>
			document.getElementById('shareBtn').onclick = function() {
				FB.ui({
						method: 'share',
						display: 'popup',
						href: 'https://omniru.com/3780/group-p1/',
					}, function(response){});
			}
		</script>
		
		

	</body>
</html>