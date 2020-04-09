<?php


function xor_encrypt($in) {
    //$key = '<censored>';
    $key = 'Jq8';//'qJw';//'wqJ';//'Jwq';//'Jqw';//'qwJ';//'wJq'; //maybe Jqw or close?
    $text = $in;
    $outText = '';

    // Iterate through each character
    for($i=0;$i<strlen($text);$i++) {
    $outText .= $text[$i] ^ $key[$i % strlen($key)];
    }

    return $outText;
}

$spoofdata = array( "showpassword"=>"no", "bgcolor"=>"#ffffff");
$spoofdata_json = json_encode($spoofdata);
echo $spoofdata_json;
echo "  ";

$spoofdata_value = base64_encode(xor_encrypt(json_encode($spoofdata)));
echo $spoofdata_value;

//$decode = "ClVLIh4ASCsCBE8lAxMacFMZV2hdVVotEhhUJQNVAmhSEV4sFxFeaAw%3D"; //try adding %3D or =
$decode = "ClVLIh4ASCsCBE8lAxMacFMZV2hdVVotEhhUJQNVAmhSEV4sFxFeaAw"; //#ffffff
//$strip_base64 = base64_decode($decode);
//echo $strip_base64;

//$tempdata = json_decode(xor_encrypt(base64_decode($_COOKIE["data"])), true);
//$decoded_value = json_decode(xor_encrypt(base64_decode($decode)), true);
//$decoded_value = json_decode(xor_encrypt(base64_decode($decode)), true);
//echo $decoded_value;
/*
if(is_array($decoded_value))
{
    echo "Is array";
}
else
{
    echo "Not an array";
}
*/
//$test = 'a'^'d';
//echo $test;

