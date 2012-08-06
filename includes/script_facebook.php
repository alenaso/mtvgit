	<div id="fb-root"></div> 
	<script type="text/javascript"> 
      window.fbAsyncInit = function() {
        FB.init({appId: '<?php echo $application_id; ?>', status: true, cookie: true, xfbml: true});
		/*try {
		FB.Canvas.setSize();
		} catch(e) {
		FB.Canvas.setSize({ width: 520, height: 800 });
		}*/
      };
      (function() {
        var e = document.createElement('script'); e.async = true;
        e.src = document.location.protocol +
          '//connect.facebook.net/en_US/all.js';
        document.getElementById('fb-root').appendChild(e);
      }());
    </script>
    <input type="hidden" id="shareFBLink" value="<?php echo $URL_SITE ?>" />
    <?php if(isset($user)) { ?>
    <input type="hidden" id="user_name" value="<?php echo $user->nombreCompleto ?>" />
    <?php } ?>
