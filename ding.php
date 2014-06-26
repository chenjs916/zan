<?php

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    if(! (isset($_GET['id']) && ( strlen($_GET['id'])) )  &&  !is_numeric($_GET['id']))  {
        header("location: stinger.html");
        exit;
    }
    else{
        $id = $_GET['id'];
    }

    if(!isset($_GET['action'])){
        header("location:stinger.html");
        exit;
    }
    else if($_GET['action'] == "ding"){
        $action = 1;
    }
    else if($_GET['action'] == "cai"){
        $action = 0;
    }
    else{
        header("location: stinger.html");
        exit;
    }


}

$ip = getIP();

include_once("includes/c.php");

$st = $db->prepare(' select * from pic_ip where vid = ? and ip = ? and action = ? ');
$st->execute(array($id,$ip,$action));
$row = $st->fetch();

if($st->rowCount() == 1){
    if($row['action'] == 1){
        echo "1,zan";
    }
    else{
        echo "0,cai";
    }
}
else{
    if($action){

        $st = $db->prepare('update pic set ding = ding +1 where id = ?');
        $st->execute(array($id));

        //加入赞过ip
        $st = $db->prepare('insert into pic_ip (vid,ip,action) values (?,?,1)');
        $st->execute(array($id,$ip));

        //刷新赞数量
        $st = $db->prepare('select ding from pic where id = ?');
        $st->execute(array($id));
        $row = $st->fetch();

        echo $row['ding'].",1";

    }
    else{

        $st = $db->prepare('update pic set cai = cai + 1 where id = ?');
        $st->execute(array($id));

        //加入踩过ip
        $st = $db->prepare('insert into pic_ip (vid,ip,action) values (?,?,0)');
        $st->execute(array($id,$ip));

        //刷新踩数量
        $st = $db->prepare('select cai from pic where id = ?');
        $st->execute(array($id));
        $row = $st->fetch();

        echo $row['cai'].",0";

    }
}



// 获取客户端ip
function getIP()
{
     $ip = "";
    if (getenv("HTTP_CLIENT_IP"))
        $ip = getenv("HTTP_CLIENT_IP");
    else if(getenv("HTTP_X_FORWARDED_FOR"))
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    else if(getenv("REMOTE_ADDR"))
        $ip = getenv("REMOTE_ADDR");
    else $ip = "Unknow";
    return $ip;
}
$db = null;
?>