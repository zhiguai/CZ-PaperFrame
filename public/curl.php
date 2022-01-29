<?php
// $url 请求地址
// $method 请求方式 POST/GET/PUT/DELET 
// $headers 请求头 array格式
// $params 请求头 array格式
function curlRequest($url, $method, $timeout = 2, $headers, $params){
    if (is_array($params)) {
        $requestString = http_build_query($params);
    } else {
        $requestString = $params ? : '';
    }
    if (empty($headers)) {
        $headers = array('Content-type: text/json'); 
    } elseif (!is_array($headers)) {
        parse_str($headers,$headers);
    }
    // setting the curl parameters.
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT,$timeout);//超时时间
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    // turning off the server and peer verification(TrustManager Concept).
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    // setting the POST FIELD to curl
    switch ($method){  
        case "GET" : curl_setopt($ch, CURLOPT_HTTPGET, 1);break;  
        case "POST": curl_setopt($ch, CURLOPT_POST, 1);
                     curl_setopt($ch, CURLOPT_POSTFIELDS, $requestString);break;  
        case "PUT" : curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "PUT");   
                     curl_setopt($ch, CURLOPT_POSTFIELDS, $requestString);break;  
        case "DELETE":  curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "DELETE");   
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestString);break;  
    }
    // getting response from server
    $response = curl_exec($ch);
    
    //close the connection
    curl_close($ch);
    
    //return the response
    if (stristr($response, 'HTTP 404') || $response == '') {
        return array('Error' => '请求错误');
    }
    return $response;
}

?>