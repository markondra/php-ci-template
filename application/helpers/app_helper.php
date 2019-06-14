<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Helper Function Custom
 *
 * @package All Module
 **/

if ( ! function_exists('getTable') ) {
    function getTable($tables) {
        if($tables === "unit"){
            $table = unit;
        }
        else if($tables === "user"){
            $table = user;
        }
        else if($tables === "kelompok"){
            $table = kelompok;
        }
        else if($tables === "klasifikasi"){
            $table = klasifikasi;
        }
        else if($tables === "tindakan"){
            $table = tindakan;
        }
        else{
            $table = $tables;
        }
        return $table;
    }
}

if ( ! function_exists('codeBooking') ) {
    function codeBooking($unit, $tgl) {
        $CI   =& get_instance();
        $date = str_replace("-", "", $tgl);
        $poli = str_pad($unit, 3, '0', STR_PAD_LEFT);
        $qMax = $CI->db->query("select MAX(RIGHT(code,3)) code from t_booking where unit_id = $unit and tgl = '$tgl'")->row();
        $data = (intval($qMax->code)) + 1;
        $last = str_pad($data, 3, '0', STR_PAD_LEFT);
        return $date.$poli.$last;
    }
}

if ( ! function_exists('tgl_indo') ) {
	function tgl_indo($date) {
		$strDate = explode("-", $date);

		return $strDate[2]."-".$strDate[1]."-".$strDate[0];
	}
}
