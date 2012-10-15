<?php
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";

$module=$_GET[module];
$act=$_GET[act];

// Input kategori
if ($module=='kategori' AND $act=='input'){
  $kategori_seo = seo_title($_POST['nama_kategori']);
  mysql_query("INSERT INTO kategori(nama_kategori,kategori_seo) VALUES('$_POST[nama_kategori]','$kategori_seo')");
  header('location:../../media.php?module='.$module);
}

// Update kategori
elseif ($module=='kategori' AND $act=='update'){
  $kategori_seo = seo_title($_POST['nama_kategori']);
  mysql_query("UPDATE kategori SET nama_kategori='$_POST[nama_kategori]', kategori_seo='$kategori_seo', aktif='$_POST[aktif]' 
               WHERE id_kategori = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
?>
