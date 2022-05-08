<?php

if(isset($_GET["testo"])){
    $testo = $_GET["testo"];

}
//richiedo il token
$client_ID = "";
$client_secret = "";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://accounts.spotify.com/api/token");
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
$headers = array("Authorization: Basic ".base64_encode($client_ID.":".$client_secret));
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
curl_close($curl);

$token = json_decode($result)->access_token;
//inizio richiesta
$data = http_build_query(array("q" => "$testo", "type" => "track", "limit" => "6"));
$curl = curl_init();
curl_setopt($curl,CURLOPT_URL,"https://api.spotify.com/v1/search?".$data);
$headers = array("Authorization: Bearer ".$token);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
curl_close($curl);
echo $result;

?>