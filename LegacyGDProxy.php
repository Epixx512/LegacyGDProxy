<?php
const LOGGING=false;
const LOGFILE='';
const BOOMLINGS='www.boomlings.com';
const ROBTOPGAMES='www.robtopgames.org';
const COMMONSECRET='Wmfd2893gb7';
const ACCOUNTSECRET='Wmfv3899gc9';
const GJP2SALT='mI29fmAnxgTs';
const SEED2SALT='xI35fsAapCRg';
const SEED2KEY='85271';
const COMMENTKEY='29481';
const COMMENTSALT='xPT6iUrtws0J';

const FALLBACKIPS=[
    BOOMLINGS=>['172.66.156.222','104.20.40.246','104.20.43.246'],ROBTOPGAMES=>['172.67.188.24','104.21.7.241'],];

const ROBTOPGAMESPATHS=[
    '/database/accounts/backupGJAccountNew.php','/database/accounts/syncGJAccountNew.php',];

const ENDPOINTREWRITES=[
    '/database/updateGJUserScore21.php'=>'/database/updateGJUserScore22.php','/database/downloadGJLevel21.php'=>'/database/downloadGJLevel22.php','/database/downloadGJLevel20.php'=>'/database/downloadGJLevel22.php','/database/getGJComments20.php'=>'/database/getGJComments21.php','/database/likeGJItem20.php'=>'/database/likeGJItem211.php','/database/uploadGJComment20.php'=>'/database/uploadGJComment21.php','/database/rateGJStars20.php'=>'/database/rateGJStars21.php',];

const VERSIONMAP=[
    '1'=>'1.0','2'=>'1.1','3'=>'1.2','4'=>'1.3','5'=>'1.4','6'=>'1.5','7'=>'1.6','17'=>'1.7','18'=>'1.8','19'=>'1.9','20'=>'2.0','21'=>'2.1','22'=>'2.2',];

function xorCipher(string $s,string $key): string { // generates cycled xor ciphers
    $out='';
    $kl=strlen($key);
    for ($i=0; $i<strlen($s); $i++) {
        $out.=chr(ord($s[$i]) ^ ord($key[$i%$kl]));
    }
    return $out;
}

function makeChk(array $values,string $key,string $salt=''): string { // generates chk, which is kind of like a signature. required by some endpoints, such as uploadGJComment21.php.
    $values[]=$salt;
    $hashed=sha1(implode('',array_map('strval',$values)));
    return base64_encode(xorCipher($hashed,$key));
}

function makeGjp2(string $password): string {
    return sha1($password.GJP2SALT);
}

function makeSeed2(array $flat): string { // specifically to get update score working on 2.0, since it lacks fields the server now requires, and as a result we need to make a new signature to validate the new request. this is pretty related to chk.
    $vals=[
        $flat['accountID'] ?? '0',$flat['userCoins'] ?? '0',$flat['demons'] ?? '0',$flat['stars'] ?? '0',$flat['coins'] ?? '0',$flat['iconType'] ?? '0',$flat['icon'] ?? '0',$flat['diamonds'] ?? '0',$flat['accIcon'] ?? '0',$flat['accShip'] ?? '0',$flat['accBall'] ?? '0',$flat['accBird'] ?? '0',$flat['accDart'] ?? '0',$flat['accRobot'] ?? '0',$flat['accGlow'] ?? '0',$flat['accSpider'] ?? '0',$flat['accExplosion'] ?? '0',];
    if (isset($flat['dinfo'])) {
        $vals[]=strlen($flat['dinfo']);
        $vals[]=$flat['dinfow'] ?? '0';
        $vals[]=$flat['dinfog'] ?? '0';
        $vals[]=$flat['sinfo'] ?? '';
        $vals[]=$flat['sinfod'] ?? '0';
        $vals[]=$flat['sinfog'] ?? '0';
    }
    $hashed=sha1(implode('',array_map('strval',$vals)).SEED2SALT);
    return strtr(base64_encode(xorCipher($hashed,SEED2KEY)),'+/','-_');
}

function resolveRealIp(string $host): string {
    $cache=sys_get_temp_dir().'/LegacyGDProxy_'.md5($host).'.ip';
    if (is_file($cache) && (time()-filemtime($cache))<300) {
        $ip=trim((string)@file_get_contents($cache));
        if ($ip!=='') return $ip;
    }
    $ips=[];
    foreach ((array)@dns_get_record($host,DNS_A) as $r) {
        if (!empty($r['ip'])) $ips[]=$r['ip'];
    }
    if (!$ips) {
        $ip=trim((string)@file_get_contents($cache));
        if ($ip!=='') return $ip;
        $ips=FALLBACKIPS[$host] ?? [];
    }
    if (!$ips) {
        http_response_code(502);
        echo "DNS resolution failed for $host";
        exit;
    }
    $ip=$ips[array_rand($ips)];
    @file_put_contents($cache,$ip);
    return $ip;
}

