<?php
include "../config/koneksi.php";
include "../config/library.php";
include "../config/fungsi_indotgl.php";
include "../config/fungsi_combobox.php";
include "../config/class_paging.php";

// Bagian Home
if ($_GET[module]=='home'){
  echo "<h2>Selamat Datang</h2>
          <p>Hai <b>$_SESSION[namalengkap]</b>, selamat datang di halaman Administrator website Detikcom.<br> Silahkan klik menu pilihan yang berada 
          di sebelah kiri untuk mengelola content website. </p>
          <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
          <p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>";
}

// Bagian User
elseif ($_GET[module]=='profil'){
  if ($_SESSION[leveluser]=='admin'){
    include "modul/mod_profil/profil.php";
  }
}

// Bagian User
elseif ($_GET[module]=='user'){
  if ($_SESSION[leveluser]=='admin' OR $_SESSION[leveluser]=='user'){
    include "modul/mod_users/users.php";
  }
}

// Bagian Modul
elseif ($_GET[module]=='modul'){
  if ($_SESSION[leveluser]=='admin'){
    include "modul/mod_modul/modul.php";
  }
}

// Bagian Kategori
elseif ($_GET[module]=='kategori'){
  if ($_SESSION[leveluser]=='admin'){
    include "modul/mod_kategori/kategori.php";
  }
}

// Bagian Berita
elseif ($_GET[module]=='berita'){
  if ($_SESSION[leveluser]=='admin' OR $_SESSION[leveluser]=='user'){
    include "modul/mod_berita/berita.php";                            
  }
}

// Bagian Komentar Berita
elseif ($_GET[module]=='komentar'){
  if ($_SESSION[leveluser]=='admin'){
    include "modul/mod_komentar/komentar.php";
  }
}

// Bagian Tag
elseif ($_GET[module]=='tag'){
  if ($_SESSION[leveluser]=='admin'){
    include "modul/mod_tag/tag.php";
  }
}

// Bagian Agenda
elseif ($_GET[module]=='agenda'){
  if ($_SESSION[leveluser]=='admin' OR $_SESSION[leveluser]=='user'){
    include "modul/mod_agenda/agenda.php";
  }
}

// Bagian Banner
elseif ($_GET[module]=='banner'){
  if ($_SESSION[leveluser]=='admin'){
    include "modul/mod_banner/banner.php";
  }
}

// Bagian Poling
elseif ($_GET[module]=='poling'){
  if ($_SESSION[leveluser]=='admin'){
    include "modul/mod_poling/poling.php";
  }
}

// Bagian Download
elseif ($_GET[module]=='download'){
  if ($_SESSION[leveluser]=='admin'){
    include "modul/mod_download/download.php";
  }
}

// Bagian Hubungi Kami
elseif ($_GET[module]=='hubungi'){
  if ($_SESSION[leveluser]=='admin'){
    include "modul/mod_hubungi/hubungi.php";
  }
}

// Bagian Templates
elseif ($_GET[module]=='templates'){
  if ($_SESSION[leveluser]=='admin'){
    include "modul/mod_templates/templates.php";
  }
}

// Bagian Shoutbox
elseif ($_GET[module]=='shoutbox'){
  if ($_SESSION[leveluser]=='admin'){
    include "modul/mod_shoutbox/shoutbox.php";
  }
}

// Bagian Album
elseif ($_GET[module]=='album'){
  if ($_SESSION[leveluser]=='admin'){
    include "modul/mod_album/album.php";
  }
}

// Bagian Galeri Foto
elseif ($_GET[module]=='galerifoto'){
  if ($_SESSION[leveluser]=='admin'){
    include "modul/mod_galerifoto/galerifoto.php";
  }
}

// Bagian Sekilas Info
elseif ($_GET[module]=='sekilasinfo'){
  if ($_SESSION[leveluser]=='admin'){
    include "modul/mod_sekilasinfo/sekilasinfo.php";
  }
}

// Bagian Kata Jelek
elseif ($_GET[module]=='katajelek'){
  if ($_SESSION[leveluser]=='admin'){
    include "modul/mod_katajelek/katajelek.php";
  }
}

// Apabila modul tidak ditemukan
else{
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}
?>
