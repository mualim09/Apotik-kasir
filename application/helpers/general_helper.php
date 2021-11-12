<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil;
	}
 
	function bulan($bulan_){
		$bulan = date('m', strtotime($bulan_));
		switch($bulan){
			case '01':
				$bulan_ini = "Januari";
			break;
	 
			case '02':			
				$bulan_ini = "Februari";
			break;
	 
			case '03':
				$bulan_ini = "Maret";
			break;
	 
			case '04':
				$bulan_ini = "April";
			break;
	 
			case '05':
				$bulan_ini = "Mei";
			break;
	 
			case '06':
				$bulan_ini = "Juni";
			break;
	 
			case '07':
				$bulan_ini = "Juli";
			break;
			
			case '08':
				$bulan_ini = "Agustus";
			break;
			
			case '09':
				$bulan_ini = "September";
			break;
			
			case '10':
				$bulan_ini = "Oktober";
			break;
			
			case '11':
				$bulan_ini = "Nopember";
			break;
			
			case '12':
				$bulan_ini = "Desember";
			break;
			
			default:
				$bulan_ini = "Tidak di ketahui";		
			break;
		}
		return $bulan_ini;
	}
	
	function hari($hari_){
		$hari = date('D', strtotime($hari_));
		switch($hari){
			case 'Sun':
				$hari_ini = "Minggu";
			break;
	 
			case 'Mon':			
				$hari_ini = "Senin";
			break;
	 
			case 'Tue':
				$hari_ini = "Selasa";
			break;
	 
			case 'Wed':
				$hari_ini = "Rabu";
			break;
	 
			case 'Thu':
				$hari_ini = "Kamis";
			break;
	 
			case 'Fri':
				$hari_ini = "Jumat";
			break;
	 
			case 'Sat':
				$hari_ini = "Sabtu";
			break;
			
			default:
				$hari_ini = "Tidak di ketahui";		
			break;
		}
		return $hari_ini;
	}
	