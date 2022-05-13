<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
function update_tokenpasien($token, $id){
		$CI =& get_instance();
		$CI->load->model('M_token');
        $enc = $CI->M_token->updateTokenPasien($token, $id);
		return $enc;
	}