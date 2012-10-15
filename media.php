<?php 
  error_reporting(0);
  ob_start();	
  session_start();
  include "config/koneksi.php";
  include "config/fungsi_autolink.php";
  include "config/fungsi_badword.php";
  include "config/tgl_indo.php"; 
	include "config/class_paging.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<title><?php include "dina_titel.php"; ?></title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="index, follow">
<meta name="description" content="<?php include "dina_meta1.php"; ?>">
<meta name="keywords" content="<?php include "dina_meta2.php"; ?>">
<meta http-equiv="Copyright" content="lokomedia">
<meta name="author" content="Lukmanul Hakim">
<meta http-equiv="imagetoolbar" content="no">
<meta name="language" content="Indonesia">
<meta name="revisit-after" content="7">
<meta name="webcrawlers" content="all">
<meta name="rating" content="general">
<meta name="spiders" content="all">

<link rel="shortcut icon" href="favicon.ico" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="rss.xml" />

<link rel="stylesheet" href="css/style.css" type="text/css" />
 
<script src="js/jquery-1.4.js" type="text/javascript"></script>

<script src="js/superfish.js" type="text/javascript"></script>
<script src="js/hoverIntent.js" type="text/javascript"></script>
	<script type="text/javascript">
      $(document).ready(function(){
			   $('ul.nav').superfish();
		  });
  </script>

<script src="js/headline.js" type="text/javascript"></script>
  <script type="text/javascript"> 
      $(document).ready(function(){
	  		bukaContent($('#slideAwal'),'div1');			
	    });
	</script>	

<script src="js/jquery.fancybox.js" type="text/javascript"></script>
<script src="js/jquery.mousewheel.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("a#galeri").fancybox({
				'titlePosition'	: 'inside'
			});
		});
  </script>
	  
<script src="js/clock.js" type="text/javascript"></script>
<script src="js/tabs.js" type="text/javascript"></script>
<script src="js/newsticker.js" type="text/javascript"></script>
</head>

