<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_ip_details')){
    function get_ip_details(){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])){$ip_address = $_SERVER['HTTP_CLIENT_IP'];}
            //whether ip is from proxy
        elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];}
            //whether ip is from remote address
        else{$ip_address = $_SERVER['REMOTE_ADDR'];}
            $city = '';  $country = '';
            $url = "http://ip-api.com/json/".$ip_address;
            // init the resource
            $ch = curl_init();
            curl_setopt_array($ch, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST=>'GET'
            ));
            //Ignore SSL certificate verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            //get response
            $output = curl_exec($ch);
            //$output->ip_address = $ip_address;
            return json_decode($output);        
    }    
}