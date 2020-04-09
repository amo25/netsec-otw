#!/usr/bin/php

<?php

//use known plaintext attack to crack the xor encryption key
$defaultdata = array( "showpassword"=>"no", "bgcolor"=>"#ffffff");
$defaultcookie = "ClVLIh4ASCsCBE8lAxMacFMZV2hdVVotEhhUJQNVAmhSEV4sFxFeaAw=";

//get defaultdata and default cookie to the same step: the xor encrypt

//decode the base64 from the cookie. The next step is the xor_encrypt
$ready_cookie = base64_decode($defaultcookie);

//encode the plaintext in json. The next step is xor_encrypt
$ready_data = json_encode($defaultdata);

//plaintext and cyphertext are, by definition, the same length
//therefore, we don't need to worry about modulus here
//echo strlen($ready_cookie);
//echo strlen($ready_data);

//encrypted_text = plaintext^key -> key = plaintext^encrypted_text.
//dont forget to pad the key to get it to match length with the plaintext.
//repeat the start of the key at the end, or cut off if longer (this is done with modulus in the encryption program. See that program for details)
//NOTE: This was a point of confusion - the key that I generated was repeating of course, but I couldn't just use that... I had to pull just the unique bit out. Would it always start at the beginning like this? Or would I have to play around with the order? Regardless, see my xor_encrypt function... I just used 'qw8J' for the key, not the 41 character long repetion of this that I generate in xor_crack.
function xor_crack($plaintext, $cyphertext) {
        $key = '';
        for ($i = 0; $i < strlen($plaintext); $i++)
        {
                $key .= $plaintext[$i] ^ $cyphertext[$i];
        }

        return $key;
}

$key = xor_crack($ready_data, $ready_cookie);
//echo $key;

function xor_encrypt($in) {
        //$key = '<censored>';
        //global $key;
        $key = 'qw8J'; //can't just use the key given... just want to pull out the repeating string
        //I guess they don't totally line up
    $text = $in;
    $outText = '';

    // Iterate through each character
    for($i=0;$i<strlen($text);$i++) {
    $outText .= $text[$i] ^ $key[$i % strlen($key)];
    }

    return $outText;
}

//data we want to inject
$inject_this =  array("showpassword"=>"yes", "bgcolor"=>"#ffffff");
//encrypted cookie to inject
$inject_this_cookie = base64_encode(xor_encrypt(json_encode($inject_this)));
echo $inject_this_cookie;



?>
