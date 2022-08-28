<?php

$private_key = '-----BEGIN PRIVATE KEY-----
MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAOptDYA7USHJqnoW
YuuSqOGyqnKo4v8z1G3K1HCpGq/9jN6rbWZOgW4nfIT1Iho3WFiGrtlJidaGG+PA
FddUejuBJH8AEwKRFJEwsQ012znNgDylXHE8wtZRex3KiRmWwhEXZc7HPw6XrPCp
RGSn1OEkEO7jKb3VleHgWCWpBLYLAgMBAAECgYBVuuHoFkk6YQTONyef3PeT6oH5
AphZGfxC1p1QQhd3avM8b1bHxkgBH8Gi4f7BtaHCZibFYeZdpJfId3PFVqiILR2r
ebJ5prJpFyfHl3RVqUZ9AzPumHRRD5JIC6YA7vBCg5724T8Veg9CxTdHzybYLCwX
aDYFTlW0/6nnh1gPoQJBAPqbq5gkXCh+o/DrpT7kqia2cTun45XMCmYTiKShjmMu
jIVPC+/O43aErRpuLbeivxI6B9XqA841mSPb8uTUpbsCQQDveECxlKfpq01q//xA
Xb3lL+e+P7DX18W8ek+lLtXoUDhyKEB2c6zHO9g6A/6fHgx2DJH1+vnYmjHiiH2Q
soPxAkEAmNaRy0L5lZTOpSMB756DiwKfglN9ACGlgeWN42HINgLwnmi8De/uV5zI
+aKSbTlrMFGF79c9pOiZUf5VX2u0+wJABk6GdabSnUbTrSO8wv01CRov4kTPJYAb
RxF5k4IeRBYIxojk2bnGLSEYWr7ML+icr2c5WN8ZQWkeMzchB3SMIQJADGzV6RHv
x/6DCzLvSrtHUnyfKyCh19tC5hxyVyuXMAlKdQIzRSiTIOiRY/5HwvVi8ZCVvYmH
Q7n0XGYFdJ3s7Q==
-----END PRIVATE KEY-----';

$url=$_GET["url"];
$url0='http://42.157.129.28:5612/tvjx/?url='.$url;
$encrypted = file_get_contents($url0);
$decrypted=privateDecrypt($private_key,$encrypted);
$playurl='{"code":200,"success":1,"player":"dplayer","type":"mp4","url":"'.$decrypted.'"}';
echo $playurl;


//RSAË½Ô¿½âÃÜ
function privateDecrypt($private_key,$data){
 $decrypted = '';
 $pi_key = openssl_pkey_get_private($private_key);
 $plainData = str_split(base64_decode($data), 128); 
 foreach($plainData as $chunk){
  $str = '';
  $decryptionOk = openssl_private_decrypt($chunk,$str,$pi_key);//Ë½Ô¿½âÃÜ
  if($decryptionOk === false){
   return false;
  }
  $decrypted .= $str;
 }
 return $decrypted;
}


?>