<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-04-26 13:24:14 --> 404 Page Not Found: Images/logo-mini.svg
ERROR - 2021-04-26 13:24:50 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-26 13:24:57 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-26 13:25:04 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-26 14:39:37 --> Severity: Notice --> Undefined property: Retur_pembelian::$dt_model E:\xampp\htdocs\rsrm\system\core\Model.php 73
ERROR - 2021-04-26 14:39:37 --> Severity: error --> Exception: Call to a member function dt_get() on null E:\xampp\htdocs\rsrm\application\models\Retur_pembelian_model.php 37
ERROR - 2021-04-26 14:39:53 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-26 14:40:06 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 14:40:06 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 14:40:06 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 14:40:21 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-26 14:40:21 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 14:40:21 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 14:40:22 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 14:40:27 --> Severity: Notice --> Undefined variable: grandtotal_alias E:\xampp\htdocs\rsrm\application\views\transaksi\retur_pembelian\tb_retur_pembelian_form.php 99
ERROR - 2021-04-26 14:40:27 --> Severity: Notice --> Undefined variable: grandtotal_alias E:\xampp\htdocs\rsrm\application\views\transaksi\retur_pembelian\tb_retur_pembelian_form.php 99
ERROR - 2021-04-26 14:40:27 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 14:40:27 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 14:40:28 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 14:40:50 --> Severity: Notice --> Undefined variable: retur_pembelian E:\xampp\htdocs\rsrm\application\models\Retur_pembelian_model.php 46
ERROR - 2021-04-26 14:40:50 --> Severity: Notice --> Trying to get property 'id_retur_pembelian' of non-object E:\xampp\htdocs\rsrm\application\models\Retur_pembelian_model.php 46
ERROR - 2021-04-26 14:40:50 --> Severity: Notice --> Undefined variable: retur_pembelian E:\xampp\htdocs\rsrm\application\models\Retur_pembelian_model.php 48
ERROR - 2021-04-26 14:40:50 --> Severity: Notice --> Trying to get property 'id_retur_pembelian' of non-object E:\xampp\htdocs\rsrm\application\models\Retur_pembelian_model.php 48
ERROR - 2021-04-26 14:40:50 --> Query error: Column 'rasio' in field list is ambiguous - Invalid query: SELECT format(hrg_beli, 0) as hrg_beli, format(tb_retur_pembelian_detail.diskon, 0) as diskon, format(jumlah, 0) as jumlah, `tb_barang`.`nama` as `barang`, ifnull(satuan, "") as satuan, `tb_satuan`.`rasio`, format((hrg_beli-(hrg_beli*tb_barang.diskon/100))*jumlah*rasio, 0) as subtotal
FROM `tb_retur_pembelian`
JOIN `tb_retur_pembelian_detail` ON `tb_retur_pembelian_detail`.`no_transaksi` = `tb_retur_pembelian`.`no_transaksi`
JOIN `tb_barang` ON `tb_retur_pembelian_detail`.`barang_id` = `id_barang`
LEFT JOIN `tb_satuan` ON `tb_retur_pembelian_detail`.`satuan_id` = `id_satuan`
WHERE `id_retur_pembelian` = '1'
ORDER BY `id_retur_pembelian` DESC
ERROR - 2021-04-26 14:41:26 --> Query error: Column 'rasio' in field list is ambiguous - Invalid query: SELECT format(hrg_beli, 0) as hrg_beli, format(tb_retur_pembelian_detail.diskon, 0) as diskon, format(jumlah, 0) as jumlah, `tb_barang`.`nama` as `barang`, ifnull(satuan, "") as satuan, `tb_satuan`.`rasio`, format((hrg_beli-(hrg_beli*tb_barang.diskon/100))*jumlah*rasio, 0) as subtotal
FROM `tb_retur_pembelian`
JOIN `tb_retur_pembelian_detail` ON `tb_retur_pembelian_detail`.`no_transaksi` = `tb_retur_pembelian`.`no_transaksi`
JOIN `tb_barang` ON `tb_retur_pembelian_detail`.`barang_id` = `id_barang`
LEFT JOIN `tb_satuan` ON `tb_retur_pembelian_detail`.`satuan_id` = `id_satuan`
WHERE `id_retur_pembelian` = '1'
ORDER BY `id_retur_pembelian` DESC
ERROR - 2021-04-26 14:42:34 --> Severity: Notice --> Undefined property: stdClass::$no_transaksi E:\xampp\htdocs\rsrm\application\models\Retur_pembelian_model.php 101
ERROR - 2021-04-26 14:42:34 --> Severity: Notice --> A non well formed numeric value encountered E:\xampp\htdocs\rsrm\application\models\Retur_pembelian_model.php 106
ERROR - 2021-04-26 14:42:34 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-26 14:42:34 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 14:42:35 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 14:42:35 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 14:42:35 --> Severity: Notice --> Undefined property: stdClass::$no_transaksi E:\xampp\htdocs\rsrm\application\models\Retur_pembelian_model.php 101
ERROR - 2021-04-26 14:42:35 --> Severity: Notice --> A non well formed numeric value encountered E:\xampp\htdocs\rsrm\application\models\Retur_pembelian_model.php 106
ERROR - 2021-04-26 14:43:41 --> Severity: Notice --> A non well formed numeric value encountered E:\xampp\htdocs\rsrm\application\models\Retur_pembelian_model.php 106
ERROR - 2021-04-26 14:43:41 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-26 14:43:41 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 14:43:41 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 14:43:41 --> Severity: Notice --> A non well formed numeric value encountered E:\xampp\htdocs\rsrm\application\models\Retur_pembelian_model.php 106
ERROR - 2021-04-26 14:43:41 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 14:44:27 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-26 14:44:27 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 14:44:27 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 14:44:28 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 14:59:11 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-26 14:59:11 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 14:59:11 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 14:59:12 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 15:02:19 --> Severity: Notice --> A non well formed numeric value encountered E:\xampp\htdocs\rsrm\application\models\Retur_pembelian_model.php 107
ERROR - 2021-04-26 15:02:19 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-26 15:02:19 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 15:02:19 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 15:02:20 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 15:02:20 --> Severity: Notice --> A non well formed numeric value encountered E:\xampp\htdocs\rsrm\application\models\Retur_pembelian_model.php 107
ERROR - 2021-04-26 15:03:05 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-26 15:03:06 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 15:03:06 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 15:03:06 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 15:16:40 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-26 15:16:40 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 15:16:40 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 15:16:41 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 15:16:44 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 15:16:44 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 15:16:45 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 15:24:38 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 15:24:38 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 15:24:39 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 15:33:30 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 15:33:30 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 15:33:30 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 15:33:36 --> Severity: Notice --> Undefined property: stdClass::$satuan E:\xampp\htdocs\rsrm\application\controllers\transaksi\Stokopname.php 246
ERROR - 2021-04-26 15:33:36 --> Severity: Notice --> Undefined property: stdClass::$satuan_id E:\xampp\htdocs\rsrm\application\controllers\transaksi\Stokopname.php 247
ERROR - 2021-04-26 15:35:17 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 15:35:18 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 15:35:18 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 15:36:07 --> Severity: Notice --> Undefined variable: stokopname E:\xampp\htdocs\rsrm\application\models\Stokopname_model.php 41
ERROR - 2021-04-26 15:36:07 --> Severity: Notice --> Trying to get property 'id' of non-object E:\xampp\htdocs\rsrm\application\models\Stokopname_model.php 41
ERROR - 2021-04-26 15:36:07 --> Severity: Notice --> Undefined variable: stokopname E:\xampp\htdocs\rsrm\application\models\Stokopname_model.php 43
ERROR - 2021-04-26 15:36:07 --> Severity: Notice --> Trying to get property 'id' of non-object E:\xampp\htdocs\rsrm\application\models\Stokopname_model.php 43
ERROR - 2021-04-26 15:36:07 --> Severity: Notice --> Undefined property: stdClass::$lunas E:\xampp\htdocs\rsrm\application\models\Stokopname_model.php 51
ERROR - 2021-04-26 15:36:07 --> Severity: error --> Exception: Call to undefined method Stokopname_model::get_pembelian_detail() E:\xampp\htdocs\rsrm\application\models\Stokopname_model.php 53
ERROR - 2021-04-26 15:36:28 --> Severity: Notice --> Undefined property: stdClass::$lunas E:\xampp\htdocs\rsrm\application\models\Stokopname_model.php 51
ERROR - 2021-04-26 15:36:28 --> Severity: error --> Exception: Call to undefined method Stokopname_model::get_pembelian_detail() E:\xampp\htdocs\rsrm\application\models\Stokopname_model.php 53
ERROR - 2021-04-26 15:36:54 --> Severity: error --> Exception: Call to undefined method Stokopname_model::get_pembelian_detail() E:\xampp\htdocs\rsrm\application\models\Stokopname_model.php 52
ERROR - 2021-04-26 15:37:09 --> Severity: Notice --> Undefined property: stdClass::$id_pembelian E:\xampp\htdocs\rsrm\application\models\Stokopname_model.php 52
ERROR - 2021-04-26 15:37:09 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-26 15:37:09 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 15:37:09 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 15:37:10 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 15:37:10 --> Severity: Notice --> Undefined property: stdClass::$id_pembelian E:\xampp\htdocs\rsrm\application\models\Stokopname_model.php 52
ERROR - 2021-04-26 15:37:23 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-26 15:37:23 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 15:37:23 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 15:37:23 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 15:37:43 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-26 15:37:44 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 15:37:44 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 15:37:44 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 15:38:16 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-26 15:38:16 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 15:38:16 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 15:38:17 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 15:39:16 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-26 15:39:16 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 15:39:16 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 15:39:17 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 15:39:32 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-26 15:39:32 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 15:39:32 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 15:39:32 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 16:12:25 --> Query error: Unknown column 'penyimpanan_ke' in 'field list' - Invalid query: SELECT `id`, `no_transaksi`, date_format(tgl_transaksi, "%d-%mp-%Y") as tgl_transaksi, `penyimpanan`, `penyimpanan_ke`, `keterangan`, `created_at`, `created_by`
FROM `tb_stokopname`
WHERE `id` = '3'
ERROR - 2021-04-26 17:14:27 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-26 17:14:27 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:14:27 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 17:14:27 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:15:37 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:15:37 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:15:37 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 17:17:27 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 17:17:27 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:17:27 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:17:39 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-26 17:17:39 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 17:17:39 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:17:40 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:18:44 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-26 17:18:44 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 17:18:44 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:18:44 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:41:32 --> Severity: Notice --> Undefined property: Transfer_stok::$dt_model E:\xampp\htdocs\rsrm\system\core\Model.php 73
ERROR - 2021-04-26 17:41:32 --> Severity: error --> Exception: Call to a member function dt_get() on null E:\xampp\htdocs\rsrm\application\models\Transfer_stok_model.php 32
ERROR - 2021-04-26 17:41:47 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-26 17:41:48 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 17:41:48 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:41:48 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:41:58 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-26 17:41:58 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:41:58 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 17:41:58 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:42:18 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-26 17:42:18 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 17:42:18 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:42:18 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:44:04 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-26 17:44:04 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 17:44:04 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:44:04 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:44:27 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:44:27 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:44:27 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 17:48:14 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:48:14 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 17:48:14 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:49:06 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:49:06 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 17:49:06 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:49:24 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-26 17:49:24 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 17:49:24 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:49:25 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:49:51 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-26 17:49:51 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 17:49:51 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:49:51 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:58:45 --> 404 Page Not Found: master/Images/logo-mini.svg
ERROR - 2021-04-26 17:58:45 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:58:46 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 17:58:46 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:59:44 --> 404 Page Not Found: master/Images/logo-mini.svg
ERROR - 2021-04-26 17:59:45 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 17:59:45 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 17:59:45 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:00:14 --> 404 Page Not Found: master/Images/logo-mini.svg
ERROR - 2021-04-26 18:00:14 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:00:14 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 18:00:14 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:00:46 --> 404 Page Not Found: master/Images/logo-mini.svg
ERROR - 2021-04-26 18:00:47 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:00:47 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:00:47 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 18:01:22 --> 404 Page Not Found: master/Images/logo-mini.svg
ERROR - 2021-04-26 18:01:23 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:01:23 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:01:23 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 18:01:34 --> 404 Page Not Found: master/Images/logo-mini.svg
ERROR - 2021-04-26 18:01:35 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:01:35 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 18:01:35 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:01:42 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:01:42 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:01:42 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 18:01:49 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 18:01:49 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:01:49 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:07:17 --> Query error: Unknown column 's.tb_barang_id' in 'on clause' - Invalid query: SELECT *
FROM `tb_satuan`
INNER JOIN `tb_barang` `b` ON `b`.`id_barang` = `s`.`tb_barang_id`
ORDER BY `id_satuan` DESC
ERROR - 2021-04-26 18:07:50 --> Severity: Notice --> Undefined property: stdClass::$barang E:\xampp\htdocs\rsrm\application\models\Satuan_model.php 51
ERROR - 2021-04-26 18:07:50 --> Severity: Warning --> Invalid argument supplied for foreach() E:\xampp\htdocs\rsrm\application\views\master\satuan\tb_satuan_list.php 23
ERROR - 2021-04-26 18:07:50 --> 404 Page Not Found: master/Images/logo-mini.svg
ERROR - 2021-04-26 18:07:50 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:07:51 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 18:07:51 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:07:51 --> Severity: Notice --> Undefined property: stdClass::$barang E:\xampp\htdocs\rsrm\application\models\Satuan_model.php 51
ERROR - 2021-04-26 18:08:08 --> Severity: Warning --> Invalid argument supplied for foreach() E:\xampp\htdocs\rsrm\application\views\master\satuan\tb_satuan_list.php 23
ERROR - 2021-04-26 18:08:08 --> 404 Page Not Found: master/Images/logo-mini.svg
ERROR - 2021-04-26 18:08:09 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:08:09 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:08:09 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 18:08:23 --> 404 Page Not Found: master/Images/logo-mini.svg
ERROR - 2021-04-26 18:08:24 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 18:08:24 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:08:24 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:08:29 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 18:08:29 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:08:29 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:08:32 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:08:32 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 18:08:32 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:13:08 --> 404 Page Not Found: master/Images/logo-mini.svg
ERROR - 2021-04-26 18:13:08 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 18:13:08 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:13:09 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:13:11 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:13:11 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 18:13:12 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:13:15 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 18:13:15 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:13:15 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:13:18 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:13:18 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 18:13:18 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:13:21 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 18:13:21 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:13:21 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:13:24 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:13:24 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 18:13:24 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:13:34 --> 404 Page Not Found: master/Images/logo-mini.svg
ERROR - 2021-04-26 18:13:34 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 18:13:34 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:13:35 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:16:09 --> 404 Page Not Found: master/Images/logo-mini.svg
ERROR - 2021-04-26 18:16:09 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:16:09 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 18:16:09 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:16:12 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 18:16:12 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:16:12 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:16:17 --> 404 Page Not Found: master/Images/logo-mini.svg
ERROR - 2021-04-26 18:16:17 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:16:18 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:16:18 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 18:20:42 --> Severity: Warning --> Illegal string offset 'tipe' E:\xampp\htdocs\rsrm\application\models\Dt_model.php 21
ERROR - 2021-04-26 18:20:42 --> Severity: Warning --> Illegal string offset 'table' E:\xampp\htdocs\rsrm\application\models\Dt_model.php 22
ERROR - 2021-04-26 18:20:42 --> Severity: Warning --> Illegal string offset 'on' E:\xampp\htdocs\rsrm\application\models\Dt_model.php 22
ERROR - 2021-04-26 18:20:42 --> Severity: Warning --> Illegal string offset 'tipe' E:\xampp\htdocs\rsrm\application\models\Dt_model.php 21
ERROR - 2021-04-26 18:20:42 --> Severity: Warning --> Illegal string offset 'table' E:\xampp\htdocs\rsrm\application\models\Dt_model.php 22
ERROR - 2021-04-26 18:20:42 --> Severity: Warning --> Illegal string offset 'on' E:\xampp\htdocs\rsrm\application\models\Dt_model.php 22
ERROR - 2021-04-26 18:20:42 --> Severity: Warning --> Illegal string offset 'tipe' E:\xampp\htdocs\rsrm\application\models\Dt_model.php 21
ERROR - 2021-04-26 18:20:42 --> Severity: Warning --> Illegal string offset 'table' E:\xampp\htdocs\rsrm\application\models\Dt_model.php 22
ERROR - 2021-04-26 18:20:42 --> Severity: Warning --> Illegal string offset 'on' E:\xampp\htdocs\rsrm\application\models\Dt_model.php 22
ERROR - 2021-04-26 18:20:42 --> Query error: Not unique table/alias: 't' - Invalid query: SELECT tb_user.username, nama_lengkap, tb_user_level.level, id_user
FROM `tb_user`
JOIN `t` USING (`t`)
JOIN `t` USING (`t`)
JOIN `i` USING (`i`)
ORDER BY `id_user` DESC
ERROR - 2021-04-26 18:20:42 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at E:\xampp\htdocs\rsrm\system\core\Exceptions.php:271) E:\xampp\htdocs\rsrm\system\core\Common.php 570
ERROR - 2021-04-26 18:21:14 --> 404 Page Not Found: master/Images/logo-mini.svg
ERROR - 2021-04-26 18:21:15 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:21:15 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 18:21:15 --> Query error: Column 'level' in where clause is ambiguous - Invalid query: SELECT tb_user.username, nama_lengkap, tb_user_level.level, id_user
FROM `tb_user`
INNER JOIN `tb_user_level` ON `tb_user`.`level` = `tb_user_level`.`id_level`
WHERE   (
`username` LIKE '%%' ESCAPE '!'
OR  `nama_lengkap` LIKE '%%' ESCAPE '!'
OR  `level` LIKE '%%' ESCAPE '!'
 )
ORDER BY `id_user` DESC
 LIMIT 10
ERROR - 2021-04-26 18:21:15 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:21:46 --> 404 Page Not Found: master/Images/logo-mini.svg
ERROR - 2021-04-26 18:21:46 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 18:21:46 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:21:46 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:21:58 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 18:21:58 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:21:58 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:22:35 --> 404 Page Not Found: master/Images/logo-mini.svg
ERROR - 2021-04-26 18:22:36 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:22:36 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 18:22:36 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:22:40 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:22:40 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:22:46 --> 404 Page Not Found: Images/logo-mini.svg
ERROR - 2021-04-26 18:22:46 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:22:46 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 18:22:46 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:22:53 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 18:22:53 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:22:54 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:22:56 --> 404 Page Not Found: transaksi/Penjualan/images
ERROR - 2021-04-26 18:22:56 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-26 18:22:56 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-26 18:22:56 --> 404 Page Not Found: Assets/vendors
