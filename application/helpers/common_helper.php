<?php

define('API_URL','https://api-dev.tradly.app');
define('Authorization','a34asdfe1f234c6c12361db4516c5ezerr');//e20294e1f1ac6c12361b4516c5e155d0
define('ALLOWED_ATTRIB_VALUES',[1,2]);
define('ALLOWED_LOCALE',['en','ar']);

/*Function to set JSON output*/
function output($Return=array()){
    /*Set response header*/
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    /*Final JSON response*/
    exit(json_encode($Return));
}

function get_user_session(){
    $CI =& get_instance();
    $CI->load->library('session');
    return $userSession=$CI->session->userdata('username');
}

function show_data($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}


function get_curl_function($url){
   

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => API_URL . $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "Authorization: Bearer ".Authorization
        //"Authorization: Bearer e20294e1f1ac6c12361b4516c5e155d0"
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;

}



function post_curl_function($url, $postData){  

   

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => API_URL . $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $postData,
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "Authorization: Bearer ".Authorization
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;

}


function delete_curl_function($url){
   
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => API_URL . $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "DELETE",
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "Authorization: Bearer ".Authorization
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;

}


function put_curl_function($url, $postData){
  
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => API_URL . $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "PUT",
    CURLOPT_POSTFIELDS => $postData,
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "Authorization: Bearer ".Authorization
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;

}



function guid()
{
    $randomString = openssl_random_pseudo_bytes(16);
    $time_low = bin2hex(substr($randomString, 0, 4));
    $time_mid = bin2hex(substr($randomString, 4, 2));
    $time_hi_and_version = bin2hex(substr($randomString, 6, 2));
    $clock_seq_hi_and_reserved = bin2hex(substr($randomString, 8, 2));
    $node = bin2hex(substr($randomString, 10, 6));

    /**
     * Set the four most significant bits (bits 12 through 15) of the
     * time_hi_and_version field to the 4-bit version number from
     * Section 4.1.3.
     * @see http://tools.ietf.org/html/rfc4122#section-4.1.3
    */
    $time_hi_and_version = hexdec($time_hi_and_version);
    $time_hi_and_version = $time_hi_and_version >> 4;
    $time_hi_and_version = $time_hi_and_version | 0x4000;

    /**
     * Set the two most significant bits (bits 6 and 7) of the
     * clock_seq_hi_and_reserved to zero and one, respectively.
     */
    $clock_seq_hi_and_reserved = hexdec($clock_seq_hi_and_reserved);
    $clock_seq_hi_and_reserved = $clock_seq_hi_and_reserved >> 2;
    $clock_seq_hi_and_reserved = $clock_seq_hi_and_reserved | 0x8000;

    return sprintf('%08s-%04s-%04x-%04x-%012s', $time_low, $time_mid, $time_hi_and_version, $clock_seq_hi_and_reserved, $node);
} 


function put_curl_function_byauth($url, $postData){
    $userSession = get_user_session();
  

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => API_URL . $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "PUT",
    CURLOPT_POSTFIELDS => $postData,
    CURLOPT_HTTPHEADER => array(
        "auth_key: ".$userSession->key->auth_key,
        "Content-Type: application/json",
        "Authorization: Bearer ".Authorization
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;

}



function post_curl_function_byauth($url, $postData){  

    $userSession = get_user_session();


    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => API_URL . $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $postData,
    CURLOPT_HTTPHEADER => array(
        "auth_key: ".$userSession->key->auth_key,
        "Content-Type: application/json",
        "Authorization: Bearer ".Authorization
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;

    

}


function get_curl_function_byauth($url){
   
    $userSession = get_user_session();
    
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => API_URL . $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "auth_key: ".$userSession->key->auth_key,
        "Content-Type: application/json",
        "Authorization: Bearer ".Authorization
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;


}


function delete_curl_function_byauth($url){
    $userSession = get_user_session();
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => API_URL . $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "DELETE",
    CURLOPT_HTTPHEADER => array(
        "auth_key: ".$userSession->key->auth_key,
        "Content-Type: application/json",
        "Authorization: Bearer ".Authorization
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;

}

function attribute_types(){
    $attribute_types = [
        1 => 'Single Select',
        2 => 'Multi Select',
        3 => 'Open (Single Value)',
        4 => 'Open (Multiple Value)',
    ];
    return $attribute_types;
}


function changeCase($string,$type){    
    return $type($string);
}