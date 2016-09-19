<?php 

$curl = curl_init();
// Set some options - we are passing in a useragent too here
$q = $_GET['v'];
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://www.youtube.com/watch?v='.$q.'&spf=navigate',
    CURLOPT_USERAGENT => 'Chrome'
));
// Send the request & save response to $resp
$resp = curl_exec($curl);

$resp = (json_decode($resp, true));
$data = ($resp[2]['data']['swfcfg']['args']);
$url_encoded_fmt_stream_map = $data['url_encoded_fmt_stream_map'];

$links = explode(",",$url_encoded_fmt_stream_map);
$vid = array();
$i=0;
foreach ($links as $link) {
	// echo $link;
	$property = explode("&",$link);
	
	foreach ($property as $prop){
		$vid[$i][explode("=", $prop)[0]] = explode("=", $prop)[1];
		$vid[$i]['url'] = urldecode($vid[$i]['url']);
	}
	print_r ($vid[$i]);
		echo "<br/>";
		echo "<br/>";
	$i++;
}
 var_dump($vid);
// Close request to clear up some resources
curl_close($curl);
?>
