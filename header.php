<!DOCTYPE html>
<html>
	<head>
		<title>Dave Perlman: Musician</title>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <link rel="icon" href="http://www.entertainmentmaine.com/wp-content/uploads/2017/03/icon.png">
      <link href="https://fonts.googleapis.com/css?family=Rokkitt:300" rel="stylesheet">
		<?php wp_head(); ?>
	</head>
	<body>
      <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=332585607099644";
         fjs.parentNode.insertBefore(js, fjs);
         }(document, 'script', 'facebook-jssdk'));
      </script>
		<header class="page-head">
      <a id='home-link' href="http://www.entertainmentmaine.com"></a>
      </header>
      <div class="container">
         <nav>
         <!-- mobile menu -->
            <input type="checkbox" id="menu-box">
            <label id="hamburger" for="menu-box">&#9776</label>
            <?php wp_nav_menu(); ?>
         </nav>
         <?php if( is_front_page() ): ?>
            <div class="slider">
               <?php echo do_shortcode('[slick-slider]'); ?>
            </div>
         <?php endif; ?>