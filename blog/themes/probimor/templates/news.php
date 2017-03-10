<!DOCTYPE html>
<html lang="pt">
<head>
  <title>Probimor</title>
  <meta charset="UTF-8" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Facebook meta tag -->
  <meta property="og:title" content="Probimor">
  <meta property="og:site_name" content="Probimor">
  <link href="../css/bootstrap.min.css" rel="stylesheet" />
  <link href="../css/style.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/prettyPhoto.css" type="text/css" media="screen" />
  <link href="../css/font-awesome.min.css" rel="stylesheet" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css' />
  <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="75">
  <!-- Preloader -->
  <div class="mask"><div id="loader"></div></div>
  <!--/Preloader -->
  <!-- Home Section -->
  <div id="home">
    <!-- Navigation -->
    <div id="navigation" class="navbar navbar-fixed-top">
      <div class="navbar-inner ">
        <div class="container no-padding">
          <a class="show-menu" data-toggle="collapse" data-target=".nav-collapse">
            <span class="show-menu-bar"></span>
          </a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="menu-1"><a class="colapse-menu1" href="../../../../index.php#home">Home</a></li>
              <li class="menu-2"><a class="colapse-menu1" href="../../../../index.php#novidades">Notícias</a></li>
              <li class="menu-3"><a class="colapse-menu1" href="../../../../index.php#probimor">Empresa</a></li>
              <li class="menu-6"><a class="colapse-menu1" href="../../../../index.php#services">Serviços</a></li>
              <li class="menu-8"><a class="colapse-menu1"  href="../../../../index.php#contact-parallax">Contactos</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!--/Navigation -->
    <div class="home-pattern">
      <div class="container clearfix">
        <div id="home-center" class="element_fade_in">
          <div class="div-align-center">
            <img src="../images/logo1.png" align="center" />
            <div class="clearfix"></div>
            <div class="home">
              <nav class="navbar">
                <ul class="nav">
                  <li class="menu-1"><a class="colapse-menu1"  href="#novidades"><img src="../images/seta.png"></a></li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Home Section -->
    <!-- Portfolio -->
    <section id="novidades" class="content">
      <!-- Container -->
      <div class="container">
        <!-- Section Title -->
        <div class="section-title">
          <h1>Notícias</h1>
          <span class="border"></span>
          <?php

          // replace for your key sync
          $key_sync = '123456';
          // replace for your blog url
          $blog_url = 'http://localhost/probimorsitev2/blog/';
          //$blog_url = 'http://www.probimor.pt/blog/';

          $url = $blog_url.'bludit.php?sync='.$key_sync.'&other=latest';
          $timeout = 10;
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_HEADER, false);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
          $data = curl_exec($ch);
          curl_close($ch);

          if($data!==false)
          {
            $posts = json_decode($data, true);
            //$show_last_post = array_slice($posts, -2);
            //$show_penultimate_post = array_slice($posts, -1);
            //$posts_in_homepage = array($show_last_post, $show_penultimate_post);
            foreach($posts as $post){

              echo '<div class="column"><br><h4>';
                echo $post['title'];
                echo '</h4><br>';
                $excerpt = mb_substr($post['content'], 0, 350);
                echo $excerpt . '(...)';
                echo '<br>';
                echo '<br>';
                echo '<a href="blog/index.php?controller=post&action=view&id_post=' . $post['id'] . ' . #novidades " >Ler Mais</a>';
                echo '</div>';
              }
            }
            ?>


          </div>
          <!--/Section Title -->
        </div>
      </section>
      <!--/Novidades -->
      <div id="novidades-parallax" class="parallax" style="background-image: url('../images/separator4.jpg');" data-stellar-background-ratio="0.6" data-stellar-vertical-offset="20"></div>
      <!-- We Are Newave -->
      <div style = "background:white;" id="parallax3" class="parallax" data-stellar-background-ratio="0.6" data-stellar-vertical-offset="20">
        <div class="parallax-overlay white">
          <div class="container marcas">
            <h5>Com o Apoio:<span class="border"></span></h5>
            <img alt="se" src="../images/qren.jpg">
          </div>
        </div>
      </div>
      <!--/Contact Parralax -->
      <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js'></script>
      <script src="../js/jquery.sticky.js"></script>
      <script src="../js/jquery.easing-1.3.pack.js" type="text/javascript"></script>
      <script src="../js/bootstrap.min.js" type="text/javascript"></script>
      <script src="../js/jquery.parallax-1.1.3.js" type="text/javascript"></script>
      <script src="../js/appear.js" type="text/javascript" ></script>
      <script src="../js/modernizr.js" type="text/javascript"></script>
      <script src="../js/jquery.prettyPhoto.js" type="text/javascript"></script>
      <script src="../js/isotope.js" type="text/javascript"></script>
      <script src="../js/jquery.bxslider.min.js"></script>
      <script type="text/javascript" src="../js/jquery.tweet.js"></script>
      <script src="../js/jquery.cycle.all.js" type="text/javascript" charset="utf-8"></script>
      <script src="../js/jquery.maximage.js" type="text/javascript" charset="utf-8"></script>
      <script src="../js/sscr.js"></script>
      <script src="../js/skrollr.js"></script>
      <script src="../js/jquery.jigowatt.js"></script>
      <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
      <script src="../js/scripts.js" type="text/javascript"></script>
      <script type="text/javascript">
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-47600891-5', 'auto');
      ga('send', 'pageview');
      $(document).ready(function() {
        var initAuto = function(){
          if(slider.settings.autoDelay > 0){
            var timeout = setTimeout(el.startAuto, slider.settings.autoDelay);
          } else {
            el.startAuto();
          }
        }
      });
      </script>
    </body>
    </html>