function sendRequest(string $host,string $path,string $method,array $headers,string $body): array {
    $headers=array_values(array_filter($headers,fn($h)=>stripos($h,'user-agent')!==0 && stripos($h,'accept')!==0));
    $headers[]='User-Agent;';
    $headers[]='Accept:';
    $headers[]='Expect:';
    $ip=resolveRealIp($host);
    $timeout=in_array($path,ROBTOPGAMESPATHS,true) ? 60 : 10;
    $ch=curl_init();
    curl_setopt_array($ch,[
        CURLOPT_URL=>'http://'.$host.$path,CURLOPT_RESOLVE=>[$host.':80:'.$ip],CURLOPT_CUSTOMREQUEST=>$method,CURLOPT_RETURNTRANSFER=>true,CURLOPT_HEADER=>true,CURLOPT_FOLLOWLOCATION=>false,CURLOPT_TIMEOUT=>$timeout,CURLOPT_CONNECTTIMEOUT=>10,CURLOPT_LOW_SPEED_LIMIT=>1,CURLOPT_LOW_SPEED_TIME=>30,CURLOPT_HTTPHEADER=>$headers,]);
    if ($method==='POST' || $body!=='') {
        curl_setopt($ch,CURLOPT_POSTFIELDS,$body);
    }
    $raw=curl_exec($ch);
    if ($raw===false) {
        http_response_code(502);
        echo 'upstream error: '.curl_error($ch);
        curl_close($ch);
        exit;
    }
    $status=curl_getinfo($ch,CURLINFO_RESPONSE_CODE);
    $hsize=curl_getinfo($ch,CURLINFO_HEADER_SIZE);
    $rawHead=substr($raw,0,$hsize);
    $rb=substr($raw,$hsize);
    curl_close($ch);
    $rh=[];
    foreach (explode("\r\n",$rawHead) as $line) {
        if (strpos($line,':')!==false) {
            [$k,$v]=explode(':',$line,2);
            $rh[trim($k)]=trim($v);
        }
    }
    return [$status,$rh,$rb];
}

function requestEndpoint(string $host,string $path,array $params): string {
    [,,$body]=sendRequest($host,$path,'POST',['Content-Type: application/x-www-form-urlencoded'],http_build_query($params));
    return trim($body);
}

function parseColonKV(string $text): array { // read the response from the endpoint and get the items that are needed
    $parts=explode(':',$text);
    $d=[];
    for ($i=0; $i+1<count($parts); $i+=2) {
        $d[$parts[$i]]=$parts[$i+1];
    }
    return $d;
}

function lookupUser(string $username,string $key): ?string {
    $text=requestEndpoint(BOOMLINGS,'/database/getGJUsers20.php',['secret'=>COMMONSECRET,'str'=>$username]);
    return parseColonKV($text)[$key] ?? null;
}

function lookupPlayerId(string $accountId): ?string {
    $text=requestEndpoint(BOOMLINGS,'/database/getGJUserInfo20.php',['targetAccountID'=>$accountId,'secret'=>COMMONSECRET]); // also provided by getGJUsers20.php, but this one takes an account id instead of a username
    return parseColonKV($text)['2'] ?? null;
}

function sendResponse(int $status,array $headers,string $body): void {
    http_response_code($status);
    $skip=['transfer-encoding','connection','content-length','content-encoding'];
    foreach ($headers as $k=>$v) {
        if (!in_array(strtolower($k),$skip,true)) {
            header("$k: $v");
        }
    }
    header('Content-Length: '.strlen($body));
    echo $body;
}

function fixVersionKey(string $entry): string { // spoof level version requirement
    $parts=explode(':',$entry);
    for ($i=0; $i+1<count($parts); $i+=2) {
        if ($parts[$i]==='13') {
            $parts[$i+1]='19';
            break;
        }
    }
    return implode(':',$parts);
}

function injectVersionLabel(string $entry): string { // adds the level's origin gd version to the description
    $parts=explode(':',$entry);
    $n=count($parts);
    $ver=null;
    $descIdx=null;
    for ($i=0; $i<$n-1; $i+=2) {
        if ($parts[$i]==='13') $ver=VERSIONMAP[$parts[$i+1]] ?? null;
        if ($parts[$i]==='3') $descIdx=$i+1;
    }
    if ($ver!==null && $descIdx!==null) {
        $parts[$descIdx]=base64_encode(base64_decode($parts[$descIdx]).' GD Version: '.$ver);
    }
    return implode(':',$parts);
}

function writeLog(string $entry): void {
    if (LOGGING && LOGFILE!=='') {
        file_put_contents(LOGFILE,$entry,FILE_APPEND);
    }
}