<body onload="startclock()">
	<div id="container">
		<div id="wrapper">
        <div id="top">
				<div class="logo"><a href="index.php"><span>CMS</span> LOKOMEDIA</a></div>
				<!-- motto -->
				<ul class="motto">
		        	<li class="left">&nbsp;</li>
		        	<li>CMS GRATIS UNTUK INDONESIA</li>
				</ul> <!-- / motto -->
		
		    </div> <!-- / top -->

      <!-- MENU -->
			<ul class="nav">
				<li class="left"></li>
				
      <?php
      function get_menu($data, $parent = 0) {
	      static $i = 1;
	      $tab = str_repeat(" ", $i);
	      if ($data[$parent]) {
		      $html = "$tab<ul class='sf-menu'>";
		      $i++;
		      foreach ($data[$parent] as $v) {
			       $child = get_menu($data, $v->id);
			       $html .= "$tab<li>";
			       $html .= '<a href="'.$v->url.'">'.$v->judul.'</a>';
			       if ($child) {
				       $i--;
				       $html .= $child;
				       $html .= "$tab";
			       }
			       $html .= '</li>';
		      }
		      $html .= "$tab</ul>";
		      return $html;
	      } 
        else {
		      return false;
	      }
      }
      $result = mysql_query("SELECT * FROM menu ORDER BY menu_order");
      while ($row = mysql_fetch_object($result)) {
	       $data[$row->parent_id][] = $row;
      }
      $menu = get_menu($data);
      echo "$menu"; 
      ?>
				<li class="sep">&nbsp;</li>
				<li class="right">&nbsp;</li>
			</ul>
			<!-- / End Menu -->

			<!-- HEADER -->
			<div id="header">
				<div class="intro">
				<p><span id="date"></span>, <span id="clock"></span></p>  <!-- jam -->
				<form method="POST" id="searchform" action="hasil-pencarian.html"> <!-- form pencarian -->
					<div>
					   <input class="searchField" type="text" name="kata" maxlength="50" value="Pencarian..." onblur="if(this.value=='') this.value='Pencarian...';" onfocus="if(this.value=='Pencarian...') this.value='';" />
					   <input class="searchSubmit" type="submit" value="" />
					</div>
				</form>
				<div class="rssicon">
				<a href="rss.xml" target="_blank"><img src="images/rss.png" border="0" /></a> <!-- icon rss -->
				</div>
				</div> <!-- / intro -->				
			</div> <!-- /header -->


			<!-- CONTENT -->
      <?php
          include "kiri.php";      
      ?>

			<!-- SIDEBAR -->
			<div id="sidebar">
				<h2>Sekilas Info</h2>
          <ul id="listticker">
            <?php
              $sekilas=mysql_query("SELECT * FROM sekilasinfo ORDER BY id_sekilas DESC LIMIT 5");
              while($s=mysql_fetch_array($sekilas)){
                echo "<li><img src='foto_info/kecil_$s[gambar]' width='54' height='54' />
                      <span class='news-text'>$s[info]</span></li>";
              }
            ?>
          </ul>

				<h2>Statistik User</h2>
          <ul id="listsidebar">
            <?php
              $ip      = $_SERVER['REMOTE_ADDR']; // Mendapatkan IP komputer user
              $tanggal = date("Ymd"); // Mendapatkan tanggal sekarang
              $waktu   = time(); // 

              // Mencek berdasarkan IPnya, apakah user sudah pernah mengakses hari ini 
              $s = mysql_query("SELECT * FROM statistik WHERE ip='$ip' AND tanggal='$tanggal'");
              // Kalau belum ada, simpan data user tersebut ke database
              if(mysql_num_rows($s) == 0){
                mysql_query("INSERT INTO statistik(ip, tanggal, hits, online) VALUES('$ip','$tanggal','1','$waktu')");
              } 
              else{
                mysql_query("UPDATE statistik SET hits=hits+1, online='$waktu' WHERE ip='$ip' AND tanggal='$tanggal'");
              }

              $pengunjung       = mysql_num_rows(mysql_query("SELECT * FROM statistik WHERE tanggal='$tanggal' GROUP BY ip"));
              $totalpengunjung  = mysql_result(mysql_query("SELECT COUNT(hits) FROM statistik"), 0); 
              $hits             = mysql_fetch_assoc(mysql_query("SELECT SUM(hits) as hitstoday FROM statistik WHERE tanggal='$tanggal' GROUP BY tanggal")); 
              $totalhits        = mysql_result(mysql_query("SELECT SUM(hits) FROM statistik"), 0); 
              $tothitsgbr       = mysql_result(mysql_query("SELECT SUM(hits) FROM statistik"), 0); 
              $bataswaktu       = time() - 300;
              $pengunjungonline = mysql_num_rows(mysql_query("SELECT * FROM statistik WHERE online > '$bataswaktu'"));

              $path = "counter/";
              $ext = ".png";

              $tothitsgbr = sprintf("%06d", $tothitsgbr);
              for ( $i = 0; $i <= 9; $i++ ){
	               $tothitsgbr = str_replace($i, "<img src='$path$i$ext' alt='$i'>", $tothitsgbr);
              }

              echo "<br /><p align=center>$tothitsgbr </p>
                    <table>
                    <tr><td class='news-title'><img src=counter/hariini.png> Pengunjung hari ini </td><td class='news-title'> : $pengunjung </td></tr>
                    <tr><td class='news-title'><img src=counter/total.png> Total pengunjung </td><td class='news-title'> : $totalpengunjung </td></tr>
                    <tr><td class='news-title'><img src=counter/hariini.png> Hits hari ini </td><td class='news-title'> : $hits[hitstoday] </td></tr>
                    <tr><td class='news-title'><img src=counter/total.png> Total Hits </td><td class='news-title'> : $totalhits </td></tr>
                    <tr><td class='news-title'><img src=counter/online.png> Pengunjung Online </td><td class='news-title'> : $pengunjungonline </td></tr>
                    </table>";
            ?>
          </ul>
          
					<h2>Polling</h2>
            <ul id="listsidebar">
              <?php
                echo "<br /><span class='news-title'> Pilih Browser Favorit Anda?</b> </span><br /><br />";
                echo "<form method=POST action='hasil-poling.html'>";

                $poling=mysql_query("SELECT * FROM poling WHERE aktif='Y'");
                while ($p=mysql_fetch_array($poling)){
                  echo "<span class='news-text'><input type=radio name=pilihan value='$p[id_poling]' />$p[pilihan]</span><br />";
                }
                echo "<p align=center><input type=submit value=vote /></p>
                      </form>
                      <a href=lihat-poling.html><span class='news-title2'>Lihat Hasil Poling</span></a>";
              ?>
            </ul><br />
            
            <?php
              // Tampilkan banner
              $banner=mysql_query("SELECT * FROM banner ORDER BY id_banner DESC LIMIT 1");
              while($b=mysql_fetch_array($banner)){
                  echo "<p align=center><a href=$b[url] target='_blank' title='$b[judul]'>
                        <img src='foto_banner/$b[gambar]' border='0'></a></p>";
              }
            ?>
			</div> <!-- / end sidebar -->

			<!-- FOOTER -->
			<div id="footer">
				<div class="foot_l"></div>
				<div class="foot_content">
				  <p>&nbsp;</p>
					<p>Copyright &copy; 2010 by bukulokomedia.com. All rights reserved.</p>
				</div>
				<div class="foot_r"></div>
			</div><!-- / end footer -->
		</div><!-- / end wrapper -->
	</div><!-- / end container -->
</body>
</html>
