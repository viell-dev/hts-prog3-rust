<?php

function evalCrossTotal($strMD5)
{
    $intTotal = 0;
    $arrMD5Chars = str_split($strMD5, 1);
    
    foreach ($arrMD5Chars as $value) {
        $intTotal += hexdec('0x0' . $value);
    }

    return $intTotal;
}

function encryptString($strString, $strPassword)
{
    // $strString is the content of the entire file with serials
    var_dump('$strPassword: ' . $strPassword);
    $strPasswordMD5 = md5($strPassword);
    var_dump('$strPasswordMD5: ' . $strPasswordMD5);
    $intMD5Total = evalCrossTotal($strPasswordMD5);
    var_dump('$intMD5Total: ' . $intMD5Total);
    $arrEncryptedValues = array();
    $intStrlen = strlen($strString);
    var_dump('$intStrlen: ' . $intStrlen);
    
    for ($i=0; $i<$intStrlen; $i++) {
        $arrEncryptedValues[] = ord(substr($strString, $i, 1))
            + hexdec('0x0' . substr($strPasswordMD5, $i%32, 1))
            - $intMD5Total;

        $intMD5Total = evalCrossTotal(
            substr(md5(substr($strString, 0, $i+1)), 0, 16)
                . substr(md5($intMD5Total), 0, 16)
        );
        var_dump(
            substr(md5(substr($strString, 0, $i+1)), 0, 16)
            . substr(md5($intMD5Total), 0, 16)
        );
    }
    var_dump($str);
    return implode(' ', $arrEncryptedValues);
}

$serials = file_get_contents("serials.txt");
$result = explode(' ', encryptString($serials, 'hallelåja'));
var_dump(count($result)/15);
