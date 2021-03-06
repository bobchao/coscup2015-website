<?php
$cachebusting = rand(0, 1000);
$assets_path = $home_path."assets/";
$current_path = rtrim($home_path.$this->current[0], "/") . "/";
?>
<!DOCTYPE html>
<html class="no-js">
<head>
  <?php include 'header.php' ?>
</head>
<body>
  <header id="header">
    <div class="wrap">
      <a id="logo" href="<?php echo $home_path;?>"><img src="<?php echo $assets_path;?>/images/logo.png"/>&nbsp;</a>
      <?php include 'navbar.php';?>
    </div>
  </header>

  <div id="content">
    <div class="main content thin wrap">
      <?php echo $transformed; ?>
    </div>
    <aside class="left aside">
    </aside>
    <aside class="right aside sponsers roll">
      <section>
        <div class="title">鑽石級贊助</div>
      </section>
      <section>
        <div class="title">黃金級贊助</div>
      </section>
      <section>
        <div class="title">白銀級贊助</div>
        <div class="sponser banner"><a href="http://www.archilife.org/"><img src="<?php echo $assets_path;?>/images/sponsor-archilife.jpg" alt="祐生研究基金會" /></a></div>
      </section>
      <section>
        <div class="title">青銅級贊助</div>
        <div class="sponser banner"><a href="http://www.wabow.com/"><img src="<?php echo $assets_path;?>/images/sponsor-wabow.jpg" alt="哇寶國際資訊" /></a></div>
      </section>
      <section>
        <div class="title">協辦單位</div>
      </section>
      <section>
        <div class="title">媒體夥伴</div>
      </section>
      <section>
        <div class="title">贊助 COSCUP</div>
        <p>如果您欲贊助 COSCUP，請與 <a href="mailto:sponsorship@coscup.org">sponsorship@coscup.org</a> 聯絡。</p>
      </section>
    </aside>
  </div>

  <footer id="footer">
    <div class="wrap">
    </div>
  </footer>
</body>
</html>
