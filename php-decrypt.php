$encodedSecret = "3d3d516343746d4d6d6c315669563362";

function encodeSecret($secret) {
    return bin2hex(strrev(base64_encode($secret)));
}

function decode($secret) {
  return base64_decode(strrev(hex2bin($secret)));
}

echo decode($encodedSecret);
echo encodeSecret(decode($encodedSecret));