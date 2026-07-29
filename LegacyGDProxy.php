<?php
const LOGGING=false;
const LOGMODE=''; // txt or sql. these fields aren't needed if logging is set to false.
const LOGFILE=''; // path to txt file for logs. txt logs are just everything stored in a new set of lines per log entry. can get messy pretty quickly.
const LOGDB=''; // path to sqlite database for logs. sql logs are stored in these columns: id (log entry number), ts (unix timestamp), ip (the client's ip address), target (host), path, status, request_body, response_body in a table called "logs".
const LOGMAXBYTES=300*1024*1024; // storage size quota (in bytes) for the log file. oldest log entries will be trimmed when space is exceeded.
const LOGSIZE_CHECK_CHANCE=12; // roughly how often the script will check the log file size. the denominator under 1. so for example 20 means 1 in 20 chance on each log entry. less is more chance.
const NGSOLVEPATH=''; // THIS IS REQUIRED!! path to the ngsolve.py file.
// these lines shouldn't need to be touched, but idk perhaps you will need to for some reason
const BOOMLINGS='www.boomlings.com';
const ROBTOPGAMES='www.robtopgames.org';
const COMMONSECRET='Wmfd2893gb7';
const ACCOUNTSECRET='Wmfv3899gc9';
const LEVELSECRET='Wmfv2898gc9';
const MODSECRET='Wmfp3879gc3';
const GJP2SALT='mI29fmAnxgTs';
const SEED2SALT='xI35fsAapCRg';
const SEED2KEY='85271';
const COMMENTKEY='29481';
const COMMENTSALT='xPT6iUrtws0J';
const LEVELPASSKEY='26364';
const ROBTOPGAMESPATHS=[
    '/database/accounts/backupGJAccountNew.php','/database/accounts/syncGJAccountNew.php',];
const ENDPOINTREWRITES=[
    '/database/updateGJUserScore21.php'=>'/database/updateGJUserScore22.php','/database/downloadGJLevel21.php'=>'/database/downloadGJLevel22.php','/database/downloadGJLevel20.php'=>'/database/downloadGJLevel22.php','/database/getGJComments20.php'=>'/database/getGJComments21.php','/database/likeGJItem20.php'=>'/database/likeGJItem211.php','/database/uploadGJComment20.php'=>'/database/uploadGJComment21.php','/database/rateGJStars20.php'=>'/database/rateGJStars211.php','/database/getGJLevels19.php'=>'/database/getGJLevels21.php','/database/updateGJUserScore19.php'=>'/database/updateGJUserScore22.php','/database/getGJMapPacks.php'=>'/database/getGJMapPacks21.php','/database/downloadGJLevel19.php'=>'/database/downloadGJLevel22.php','/database/rateGJLevel.php'=>'/database/rateGJStars211.php','/database/getGJComments19.php'=>'/database/getGJComments21.php','/database/uploadGJComment19.php'=>'/database/uploadGJComment21.php','/database/uploadGJLevel19.php'=>'/database/uploadGJLevel21.php','/database/deleteGJLevelUser19.php'=>'/database/deleteGJLevelUser20.php','/database/updateGJDesc19.php'=>'/database/updateGJDesc20.php','/database/deleteGJComment19.php'=>'/database/deleteGJComment20.php','/database/getGJLevels.php'=>'/database/getGJLevels21.php','/database/downloadGJLevel.php'=>'/database/downloadGJLevel22.php','/database/likeGJLevel.php'=>'/database/likeGJItem211.php','/database/uploadGJLevel.php'=>'/database/uploadGJLevel21.php','/database/updateGJUserScore.php'=>'/database/updateGJUserScore22.php','/database/getGJScores.php'=>'/database/getGJScores20.php','/database/rateGJStars.php'=>'/database/rateGJStars211.php','/database/getGJScores19.php'=>'/database/getGJScores20.php','/database/getGJComments.php'=>'/database/getGJComments21.php','/database/uploadGJComment.php'=>'/database/uploadGJComment21.php',]; // why are there so many
