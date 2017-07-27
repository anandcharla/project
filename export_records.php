<html>
<head>
<style>
   body {
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #FDF3E7;
   }
   </style>
   </head>

   <body>
<?php
$GLOBALS['api_token']       = '2E761195BA601368D9EBD9A2F128224F';
$GLOBALS['api_url']         = 'https://redcapdemo.vanderbilt.edu/api/';

$fields = array(
	'token'   => $GLOBALS['api_token'],
	'content' => 'record',
	'format'  => 'json',
	'type'    => 'flat'
);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $GLOBALS['api_url']);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields, '', '&'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // Set to TRUE for production use
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_AUTOREFERER, true);
curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);

$output = curl_exec($ch);
curl_close($ch);
?>
<h4><?php print($output); ?></h4>
</body>
</html>
