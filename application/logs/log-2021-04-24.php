<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-04-24 04:28:08 --> 404 Page Not Found: Images/logo-mini.svg
ERROR - 2021-04-24 04:28:11 --> 404 Page Not Found: master/Images/logo-mini.svg
ERROR - 2021-04-24 04:30:05 --> Query error: Unknown column 'b.id' in 'on clause' - Invalid query: SELECT *
FROM `tb_satuan` `s`
JOIN `tb_barang` `b` ON `b`.`id` = `s`.`tb_barang_id`
ORDER BY `id_satuan` DESC
ERROR - 2021-04-24 04:30:53 --> 404 Page Not Found: master/Images/logo-mini.svg
ERROR - 2021-04-24 04:35:22 --> Query error: Column 'harga_jual' in field list is ambiguous - Invalid query: SELECT `id_barang`, `kode`, `nama`, `diskon`, format(harga_beli, 1) as harga_beli, format(harga_jual, 1) as harga_jual, `satuan`
FROM `tb_barang`
JOIN `tb_satuan` ON `id_satuan` = `satuan_id`
ORDER BY `id_barang` DESC
ERROR - 2021-04-24 04:35:50 --> 404 Page Not Found: master/Images/logo-mini.svg
ERROR - 2021-04-24 04:41:26 --> 404 Page Not Found: master/Images/logo-mini.svg
ERROR - 2021-04-24 04:45:01 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 04:45:01 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:45:01 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:45:39 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 04:45:39 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:45:39 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:46:12 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 04:46:12 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:46:13 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:46:29 --> 404 Page Not Found: master/Images/logo-mini.svg
ERROR - 2021-04-24 04:46:29 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:46:29 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:46:29 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 04:46:37 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 04:46:37 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:46:37 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:46:43 --> 404 Page Not Found: master/Images/logo-mini.svg
ERROR - 2021-04-24 04:46:44 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:46:44 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:46:44 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 04:47:50 --> 404 Page Not Found: master/Images/logo-mini.svg
ERROR - 2021-04-24 04:47:51 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:47:51 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:47:51 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 04:49:26 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-24 04:49:26 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 04:49:26 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:49:26 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:49:34 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:49:34 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:49:34 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 04:50:44 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:50:44 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 04:50:44 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:52:51 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:52:51 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 04:52:51 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:53:00 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 04:53:00 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:53:00 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:53:13 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 04:53:16 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 04:53:50 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-24 04:53:50 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 04:53:51 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:53:51 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:54:01 --> Query error: Unknown column 'hrg_jual' in 'field list' - Invalid query: SELECT no_batch, date_format(kadaluarsa, "%d-%m-%Y") kadaluarsa, hrg_jual, hrg_beli, tb_pembelian_detail.diskon*hrg_beli/100 as diskon_nominal, tb_pembelian_detail.diskon, jumlah, tb_barang.nama as barang, ifnull(satuan, "") as satuan, (hrg_beli-(hrg_beli*tb_barang.diskon/100))*jumlah as subtotal, barang_id, tb_pembelian_detail.satuan_id
FROM `tb_pembelian`
JOIN `tb_pembelian_detail` ON `tb_pembelian_detail`.`no_transaksi` = `tb_pembelian`.`no_transaksi`
JOIN `tb_barang` ON `tb_pembelian_detail`.`barang_id` = `id_barang`
LEFT JOIN `tb_satuan` ON `tb_barang`.`satuan_id` = `id_satuan`
WHERE `id_pembelian` = '5'
ORDER BY `id_pembelian` DESC
ERROR - 2021-04-24 04:55:43 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 04:55:43 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:55:43 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:57:46 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:57:46 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 04:57:46 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:58:02 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-24 04:58:02 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 04:58:02 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:58:02 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:58:05 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:58:05 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 04:58:05 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 05:01:39 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 05:01:39 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 05:01:39 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 05:10:23 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 05:10:23 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 05:10:24 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 05:11:07 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 05:11:07 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 05:11:07 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 05:12:38 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 05:12:38 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 05:12:38 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 05:13:18 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 05:13:18 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 05:13:18 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 05:13:36 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 05:13:36 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 05:13:36 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 05:15:08 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 05:15:08 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 05:15:08 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 05:15:12 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 05:15:12 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 05:15:12 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 05:15:17 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 05:15:19 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 05:15:32 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 05:45:58 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 05:45:58 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 05:45:58 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 05:47:32 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 05:47:32 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 05:47:32 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:26:00 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:26:00 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 07:26:00 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:26:25 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:26:25 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 07:26:26 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:30:53 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 07:30:53 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:30:53 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:32:11 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 07:32:11 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:32:12 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:33:07 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:33:07 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 07:33:07 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:35:25 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:35:25 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 07:35:25 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:35:56 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:35:56 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:35:56 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 07:36:28 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 07:36:29 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:36:29 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:36:53 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 07:36:53 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:36:53 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:38:21 --> 404 Page Not Found: master/Images/logo-mini.svg
ERROR - 2021-04-24 07:38:21 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 07:38:21 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:38:21 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:38:29 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 07:38:29 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:38:29 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:38:48 --> 404 Page Not Found: master/Images/logo-mini.svg
ERROR - 2021-04-24 07:38:49 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:38:49 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 07:38:49 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:38:52 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:38:52 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 07:38:52 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:39:00 --> 404 Page Not Found: master/Images/logo-mini.svg
ERROR - 2021-04-24 07:39:01 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 07:39:01 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:39:01 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:39:03 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:39:03 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 07:39:03 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:39:12 --> 404 Page Not Found: master/Images/logo-mini.svg
ERROR - 2021-04-24 07:39:12 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:39:12 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:39:13 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 07:39:27 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-24 07:39:37 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-24 07:44:26 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:44:26 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 07:44:26 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:45:34 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:45:34 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 07:45:34 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:46:45 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 07:46:45 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:46:45 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:47:12 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 07:47:12 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:47:13 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:47:38 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:47:38 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 07:47:38 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:53:17 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:53:17 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 07:53:17 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:54:57 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:54:57 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 07:54:57 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:56:56 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:56:56 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 07:56:56 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:58:53 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 07:58:53 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:58:54 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:59:59 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 07:59:59 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 07:59:59 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 08:00:48 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 08:00:48 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 08:00:49 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 08:00:50 --> Query error: Unknown column 'b.id' in 'on clause' - Invalid query: SELECT `id_satuan` as `id`, `satuan_id`, `satuan` as `label`, `rasio`
FROM `tb_barang` `b`
JOIN `tb_satuan` `s` ON `b`.`id` = `s`.`tb_barang_id`
WHERE `s`.`satuan` LIKE '%%' ESCAPE '!'
OR  `s`.`rasio` LIKE '%%' ESCAPE '!'
ERROR - 2021-04-24 08:02:58 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 08:02:58 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 08:02:58 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 08:03:35 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 08:03:35 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 08:03:35 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 08:03:40 --> Query error: Unknown column 'b.id' in 'on clause' - Invalid query: SELECT `id_satuan` as `id`, `satuan_id`, `satuan` as `label`, `rasio`
FROM `tb_barang` `b`
JOIN `tb_satuan` `s` ON `b`.`id` = `s`.`tb_barang_id`
WHERE `s`.`satuan` LIKE '%s%' ESCAPE '!'
OR  `s`.`rasio` LIKE '%s%' ESCAPE '!'
ERROR - 2021-04-24 08:03:42 --> Query error: Unknown column 'b.id' in 'on clause' - Invalid query: SELECT `id_satuan` as `id`, `satuan_id`, `satuan` as `label`, `rasio`
FROM `tb_barang` `b`
JOIN `tb_satuan` `s` ON `b`.`id` = `s`.`tb_barang_id`
WHERE `s`.`satuan` LIKE '%%' ESCAPE '!'
OR  `s`.`rasio` LIKE '%%' ESCAPE '!'
ERROR - 2021-04-24 08:04:13 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 08:04:13 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 08:04:13 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 08:05:39 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 08:05:39 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 08:05:40 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 08:06:12 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 08:06:12 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 08:06:12 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 14:03:24 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 14:03:24 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 14:03:30 --> 404 Page Not Found: Images/logo-mini.svg
ERROR - 2021-04-24 14:03:30 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 14:03:30 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 14:03:30 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 14:03:33 --> 404 Page Not Found: transaksi/Pembelian/images
ERROR - 2021-04-24 14:03:33 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 14:03:33 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 14:03:33 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 14:05:00 --> 404 Page Not Found: transaksi/Pembelian/images
ERROR - 2021-04-24 14:05:00 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 14:05:00 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 14:05:00 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 14:08:04 --> 404 Page Not Found: transaksi/Pembelian/images
ERROR - 2021-04-24 14:08:04 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 14:08:04 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 14:08:04 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 14:26:07 --> 404 Page Not Found: transaksi/Pembelian/images
ERROR - 2021-04-24 14:26:08 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 14:26:08 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 14:26:08 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 14:26:26 --> 404 Page Not Found: transaksi/Pembelian/images
ERROR - 2021-04-24 14:26:27 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 14:26:27 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 14:26:27 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 14:28:02 --> 404 Page Not Found: transaksi/Pembelian/images
ERROR - 2021-04-24 14:28:03 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 14:28:03 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 14:28:03 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 14:28:38 --> 404 Page Not Found: transaksi/Pembelian/images
ERROR - 2021-04-24 14:28:38 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 14:28:38 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 14:28:38 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 14:28:50 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 14:30:28 --> 404 Page Not Found: transaksi/Pembelian/images
ERROR - 2021-04-24 14:30:28 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 14:30:28 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 14:30:28 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 14:34:09 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-24 14:34:09 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 14:34:09 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 14:34:10 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 14:34:12 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 14:34:12 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 14:34:13 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 14:34:51 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 14:34:51 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 14:34:51 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 14:59:40 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 14:59:40 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 14:59:40 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:00:37 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:00:37 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:00:37 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:00:40 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:00:40 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:00:40 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:00:44 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:00:44 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:00:44 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:02:33 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:02:33 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:02:33 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:02:35 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:02:35 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:02:35 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:03:34 --> 404 Page Not Found: master/Images/logo-mini.svg
ERROR - 2021-04-24 15:03:34 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:03:34 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:03:34 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:03:46 --> 404 Page Not Found: master/Images/logo-mini.svg
ERROR - 2021-04-24 15:03:46 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:03:46 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:03:46 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:03:49 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:03:49 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:03:49 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:04:01 --> 404 Page Not Found: master/Images/logo-mini.svg
ERROR - 2021-04-24 15:04:01 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:04:01 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:04:01 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:04:20 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-24 15:09:17 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:09:28 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:09:28 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:09:28 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:11:11 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:11:11 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:11:11 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:12:10 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:12:10 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:12:10 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:12:54 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-24 15:12:54 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:12:54 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:12:54 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:12:56 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:12:57 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:12:57 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:14:55 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:14:55 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:14:56 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:15:19 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:15:19 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:15:19 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:15:48 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:15:48 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:15:48 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:17:08 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:17:08 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:17:08 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:18:16 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:18:16 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:18:16 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:18:33 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-24 15:18:33 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:18:33 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:18:33 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:20:44 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:20:44 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:20:45 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:20:53 --> Could not find the language line "insert_batch() called with no data"
ERROR - 2021-04-24 15:22:46 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:22:46 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:22:46 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:22:49 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:22:49 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:22:49 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:37:34 --> Could not find the language line "insert_batch() called with no data"
ERROR - 2021-04-24 15:39:21 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:39:21 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:39:22 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:39:23 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:39:23 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:39:23 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:40:11 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:40:11 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:40:12 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:41:11 --> Query error: Unknown column 'hrg_jual' in 'field list' - Invalid query: INSERT INTO `tb_pembelian_detail` (`barang_id`, `diskon`, `hrg_beli`, `hrg_jual`, `jumlah`, `kadaluarsa`, `no_batch`, `no_transaksi`, `penyimpanan`, `satuan_id`) VALUES ('2','5','20000','0','10','1970-01-01','','B210424_0005','etalase','2')
ERROR - 2021-04-24 15:41:50 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-24 15:41:50 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:41:50 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:41:51 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:42:28 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:42:28 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:42:28 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:42:48 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-24 15:42:49 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:42:49 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:42:49 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:43:44 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:43:44 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:43:44 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:57:40 --> Query error: Column 'rasio' in field list is ambiguous - Invalid query: SELECT no_batch, date_format(kadaluarsa, "%d-%m-%Y") kadaluarsa, harga_jual as hrg_jual, harga_beli as hrg_beli, tb_pembelian_detail.diskon*hrg_beli/100 as diskon_nominal, tb_pembelian_detail.diskon, jumlah, tb_barang.nama as barang, diskon_jual, ifnull(satuan, "") as satuan, ifnull(rasio, 1) as rasio, isppn, (hrg_beli-(hrg_beli*tb_barang.diskon/100))*jumlah as subtotal, barang_id, tb_pembelian_detail.satuan_id
FROM `tb_pembelian`
JOIN `tb_pembelian_detail` ON `tb_pembelian_detail`.`no_transaksi` = `tb_pembelian`.`no_transaksi`
JOIN `tb_barang` ON `tb_pembelian_detail`.`barang_id` = `id_barang`
LEFT JOIN `tb_satuan` ON `tb_barang`.`satuan_id` = `id_satuan`
WHERE `id_pembelian` = '6'
ORDER BY `id_pembelian` DESC
ERROR - 2021-04-24 15:58:14 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 15:58:14 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 15:58:15 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 16:04:21 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 16:04:21 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 16:04:21 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 16:04:59 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 16:04:59 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 16:04:59 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 16:05:01 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 16:05:01 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 16:05:01 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 16:07:56 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 16:07:56 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 16:07:57 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 16:08:30 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-24 16:08:30 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 16:08:30 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 16:08:31 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 16:09:43 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-24 16:09:43 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 16:09:43 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 16:09:44 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 16:10:51 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 16:10:51 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 16:10:51 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 16:12:01 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 16:12:23 --> 404 Page Not Found: transaksi/Images/logo-mini.svg
ERROR - 2021-04-24 16:12:23 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 16:12:23 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 16:12:23 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 16:12:27 --> 404 Page Not Found: Assets/css
ERROR - 2021-04-24 16:12:28 --> 404 Page Not Found: Assets/vendors
ERROR - 2021-04-24 16:12:28 --> 404 Page Not Found: Assets/vendors