$rawHost=strtolower(explode(':',$_SERVER['HTTP_HOST'] ?? '')[0]);
if ($rawHost===BOOMLINGS) {
    $target=BOOMLINGS;
} elseif ($rawHost===ROBTOPGAMES) {
    $target=ROBTOPGAMES;
} else {
    http_response_code(400);
    echo 'unknown host';
    exit;
}

$method=$_SERVER['REQUEST_METHOD'];
$uri=$_SERVER['REQUEST_URI'];
$bare=parse_url($uri,PHP_URL_PATH) ?: '/';
$body=file_get_contents('php://input');

$skipHeaders=['host','content-length','content-type','transfer-encoding','connection','proxy-connection','accept-encoding','accept','expect','user-agent'];
$fwd=[];
foreach (getallheaders() as $k=>$v) {
    if (!in_array(strtolower($k),$skipHeaders,true)) $fwd[]="$k: $v";
}

if ($method!=='POST') {
    $fwd[]='Host: '.$target;
    [$s,$rh,$rb]=sendRequest($target,$uri,$method,$fwd,$body);
    sendResponse($s,$rh,$rb);
    exit;
}

if ($target===BOOMLINGS && $bare==='/database/accounts/loginGJAccount.php') { // login fix
    parse_str($body,$loginParams);
    $userName=$loginParams['userName'] ?? '';
    $password=$loginParams['password'] ?? '';
    $udid=$loginParams['udid'] ?? '';
    $secret=$loginParams['secret'] ?? '';
    if ($userName==='' || $password==='' || $udid==='' || $secret!==ACCOUNTSECRET) { // even though were our own server, still best to implement the same restrictions as the regular server
        sendResponse(200,[],'-1');
        exit;
    }
    $userText=requestEndpoint(BOOMLINGS,'/database/getGJUsers20.php',['secret'=>COMMONSECRET,'str'=>$userName]); // loginGJAccount.php on the actual server has a stricter rate limit than the rest of the endpoints. my server kept getting rate limited, so this is a workaround. look up the user's profile by their username to get their account id and player id.
    $userKv=parseColonKV($userText);
    $accountID=$userKv['16'] ?? null;
    $playerID=$userKv['2'] ?? null;
    if ($accountID===null || $playerID===null) {
        sendResponse(200,[],'-1');
        exit;
    }
    $check=requestEndpoint(BOOMLINGS,'/database/getGJFriendRequests20.php',['secret'=>COMMONSECRET,'accountID'=>$accountID,'gjp2'=>makeGjp2($password)]); // make sure the entered credentials are actually valid before giving the response. just check the user's friend requests and make sure the server gives an actual response.
    if (trim($check)==='-1') {
        sendResponse(200,[],'-1');
        exit;
    }
    sendResponse(200,[],$accountID.','.$playerID);
    exit;
}

if (isset(ENDPOINTREWRITES[$bare])) {
    $bare=ENDPOINTREWRITES[$bare];
}
if ($bare==='/database/accounts/syncGJAccount20.php') { // 2.0 save/load endpoint rewrites
    $target=ROBTOPGAMES;
    $bare='/database/accounts/syncGJAccountNew.php';
}
if ($bare==='/database/accounts/backupGJAccount.php') {
    $target=ROBTOPGAMES;
    $bare='/database/accounts/backupGJAccountNew.php';
}

parse_str($body,$flat);
$modified=false;

