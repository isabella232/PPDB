<?php
class displayIP{
    private function __contruct(){
    # Nothing
    }
if(!@require("handler/PluginHandler.php")) echo "Plugin Handler not found";
define("USER_IP", ['ip'=>'', 'city'=>'', 'region'=>'', 'country'=>'', 'loc'=>'', 'org'=>'', 'postal'=>'', 'timezone'=>'']);
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
$d = json_decode("http://ipinfo.io/{$ip}/json");
USER_IP['ip'] = $d->ip;
USER_IP['city'] = $d->city;
USER_IP['region'] = $d->region;
USER_IP['country'] = $d->country;
USER_IP['loc'] = $d->loc;
USER_IP['org'] = $d->org;
USER_IP['postal'] = $d->postal;
USER_IP['timezone'] = $d->timezone;
    
function returnData($data=[]){

}    
    
    
}




?>
