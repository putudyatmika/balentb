<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Bli Mika - I Putu Dyatmika <pdyatmika@gmail.com>">
	<meta name="language" content="id,en" />
   <link rel="shortcut icon" href="<?php echo $url; ?>/img/bps.ico">

   <title>Monitoring Kegiatan BPS Provinsi NTB (balentb)</title>

    <!-- Bootstrap core CSS -->
    <!--<link href="css/normalize.css" rel="stylesheet">-->
	<link href="<?php echo $url; ?>/addons/bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo $url; ?>/addons/validator/css/bootstrapValidator.min.css" rel="stylesheet">
    <!-- Add custom CSS here -->
  <link href="<?php echo $url; ?>/addons/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo $url; ?>/css/animate.css" rel="stylesheet" media="screen">
	<link href="<?php echo $url; ?>/css/bps.css" rel="stylesheet" media="screen">
	<link href="<?php echo $url; ?>/addons/datepicker/css/datepicker3.css" rel="stylesheet">

</head>

<body>
	<header id="header">
		<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo $url; ?>"><img src="<?php echo $url; ?>/images/logobpsntb.png" class="img-responsive" /></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo $url; ?>">DEPAN</a></li>
        <!--<li><a href="<?php echo $url; ?>/ranking/">RANKING</a></li>-->
        <li><a href="<?php echo $url; ?>/unitkerja/">UNITKERJA</a></li>
        <li><a href="<?php echo $url; ?>/kegiatan/">KEGIATAN</a></li>
		<li><a href="<?php echo $url; ?>/laporan/">LAPORAN</a></li>
    <?php if ($_SESSION['sesi_level']>=4) { ?><li><a href="<?php echo $url; ?>/master/">MASTER</a></li><?php } ?>
		<li class="dropdown">
              <a href="<?php echo $url; ?>/users/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">USERS (<?php echo $_SESSION['sesi_user_id']; ?>) <span class="caret"></span></a>
              <ul class="dropdown-menu">
			  <li><a href="<?php echo $url; ?>/users/">Profil</a></li>
                <li><a href="<?php echo $url; ?>/users/gantipasswd/">Ganti Password</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="<?php echo $url; ?>/logout/"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a></li>
              </ul>
            </li>
      </ul>
    </div>
  </div>
</nav>
</header>