if ($target===ROBTOPGAMES && in_array($bare,ROBTOPGAMESPATHS,true)) {
    if (isset($flat['password'])) {
        $flat['gjp2']=makeGjp2($flat['password']);
        unset($flat['password']);
        $modified=true;
    }
    if (isset($flat['userName'])) {
        $acc=lookupUser($flat['userName'],'16');
        if ($acc===null) {
            http_response_code(502);
            echo 'accountID lookup failed';
            exit;
        }
        unset($flat['userName']);
        $flat['accountID']=$acc;
        $modified=true;
    }
    if ($bare==='/database/accounts/syncGJAccountNew.php') { // version spoofs for load, since it won't give our data unless the version is later than or equal to the version of the client that saved the data. we don't need this for save since the server accepts it and it's best to have slightly more compatibility.
        if (isset($flat['gameVersion']) && (int)$flat['gameVersion']<22) {
            $flat['gameVersion']='22';
            $modified=true;
        }
        if (isset($flat['binaryVersion']) && (int)$flat['binaryVersion']<42) {
            $flat['binaryVersion']='47';
            $modified=true;
        }
    }
} elseif ($target===BOOMLINGS && $bare==='/database/updateGJUserScore22.php') { // patch 2.0's updateGJUserScore22.php request
    if (!isset($flat['diamonds']) || !isset($flat['accSpider']) || !isset($flat['accExplosion'])) {
        $info=parseColonKV(requestEndpoint(BOOMLINGS,'/database/getGJUserInfo20.php',['targetAccountID'=>$flat['accountID'] ?? '','secret'=>COMMONSECRET]));
        if (!isset($flat['diamonds'])) $flat['diamonds']=$info['46'] ?? '0';
        if (!isset($flat['accSpider'])) $flat['accSpider']=$info['43'] ?? '0';
        if (!isset($flat['accExplosion'])) $flat['accExplosion']=$info['48'] ?? '0';
        $flat['seed2']=makeSeed2($flat);
        $modified=true;
    }
} elseif ($target===BOOMLINGS && in_array($bare,[
    '/database/downloadGJLevel22.php','/database/getGJDailyLevel.php','/database/getGJLevels21.php',],true)) {
    if (isset($flat['gameVersion']) && (int)$flat['gameVersion']<22) { // client version spoof
        $flat['gameVersion']='22';
        $modified=true;
    }
    if (isset($flat['binaryVersion']) && (int)$flat['binaryVersion']<42) {
        $flat['binaryVersion']='47';
        $modified=true;
    }
    if ($bare==='/database/getGJDailyLevel.php' && isset($flat['weekly'])) { // rename the "weekly" param to "type", since event levels are now a thing and the server doesn't care about that parameter anymore
        $flat['type']=$flat['weekly'];
        unset($flat['weekly']);
        $modified=true;
    }
    if ($bare==='/database/getGJLevels21.php') { // adds some commands to level search so you can get access some extra stuff
        $strLower=strtolower($flat['str'] ?? '');
        $reqType=$flat['type'] ?? '';
        if ($strLower==='gdspsent' && $reqType==='0') {
            $flat['str']='';
            $flat['type']='27';
            $modified=true;
        } elseif ($strLower==='gdspdailyhistory' && $reqType==='0') {
            $flat['type']='21';
            $flat['str']='';
            $modified=true;
        } elseif ($strLower==='gdspweeklyhistory' && $reqType==='0') {
            $flat['type']='22';
            $flat['str']='';
            $modified=true;
        } elseif ($strLower==='gdspeventhistory' && $reqType==='0') {
            $flat['type']='23';
            $flat['str']='';
            $modified=true;
        }
    }
} elseif ($target===BOOMLINGS && $bare==='/database/uploadGJComment21.php') { // add chk to the comment upload request for 2.0
    if (!isset($flat['chk'])) {
        $flat['chk']=makeChk([$flat['userName'] ?? '',$flat['comment'] ?? '',$flat['levelID'] ?? '',$flat['percentage'] ?? '0',$flat['commentType'] ?? '0'],COMMENTKEY,COMMENTSALT);
        $modified=true;
    }
} elseif ($target===BOOMLINGS && $bare==='/database/deleteGJAccComment20.php') { // for some reason the server now requires a targetAccountID field too but we can just set that to whatever the accountID field is
    if (isset($flat['accountID']) && !isset($flat['targetAccountID'])) {
        $flat['targetAccountID']=$flat['accountID'];
        $modified=true;
    }
} elseif ($target===BOOMLINGS && $bare==='/database/getGJScores20.php') { // scores endpoint now requires the player id be attached on the request too for some reason ???
    if (isset($flat['accountID'])) {
        $playerId=lookupPlayerId($flat['accountID']);
        if ($playerId===null) {
            http_response_code(502);
            echo 'player ID lookup failed';
            exit;
        }
        $flat['udid']=$playerId;
        $modified=true;
    }
}

$newBody=$modified ? http_build_query($flat) : $body;
$fwd[]='Host: '.$target;
$fwd[]='Content-Type: application/x-www-form-urlencoded';
[$status,$respHeaders,$respBody]=sendRequest($target,$bare,'POST',$fwd,$newBody);

if ($target===BOOMLINGS && $bare==='/database/getAccountURL.php') {
    $respBody=str_replace('https://','http://',$respBody); // to allow it to go through the proxy again
}

if ($target===BOOMLINGS && in_array($bare,[
    '/database/downloadGJLevel22.php','/database/getGJLevels21.php',],true)) {
    if ($bare==='/database/downloadGJLevel22.php') {
        $parts=explode('#',$respBody,2);
        $parts[0]=fixVersionKey(injectVersionLabel($parts[0]));
        $respBody=implode('#',$parts);
    } else {
        $sections=explode('#',$respBody);
        $levels=explode('|',$sections[0]);
        foreach ($levels as &$lv) $lv=fixVersionKey($lv);
        unset($lv);
        $sections[0]=implode('|',$levels);
        $respBody=implode('#',$sections);
    }
}

writeLog('http://'.$target.$bare.' '.$status."\n".$newBody."\n".$respBody."\n---\n");
sendResponse($status,$respHeaders,$respBody);