const SECRETS=[ // a quick thing to verify secrets to cut down on spam
    '/database/deleteGJAccComment20.php'=>COMMONSECRET,
    '/database/deleteGJComment20.php'=>COMMONSECRET,
    '/database/getGJAccountComments20.php'=>COMMONSECRET,
    '/database/getGJCommentHistory.php'=>COMMONSECRET,
    '/database/getGJComments21.php'=>COMMONSECRET,
    '/database/uploadGJAccComment20.php'=>COMMONSECRET,
    '/database/uploadGJComment21.php'=>COMMONSECRET,
    '/database/downloadGJLevel22.php'=>COMMONSECRET,
    '/database/getGJDailyLevel.php'=>COMMONSECRET,
    '/database/getGJGauntlets21.php'=>COMMONSECRET,
    '/database/getGJLevelScores211.php'=>COMMONSECRET,
    '/database/getGJLevelScoresPlat.php'=>COMMONSECRET,
    '/database/getGJLevels21.php'=>COMMONSECRET,
    '/database/getGJMapPacks21.php'=>COMMONSECRET,
    '/database/rateGJStars211.php'=>COMMONSECRET,
    '/database/reportGJLevel.php'=>COMMONSECRET,
    '/database/updateGJDesc20.php'=>COMMONSECRET,
    '/database/uploadGJLevel21.php'=>COMMONSECRET,
    '/database/getGJLevelLists.php'=>COMMONSECRET,
    '/database/uploadGJLevelList.php'=>COMMONSECRET,
    '/database/getAccountURL.php'=>COMMONSECRET,
    '/database/getSaveData.php'=>COMMONSECRET,
    '/database/likeGJItem211.php'=>COMMONSECRET,
    '/database/requestUserAccess.php'=>COMMONSECRET,
    '/database/restoreGJItems.php'=>COMMONSECRET,
    '/database/getGJChallenges.php'=>COMMONSECRET,
    '/database/getGJRewards.php'=>COMMONSECRET,
    '/database/getGJSecretReward.php'=>COMMONSECRET,
    '/database/acceptGJFriendRequest20.php'=>COMMONSECRET,
    '/database/blockGJUser20.php'=>COMMONSECRET,
    '/database/deleteGJFriendRequests20.php'=>COMMONSECRET,
    '/database/deleteGJMessages20.php'=>COMMONSECRET,
    '/database/downloadGJMessage20.php'=>COMMONSECRET,
    '/database/getGJFriendRequests20.php'=>COMMONSECRET,
    '/database/getGJMessages20.php'=>COMMONSECRET,
    '/database/getGJUserList20.php'=>COMMONSECRET,
    '/database/readGJFriendRequest20.php'=>COMMONSECRET,
    '/database/removeGJFriend20.php'=>COMMONSECRET,
    '/database/unblockGJUser20.php'=>COMMONSECRET,
    '/database/uploadFriendRequest20.php'=>COMMONSECRET,
    '/database/uploadGJMessage20.php'=>COMMONSECRET,
    '/database/getGJSongInfo.php'=>COMMONSECRET,
    '/database/getGJTopArtists.php'=>COMMONSECRET,
    '/database/getGJScores20.php'=>COMMONSECRET,
    '/database/getGJCreators.php'=>COMMONSECRET,
    '/database/getGJCreators19.php'=>COMMONSECRET,
    '/database/getGJUserInfo20.php'=>COMMONSECRET,
    '/database/getGJUsers20.php'=>COMMONSECRET,
    '/database/updateGJUserScore22.php'=>COMMONSECRET,
    '/database/accounts/backupGJAccountNew.php'=>ACCOUNTSECRET,
    '/database/accounts/loginGJAccount.php'=>ACCOUNTSECRET,
    '/database/accounts/registerGJAccount.php'=>ACCOUNTSECRET,
    '/database/accounts/syncGJAccountNew.php'=>ACCOUNTSECRET,
    '/database/updateGJAccSettings20.php'=>ACCOUNTSECRET,
    '/database/exitMPLobby.php'=>ACCOUNTSECRET,
    '/database/joinMPLobby.php'=>ACCOUNTSECRET,
    '/database/uploadMPComment.php'=>ACCOUNTSECRET,
    '/database/deleteGJLevelUser20.php'=>LEVELSECRET,
    '/database/deleteGJLevelList.php'=>LEVELSECRET,
    '/database/rateGJDemon21.php'=>MODSECRET,
    '/database/suggestGJStars20.php'=>MODSECRET,
];
const VERSIONMAP=[ // map used for the version in the desc
    '1'=>'1.0','2'=>'1.1','3'=>'1.2','4'=>'1.3','5'=>'1.4','6'=>'1.5','7'=>'1.6','10'=>'1.7','18'=>'1.8','19'=>'1.9','20'=>'2.0','21'=>'2.1','22'=>'2.2',];
