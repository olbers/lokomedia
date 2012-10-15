<?php
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus sekilas info
if ($module=='sekilasinfo' AND $act=='hapus'){
  mysql_query("DELETE FROM sekilasinfo WHERE id_sekilas='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input sekilas info
elseif ($module=='sekilasinfo' AND $act=='input'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    UploadInfo($nama_file);
    mysql_query("INSERT INTO sekilasinfo(info,
                                    tgl_posting,
                                    gambar) 
                            VALUES('$_POST[info]',
                                   '$tgl_sekarang',
                                   '$nama_file')");
  }
  else{
    mysql_query("INSERT INTO sekilasinfo(info,
                                    tgl_posting) 
                            VALUES('$_POST[info]',
                                   '$tgl_sekarang')");
  }
  header('location:../../media.php?module='.$module);
}

// Update sekilas info
elseif ($module=='sekilasinfo' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE sekilasinfo SET info = '$_POST[info]'
                             WHERE id_sekilas = '$_POST[id]'");
  }
  else{
    UploadInfo($nama_file);
    mysql_query("UPDATE sekilasinfo SET info = '$_POST[judul]',
                                   gambar    = '$nama_file'   
                             WHERE id_sekilas= '$_POST[id]'");
  }
  header('location:../../media.php?module='.$module);
}
?>