function xorCipher(string $s,string $key): string {
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
function makeSeed2(array $flat): string { // specifically to get update score working on 2.0, since it lacks fields the server now requires, and as a result we need to make a new signature to validate the new request. this is pretty similar to chk.
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
    $timeout=(in_array($path,ROBTOPGAMESPATHS,true) || $path==='/database/getGJLevels21.php') ? 60 : 10; // increase the timeout for save/load and level search since those can take longer
    $ch=curl_init();
    curl_setopt_array($ch,[
        CURLOPT_URL=>'http://'.$host.$path,CURLOPT_RESOLVE=>[$host.':80:'.$ip],CURLOPT_CUSTOMREQUEST=>$method,CURLOPT_RETURNTRANSFER=>true,CURLOPT_HEADER=>true,CURLOPT_FOLLOWLOCATION=>false,CURLOPT_TIMEOUT=>$timeout,CURLOPT_CONNECTTIMEOUT=>10,CURLOPT_LOW_SPEED_LIMIT=>1,CURLOPT_LOW_SPEED_TIME=>30,CURLOPT_HTTPHEADER=>$headers,]);
    if ($method==='POST' || $body!=='') {
        curl_setopt($ch,CURLOPT_POSTFIELDS,$body);
    }
    $raw=curl_exec($ch);
    if ($raw===false) {
        writeLog($host,$path,502,$body,'upstream curl error: '.curl_error($ch));
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
function lookupUserByAccountID(string $accountId,string $key): ?string {
    $text=requestEndpoint(BOOMLINGS,'/database/getGJUserInfo20.php',['targetAccountID'=>$accountId,'secret'=>COMMONSECRET]); // similar response to getGJUsers20.php, but this one takes an accountID instead of a username
    return parseColonKV($text)[$key] ?? null;
}
function rewriteCreatorsRequest(array $flat): array { // translates getGJCreators to a getGJScores request for creators since getGJCreators doesn't exist anymore
    $flat['type']='creators';
    $flat['count']='100';
    return $flat;
}
function parseTildeKV(string $text): array {
    $parts=explode('~',$text);
    $d=[];
    for ($i=0; $i+1<count($parts); $i+=2) {
        $d[$parts[$i]]=$parts[$i+1];
    }
    return $d;
}
function downgradeCommentsResponse(string $respBody,bool $decodeCommentText): string { // to satisfy 2.0 and earlier clients since they expect different fields for comment data
    $parts=explode('#',$respBody,2);
    $commentsPart=$parts[0];
    $rest=$parts[1] ?? '';
    $comments=explode('|',$commentsPart);
    $newComments=[];
    $userstring='';
    $seen=[];
    foreach ($comments as $c) {
        if ($c==='') continue;
        $halves=explode(':',$c,2);
        $commentHalf=$halves[0];
        $userHalf=$halves[1] ?? '';
        if ($decodeCommentText) {
            $ckv=parseTildeKV($commentHalf);
            if (isset($ckv['2'])) {
                $ckv['2']=str_replace([':','|','~','#'],'',base64_decode($ckv['2']));
                $rebuilt='';
                foreach ($ckv as $k=>$v) {
                    $rebuilt.=$k.'~'.$v.'~';
                }
                $commentHalf=rtrim($rebuilt,'~');
            }
        }
        $newComments[]=$commentHalf;
        if ($userHalf!=='') {
            $ckv2=parseTildeKV($commentHalf);
            $ukv=parseTildeKV($userHalf);
            $userID=$ckv2['3'] ?? '';
            $username=$ukv['1'] ?? '';
            $extID=$ukv['16'] ?? '0';
            if (!isset($seen[$userID])) {
                $seen[$userID]=true;
                $userstring.=$userID.':'.$username.':'.$extID.'|';
            }
        }
    }
    $userstring=rtrim($userstring,'|');
    return implode('|',$newComments).'#'.$userstring.'#'.$rest;
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
function getLogDb(): ?PDO {
    static $db=null;
    static $failed=false;
    if ($db!==null) return $db;
    if ($failed) return null;
    try {
        $db=new PDO('sqlite:'.LOGDB);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $db->exec('PRAGMA journal_mode=WAL');
        $db->exec('PRAGMA synchronous=NORMAL');
        $db->exec('PRAGMA busy_timeout=5000');
        $db->exec('PRAGMA auto_vacuum=INCREMENTAL');
        $db->exec('CREATE TABLE IF NOT EXISTS logs (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            ts INTEGER NOT NULL,
            ip TEXT,
            target TEXT,
            path TEXT,
            status INTEGER,
            request_body TEXT,
            response_body TEXT
        )');
        $existingCols=$db->query('PRAGMA table_info(logs)')->fetchAll(PDO::FETCH_COLUMN,1);
        if (!in_array('ip',$existingCols,true)) {
            $db->exec('ALTER TABLE logs ADD COLUMN ip TEXT');
        }
        $db->exec('CREATE INDEX IF NOT EXISTS idx_logs_ts ON logs(ts)');
        $db->exec('CREATE INDEX IF NOT EXISTS idx_logs_ip ON logs(ip)');
    } catch (Throwable $e) {
        $db=null;
        $failed=true;
        return null;
    }
    return $db;
}
function pruneLogDbIfNeeded(PDO $db): void {
    clearstatcache(true,LOGDB);
    $size=@filesize(LOGDB);
    if ($size===false || $size<LOGMAXBYTES) return;
    try {
        $count=(int)$db->query('SELECT COUNT(*) FROM logs')->fetchColumn();
        if ($count===0) return;
        $deleteBatch=max(100,intval($count*0.1));
        $db->exec('DELETE FROM logs WHERE id IN (SELECT id FROM logs ORDER BY ts ASC LIMIT '.$deleteBatch.')');
        $db->exec('PRAGMA incremental_vacuum(2000)');
    } catch (Throwable $e) {
    }
}
function pruneTxtLogIfNeeded(): void {
    clearstatcache(true,LOGFILE);
    $size=@filesize(LOGFILE);
    if ($size===false || $size<LOGMAXBYTES) return;
    $keepBytes=intval(LOGMAXBYTES*0.8);
    $src=@fopen(LOGFILE,'rb');
    if ($src===false) return;
    fseek($src,-$keepBytes,SEEK_END);
    $tmp=LOGFILE.'.tmp';
    $dst=@fopen($tmp,'wb');
    if ($dst===false) { fclose($src); return; }
    stream_copy_to_stream($src,$dst);
    fclose($src);
    fclose($dst);
    @rename($tmp,LOGFILE);
}
function writeLog(string $target,string $path,int $status,string $reqBody,string $respBody): void {
    if (!LOGGING) return;
    $ip=$_SERVER['REMOTE_ADDR'] ?? '';
    if (LOGMODE==='txt') {
        writeLogTxt($ip,$target,$path,$status,$reqBody,$respBody);
    } else if (LOGMODE==='sql') {
        writeLogSql($ip,$target,$path,$status,$reqBody,$respBody);
    }
}
function writeLogTxt(string $ip,string $target,string $path,int $status,string $reqBody,string $respBody): void {
    $entry=$ip.' http://'.$target.$path.' '.$status."\n".$reqBody."\n".$respBody."\n---\n";
    @file_put_contents(LOGFILE,$entry,FILE_APPEND|LOCK_EX);
    if (random_int(1,LOGSIZE_CHECK_CHANCE)===1) {
        pruneTxtLogIfNeeded();
    }
}
function writeLogSql(string $ip,string $target,string $path,int $status,string $reqBody,string $respBody): void {
    $db=getLogDb();
    if ($db===null) return;
    try {
        $stmt=$db->prepare('INSERT INTO logs (ts,ip,target,path,status,request_body,response_body) VALUES (:ts,:ip,:target,:path,:status,:req,:resp)');
        $stmt->execute([
            ':ts'=>time(),
            ':ip'=>$ip,
            ':target'=>$target,
            ':path'=>$path,
            ':status'=>$status,
            ':req'=>$reqBody,
            ':resp'=>$respBody,
        ]);
        if (random_int(1,LOGSIZE_CHECK_CHANCE)===1) {
            pruneLogDbIfNeeded($db);
        }
    } catch (Throwable $e) {
    }
}
function respondAndExit(int $status,array $headers,string $body,string $target='',string $bare='',string $reqBody=''): void {
    if ($target!=='' && $bare!=='') {
        writeLog($target,$bare,$status,$reqBody,$body);
    }
    sendResponse($status,$headers,$body);
    exit;
}
function fixAutoLevelDifficulty(string $entry): string {
    $parts=explode(':',$entry);
    $n=count($parts);
    $numIdx=null;
    for ($i=0; $i<$n-1; $i+=2) {
        if ($parts[$i]==='9') $numIdx=$i+1;
    }
    if ($numIdx!==null && (int)$parts[$numIdx]<0) {
        $parts[$numIdx]='10';
    }
    return implode(':',$parts);
}
function fixVersionKey(string $entry): string { // spoof level version requirement to 1.0
    $parts=explode(':',$entry);
    for ($i=0; $i+1<count($parts); $i+=2) {
        if ($parts[$i]==='13') {
            $parts[$i+1]='1';
            break;
        }
    }
    return implode(':',$parts);
}
function injectVersionLabel(string $entry,bool $skipEncode=false): string { // modify the response to have gd version as well as the level password
    $parts=explode(':',$entry);
    $n=count($parts);
    $ver=null;
    $descIdx=null;
    $pass=null;
    $passIdx=null;
    $levelStringIdx=null;
    for ($i=0; $i<$n-1; $i+=2) {
        if ($parts[$i]==='13') $ver=VERSIONMAP[$parts[$i+1]] ?? null;
        if ($parts[$i]==='3') $descIdx=$i+1;
        if ($parts[$i]==='4') $levelStringIdx=$i+1;
        if ($parts[$i]==='27' && $parts[$i+1]!=='Aw==' && $parts[$i+1]!=='0') {
            $passIdx=$i+1;
            $decodedB64=base64_decode($parts[$i+1]);
            if ($decodedB64!==false) {
                $pass=substr(xorCipher($decodedB64,LEVELPASSKEY),1);
            }
        }
    }
    if ($skipEncode && $levelStringIdx!==null) { // return a decoded version of the level string for older versions
        $standardB64=str_replace(['-','_'],['+','/'],$parts[$levelStringIdx]);
        $decoded=base64_decode($standardB64);
        if ($decoded!==false) {
            $decompressed=@gzuncompress($decoded);
            if ($decompressed!==false) {
                $parts[$levelStringIdx]=$decompressed;
            }
        }
    }
    if ($skipEncode && $descIdx!==null) {
        $parts[$descIdx]=str_replace([':','|','~','#'],'',base64_decode($parts[$descIdx]));
    }
    if ($skipEncode && $passIdx!==null && $pass!==null) {
        $parts[$passIdx]=$pass;
    }
    if ($ver!==null && $descIdx!==null) {
        $suffix=' GD Version '.$ver;
        if ($pass!==null) $suffix.=', Password '.$pass;
        if ($skipEncode) {
            $parts[$descIdx]=$parts[$descIdx].$suffix;
        } else {
            $parts[$descIdx]=base64_encode(base64_decode($parts[$descIdx]).$suffix);
        }
    }
    return implode(':',$parts);
}
function ngGet(string $url,string $jar): string { // for ng guard bypass challenge endpoint
    $ch=curl_init($url);
    curl_setopt_array($ch,[CURLOPT_RETURNTRANSFER=>true,CURLOPT_FOLLOWLOCATION=>true,CURLOPT_TIMEOUT=>15,CURLOPT_ENCODING=>'',CURLOPT_COOKIEFILE=>$jar,CURLOPT_COOKIEJAR=>$jar,CURLOPT_HTTPHEADER=>['User-Agent: Mozilla/5.0']]);
    $r=curl_exec($ch);
    curl_close($ch);
    return $r ?: '';
}
function ngPost(string $url,string $body,string $jar): string { // also for ng guard but to send back the challenge data to the verify endpoint
    $ch=curl_init($url);
    curl_setopt_array($ch,[CURLOPT_RETURNTRANSFER=>true,CURLOPT_TIMEOUT=>15,CURLOPT_ENCODING=>'',CURLOPT_POST=>true,CURLOPT_POSTFIELDS=>$body,CURLOPT_COOKIEFILE=>$jar,CURLOPT_COOKIEJAR=>$jar,CURLOPT_HTTPHEADER=>['User-Agent: Mozilla/5.0','Content-Type: application/json']]);
    $r=curl_exec($ch);
    curl_close($ch);
    return $r ?: '';
}
function ngLeadingZeroBits(string $data): int {
    $z=0;
    for ($i=0;$i<strlen($data);$i++) {
        $b=ord($data[$i]);
        if ($b===0) { $z+=8; continue; }
        for ($bit=7;$bit>=0;$bit--) {
            if ($b & (1<<$bit)) break;
            $z++;
        }
        break;
    }
    return $z;
}
function solveNGGuard(string $jar): bool { // this is how the ng guard is processed. it's surprisingly simple.
    $c=json_decode(ngGet('https://www.newgrounds.com/_guard/api/v1/challenge',$jar),true);
    if (!$c || !isset($c['payload'])) return false;
    $b64=strtr($c['payload'],'-_','+/');
    $b64.=str_repeat('=',(4-strlen($b64)%4)%4);
    $payload=base64_decode($b64);
    $prefix=$payload.':';
    $start=microtime(true);
    $nonce=null;
    $ms=0;
    if ($c['algo']==='argon2id') {
        $tmp=tempnam(sys_get_temp_dir(),'ngc_');
        file_put_contents($tmp,json_encode($c));
        $result=shell_exec('python3 '.escapeshellarg(NGSOLVEPATH).' < '.escapeshellarg($tmp).' 2>/dev/null');
        @unlink($tmp);
        $solved=json_decode(trim($result ?: ''),true);
        if (!$solved || !isset($solved['nonce'])) return false;
        $nonce=$solved['nonce'];
        $ms=$solved['solveTimeMs'] ?? 0;
    } else {
        for ($i=0;$i<10000000;$i++) {
            if (ngLeadingZeroBits(hash('sha256',$prefix.$i,true))>=$c['bits']) {
                $nonce=strval($i);
                $ms=intval((microtime(true)-$start)*1000);
                break;
            }
        }
        if ($nonce===null) return false;
    }
    $body=['algo'=>$c['algo'],'bits'=>$c['bits'],'demo'=>false,'nonce'=>$nonce,'payload'=>$c['payload'],'sig'=>$c['sig'],'solveTimeMs'=>$ms];
    if ($c['algo']==='argon2id' && isset($c['params'])) $body['params']=$c['params'];
    $r=json_decode(ngPost('https://www.newgrounds.com/_guard/api/v1/verify',json_encode($body),$jar),true);
    return $r['ok'] ?? false;
}
function fetchNGSongInfo(string $songID): ?string { // scrape the audio listen page's HTML body for the info we need
    $jar=sys_get_temp_dir().'/LegacyGDProxy_ng.txt';
    $html=ngGet('https://www.newgrounds.com/audio/listen/'.$songID,$jar);
    if (strpos($html,'_guard')!==false) {
        if (!solveNGGuard($jar)) return null;
        $html=ngGet('https://www.newgrounds.com/audio/listen/'.$songID,$jar);
    }
    if (!preg_match('/og:audio"\s+content="([^"]+)"/',$html,$m)) return null; $mp3=htmlspecialchars_decode($m[1]);
    $songName='Unknown';
    if (preg_match_all('/<div class="item-user">.*?<h4>\s*<a href="https?:\/\/[a-z0-9\-]+\.newgrounds\.com">([^<]+)<\/a>.*?<div class="role">\s*<em>([^<]+)<\/em>/is', $html, $matches, PREG_SET_ORDER)) {
    	$artistName = 'Unknown';
    	foreach ($matches as $match) {
            $name = trim($match[1]);
            $role = trim($match[2]);
            if (stripos($role, 'Artist') !== false) {
            	$artistName = $name;
            	break;
            }
    	}
    } else {
    	$artistName = 'Unknown';
    }
    $artistID=null;
    if (preg_match('/<title>([^<]+)/',$html,$m)) {
        $t=trim(preg_replace('/\s*[-|]?\s*Newgrounds\.com\s*$/','',$m[1]));
        if (preg_match('/^(.+?)\s+by\s+(.+)$/',$t,$m2)) {
            $songName=$m2[2].' - '.$m2[1];
            $artistName=$m2[2];
        } else {
            $songName=$t;
        }
    }
    if (preg_match('/"userId"\s*:\s*(\d+)/',$html,$m)) $artistID=(int)$m[1];
    elseif (preg_match('/data-user-id="(\d+)"/',$html,$m)) $artistID=(int)$m[1];
    $ch=curl_init($mp3);
    curl_setopt_array($ch,[CURLOPT_NOBODY=>true,CURLOPT_RETURNTRANSFER=>true,CURLOPT_TIMEOUT=>5,CURLOPT_FOLLOWLOCATION=>true,CURLOPT_HTTPHEADER=>['User-Agent: Mozilla/5.0']]);
    curl_exec($ch);
    $size=curl_getinfo($ch,CURLINFO_CONTENT_LENGTH_DOWNLOAD);
    curl_close($ch);
    $sizeMB=$size>0 ? round($size/1048576,2) : 0;
    return '1~|~'.$songID.'~|~2~|~'.$songName.'~|~3~|~'.$artistID.'~|~4~|~'.$artistName.'~|~5~|~'.$sizeMB.'~|~6~|~~|~10~|~'.urlencode($mp3);
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
$uaWhitelisted=($target===ROBTOPGAMES) || ($target===BOOMLINGS && strpos($bare,'/database/accounts/')===0) || ($target===BOOMLINGS && $bare==='/database/');
if (!$uaWhitelisted && ($_SERVER['HTTP_USER_AGENT'] ?? '')) { // spam protection, but whitelist the account related pages as well as the default /database/ page, which is what the actual server does
    writeLog($target,$bare,403,$body,'blocked: user-agent present: '.($_SERVER['HTTP_USER_AGENT'] ?? ''));
    http_response_code(403);
    header('Content-Type: text/plain');
    exit;
}
$skipHeaders=['host','content-length','content-type','transfer-encoding','connection','proxy-connection','accept-encoding','accept','expect','user-agent'];
$fwd=[];
foreach (getallheaders() as $k=>$v) {
    if (!in_array(strtolower($k),$skipHeaders,true)) $fwd[]="$k: $v";
}
if ($method!=='POST') { // GET requests don't really matter here, since they're not used by GD. we're just gonna bypass them in case someone wants to access the account management pages or smth.
    $fwd[]='Host: '.$target;
    [$s,$rh,$rb]=sendRequest($target,$uri,$method,$fwd,$body);
    respondAndExit($s,$rh,$rb,$target,$uri,$body);
}
if ($target===BOOMLINGS && $bare==='/database/accounts/loginGJAccount.php') { // login fix
    parse_str($body,$loginParams);
    $userName=$loginParams['userName'] ?? '';
    $password=$loginParams['password'] ?? '';
    $udid=$loginParams['udid'] ?? '';
    $secret=$loginParams['secret'] ?? '';
    if ($userName==='' || $password==='' || $udid==='' || $secret!==SECRETS[$bare]) { // even though we're our own server, still best to implement the same restrictions as the regular server just in case to prevent spam. those being: udid must be present and non-empty, but the value doesn't matter. same goes for username and password.
        respondAndExit(200,[],'-1',$target,$bare,$body);
    }
    $userText=requestEndpoint(BOOMLINGS,'/database/getGJUsers20.php',['secret'=>COMMONSECRET,'str'=>$userName]); // loginGJAccount.php on the actual server has a stricter rate limit than the rest of the endpoints. my server kept getting rate limited, so this is a workaround. look up the user's profile by their username to get their account id and player id. this is also to check if an account with that username actually exists. otherwise, reject the login request immediately without checking the password.
    $userKv=parseColonKV($userText);
    $accountID=$userKv['16'] ?? null;
    $playerID=$userKv['2'] ?? null;
    if ($accountID===null || $playerID===null) {
        respondAndExit(200,[],'-1',$target,$bare,$body);
    }
    $check=requestEndpoint(BOOMLINGS,'/database/getGJFriendRequests20.php',['secret'=>COMMONSECRET,'accountID'=>$accountID,'gjp2'=>makeGjp2($password)]); // make sure the entered credentials are actually valid before giving a successful response. just check the user's friend requests (or messages or whatever can also work) and make sure the server responds with the requested data instead of an error.
    if (trim($check)==='-1') {
        respondAndExit(200,[],'-1',$target,$bare,$body);
    }
    respondAndExit(200,[],$accountID.','.$playerID,$target,$bare,$body);
}
if (isset(ENDPOINTREWRITES[$bare])) { // modify the request's url if it's inside the rewrites array
    $bare=ENDPOINTREWRITES[$bare];
}
// 2.0/1.9 save/load endpoint rewrites
if ($bare==='/database/accounts/syncGJAccount20.php') {
    $target=ROBTOPGAMES;
    $bare='/database/accounts/syncGJAccountNew.php';
}
if ($bare==='/database/accounts/syncGJAccount.php') {
    $target=ROBTOPGAMES;
    $bare='/database/accounts/syncGJAccountNew.php';
}
if ($bare==='/database/accounts/backupGJAccount.php') {
    $target=ROBTOPGAMES;
    $bare='/database/accounts/backupGJAccountNew.php';
}
parse_str($body,$flat);
$origGameVersion=$flat['gameVersion'] ?? null;
$origBinaryVersion=$flat['binaryVersion'] ?? null;
if (isset(SECRETS[$bare]) && ($flat['secret'] ?? '')!==SECRETS[$bare]) { // secret check, return -1 if invalid
    respondAndExit(200,[],'-1',$target,$bare,$body);
}
$modified=false;
if ($target===ROBTOPGAMES && in_array($bare,ROBTOPGAMESPATHS,true)) {
    if (isset($flat['password'])) { // modify save/load to use accountID and gjp2 rather than userName and password, this is now necessary as of around march 2026
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
        if (!isset($flat['gameVersion']) || (int)$flat['gameVersion']<22) {
            $flat['gameVersion']='22';
            $modified=true;
        }
        if (!isset($flat['binaryVersion']) || (int)$flat['binaryVersion']<42) {
            $flat['binaryVersion']='47';
            $modified=true;
        }
    }
// updateGJUserScore modifications
} elseif ($target===BOOMLINGS && $bare==='/database/updateGJUserScore22.php') {
    if (isset($flat['accountID']) && $flat['accountID']==='0') { // remove the accountID parameter if it's equal to 0 to not confuse the rest of this code
        unset($flat['accountID']);
        $modified=true;
    }
    if (!isset($flat['gjp']) && !isset($flat['gjp2']) && !isset($flat['accountID'])) { // since 1.9 and earlier don't send user/pass and instead rely on udid, it obviously won't be able to update your score. instead just return 1 to let the client continue without actually updating the score.
        respondAndExit(200,[],'1',$target,$bare,$body);
    }
    if (!isset($flat['diamonds']) || !isset($flat['accSpider']) || !isset($flat['accExplosion'])) { // 2.0 will fail to update score by default because the server now requires these 3 fields. just setting them to 0 is lame, so what this does is it takes whatever stats are currently on your profile and uses those.
        $info=parseColonKV(requestEndpoint(BOOMLINGS,'/database/getGJUserInfo20.php',['targetAccountID'=>$flat['accountID'] ?? '','secret'=>COMMONSECRET]));
        if (!isset($flat['diamonds'])) $flat['diamonds']=$info['46'] ?? '0';
        if (!isset($flat['accSpider'])) $flat['accSpider']=$info['43'] ?? '0';
        if (!isset($flat['accExplosion'])) $flat['accExplosion']=$info['48'] ?? '0';
        $flat['seed2']=makeSeed2($flat); // we'll need to then remake the seed2 because the current one will no longer be valid
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
    if ($bare==='/database/getGJDailyLevel.php' && isset($flat['weekly']) && $flat['weekly']==1) { // if weekly is set to 1, remove it and instead add type=1, since event levels are now a thing and the server wants type=1 for weekly now instead of weekly=1.
        $flat['type']=1;
        unset($flat['weekly']);
        $modified=true;
    }
    if ($bare==='/database/getGJLevels21.php') { // adds some commands to level search so you can get access some extra stuff like safes and sent levels
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
        if (($origGameVersion===null || (int)$origGameVersion<=19) && isset($flat['page']) && (int)$flat['page']>0 && ($flat['total'] ?? '0')!=='9999') { // fixes a bug on older versions that causes the search results to "load" infinitely because the total value wasn't right and causing the server to never respond back
            $flat['total']='9999';
            $modified=true;
        }
    }
} elseif ($target===BOOMLINGS && $bare==='/database/uploadGJComment21.php') { // add chk to the comment upload request for 2.0 since i guess it wasn't required back then
    if (!isset($flat['chk'])) {
        $flat['chk']=makeChk([$flat['userName'] ?? '',$flat['comment'] ?? '',$flat['levelID'] ?? '',$flat['percentage'] ?? '0',$flat['commentType'] ?? '0'],COMMENTKEY,COMMENTSALT);
        $modified=true;
    }
} elseif ($target===BOOMLINGS && $bare==='/database/deleteGJAccComment20.php') { // for some reason the server now requires a targetAccountID field too but we can just set that to whatever the accountID field is, unless a targetAccountID field is already present
    if (isset($flat['accountID']) && !isset($flat['targetAccountID'])) {
        $flat['targetAccountID']=$flat['accountID'];
        $modified=true;
    }
} elseif ($target===BOOMLINGS && ($bare==='/database/getGJCreators.php' || $bare==='/database/getGJCreators19.php')) {
    $bare='/database/getGJScores20.php';
    $flat=rewriteCreatorsRequest($flat);
    $modified=true;
} elseif ($target===BOOMLINGS && $bare==='/database/getGJScores20.php') { // scores endpoint now requires the player id be attached on the request too for some reason ???
    if (isset($flat['accountID']) && $flat['accountID']==='0') {
        unset($flat['accountID']);
        $modified=true;
    } elseif (isset($flat['accountID'])) {
        $playerId=lookupUserByAccountID($flat['accountID'],'2');
        if ($playerId===null) {
            respondAndExit(200,[],'-1',$target,$bare,$body);
        }
        $flat['udid']=$playerId;
        $modified=true;
    }
}
$musicLibUrl = null;
if ($target===BOOMLINGS&&$bare==='/database/getGJSongInfo.php') { // add support for NONG songs, such as music library, NCS, and Chompo. newgrounds audio ids are capped at 7 digits (i think? this would be bad if that's wrong.), and music library song ids are always 8 digits or more because of the offset.
    $songID=$flat['songID']??'';
    if (strlen($songID)>=8&&ctype_digit($songID)) { // if the song id is 8 digits or more, it's a NONG. so we just put it at the end of the music library CDN's URL. boomlings.dev says it's followed by .mp3, but from what i've seen, the songs are .ogg. just test them both to be safe, and if one of them hits, return it.
        $cdnBase='http://geometrydashfiles.b-cdn.net/music/'.$songID;
        foreach (['.ogg','.mp3'] as $ext) {
            $ch = curl_init($cdnBase.$ext);
            curl_setopt_array($ch,[
                CURLOPT_NOBODY => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 5,
                CURLOPT_FOLLOWLOCATION => true,
            ]);
            curl_exec($ch);
            $code=curl_getinfo($ch,CURLINFO_RESPONSE_CODE);
            curl_close($ch);
            if ($code===200) {
                $musicLibUrl=$cdnBase.$ext;
                break;
            }
        }
        if ($musicLibUrl===null) {
            respondAndExit(200,[],'-1',$target,$bare,$body);
        }
    }
}
$newBody=$modified ? http_build_query($flat) : $body;
$fwd[]='Host: '.$target;
$fwd[]='Content-Type: application/x-www-form-urlencoded';
[$status,$respHeaders,$respBody]=sendRequest($target,$bare,'POST',$fwd,$newBody);
if ($target===BOOMLINGS && $bare==='/database/getAccountURL.php') {
    $respBody=str_replace('https://','http://',$respBody); // to allow it to go through the proxy again
}
// apply desc modifications and tweaks for old picky versions
if ($target===BOOMLINGS && in_array($bare,[
    '/database/downloadGJLevel22.php','/database/getGJLevels21.php',],true)) {
    if ($bare==='/database/downloadGJLevel22.php') {
        $parts=explode('#',$respBody,2);
        $skipEncode=($origGameVersion===null || (int)$origGameVersion<=19);
        $parts[0]=fixVersionKey(injectVersionLabel($parts[0],$skipEncode));
        if ($skipEncode) $parts[0]=fixAutoLevelDifficulty($parts[0]);
        $respBody=implode('#',$parts);
    } else {
        $sections=explode('#',$respBody);
        $skipEncode=($origGameVersion===null || (int)$origGameVersion<=19);
        $levels=explode('|',$sections[0]);
        foreach ($levels as &$lv) {
            $lv=fixVersionKey(injectVersionLabel($lv,$skipEncode));
            if ($skipEncode) $lv=fixAutoLevelDifficulty($lv);
        }
        unset($lv);
        $sections[0]=implode('|',$levels);
        $respBody=implode('#',$sections);
    }
}
if ($target===BOOMLINGS && $bare==='/database/getGJComments21.php' && ($origBinaryVersion===null || (int)$origBinaryVersion<32) && trim($respBody)!=='-1' && trim($respBody)!=='-2') {
    $respBody=downgradeCommentsResponse($respBody,$origBinaryVersion===null);
}
if ($musicLibUrl !== null && trim($respBody) !== '-1') {
    $songParts = explode('~|~', $respBody);
    for ($i = 0; $i < count($songParts) - 1; $i += 2) {
        if ($songParts[$i] === '10' || $songParts[$i] === '16') {
            $songParts[$i + 1] = urlencode($musicLibUrl);
        }
    }
    $respBody = implode('~|~', $songParts);
}
if (($target===BOOMLINGS && $bare==='/database/getGJSongInfo.php' && trim($respBody)==='-1') || ($target===BOOMLINGS && $bare==='/database/getGJSongInfo.php' && trim($respBody)==='-2')) {
    $ngSong=fetchNGSongInfo($flat['songID'] ?? '');
    if ($ngSong!==null) $respBody=$ngSong;
} // check if the song is allowed for use. if not, then do the bypass. i'm unsure if -2 is even needed here. the game considers -2 to be the "not allowed" signal, but the server returns -1 for non-whitelisted songs. i'm just doing both to be safe.
respondAndExit($status,$respHeaders,$respBody,$target,$bare,$newBody);