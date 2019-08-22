<?php

switch ($_POST['action']){

    case "reboot": exec ('sudo shutdown -r now', $out, $ret); 
$reboot="Rebooting ...";
break;
    case "clear": exec('mpc clear' , $out , $ret);  break;
    case "savepl1" : exec('mpc rm playlist1' , $out , $ret);
exec('mpc save playlist1' , $out , $ret); break;
    case "loadpl1" : exec('mpc clear' , $out , $ret);
exec('mpc load playlist1' , $out , $ret);
exec('mpc play' , $out , $ret);
 break;
    case "savepl2" : exec('mpc rm playlist2' , $out , $ret);
exec('mpc save playlist2' , $out , $ret); break;
    case "loadpl2" : exec('mpc clear' , $out , $ret);
 exec('mpc load playlist2' , $out , $ret); 
exec('mpc play' , $out , $ret);
break;
    case "savepl3" : exec('mpc rm playlist3' , $out , $ret);
exec('mpc save playlist3' , $out , $ret); break;
    case "loadpl3" : exec('mpc clear' , $out , $ret);
exec('mpc load playlist3' , $out , $ret);
 exec('mpc play' , $out , $ret);
break;

    default: break;

}



?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Lutty Player</title>
  <script src="script.js"></script>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<a id="top"></a>
<div class="div-link">
    <div class="div-artist">
        <form action="/" method="post" >
            <input class="hidden" name="action" type="text" value="" />
            <input class="button" type="submit" value="Play" />
        </form>
    </div><div class="div-artist">
            <form action="/artist.php" method="post" >
                <input class="hidden" name="action" type="text" value="artist" />
                <input class="button" type="submit" value="Artist" />
            </form>
        </div><div class="div-album">
            <form action="/album.php" method="post" >
                <input class="hidden" name="action" type="text" value="album" />
                <input class="button" type="submit" value="Album" />
            </form>
        </div><div class="div-playlist">
            <form action="/playlist.php" method="post" >
                <input class="hidden" name="action" type="text" value="playlist" />
                <input class="button" type="submit" value="Playlist" />
            </form>
        </div>

</div>

<div class="list-setting">
    <div class="div-clear">
        <form action="/setting.php" method="post" >
            <input class="hidden" name="action" type="text" value="clear" />
            <input class="button" type="submit" value="Clear playlist" />
       </form>
    </div>
    <div class="div-reboot">
       <form action="/setting.php" method="post" >
           <input class="hidden" name="action" type="text" value="reboot" />
           <input class="button" type="submit" value="Reboot" />
       </form>
    </div>

<span class="slot"> Playlist 1 :</span>
<div class="div-save">
            <form action="/setting.php" method="post" >
                <input class="hidden" name="action" type="text" value="savepl1" />
                <input class="button" type="submit" value="Save" />
            </form>
</div>
<div class="div-save">
            <form action="/setting.php" method="post" >
                <input class="hidden" name="action" type="text" value="loadpl1" />
                <input class="button" type="submit" value="Load" />
            </form>
</div>
<span class="slot"> Playlist 2 :</span>
<div class="div-save">
            <form action="/setting.php" method="post" >
                <input class="hidden" name="action" type="text" value="savepl2" />
                <input class="button" type="submit" value="Save" />
            </form>
</div>
<div class="div-save">
            <form action="/setting.php" method="post" >
                <input class="hidden" name="action" type="text" value="loadpl2" />
                <input class="button" type="submit" value="Load" />
            </form>
</div>
<span class="slot"> Playlist 3 :</span>
<div class="div-save">
            <form action="/setting.php" method="post" >
                <input class="hidden" name="action" type="text" value="savepl3" />
                <input class="button" type="submit" value="Save" />
            </form>
</div>
<div class="div-save">
            <form action="/setting.php" method="post" >
                <input class="hidden" name="action" type="text" value="loadpl3" />
                <input class="button" type="submit" value="Load" />
            </form>
</div>


</div>
<div class="info-setting">

<div class="float-right">
<?php
exec ('ip addr show wlan0 | grep -Po "inet \K[\d.]+"',$ip);
foreach ($ip as $one){

echo "<br />ip : ". $one ;
}

exec ('cat /sys/class/thermal/thermal_zone0/temp',$temp );
foreach ($temp as $one){

echo "<br />Temp : ". intval($one)/1000;
}

exec ('uptime | grep -oE "up.*min"',$time );
foreach ($time as $one){

echo "<br />". $one;
}

?>
<br />©Kevin Vézier 2019
</div>


<?php
echo $reboot;


exec ('uptime | grep -oE "load.*" | sed \'s/average/avg/\'',$uptime );
foreach ($uptime as $one){

echo  $one;
}

exec ('cat /var/log/boottime | sed \'s/Seconds/sec/\'',$boot);
foreach ($boot as $one){

echo "<br />boot time : ". $one ;
}

exec ("mpc -f '%artist% - %track% - %title%' playlist |grep -E '^.{6}$' | wc -l ",$corrompu);
foreach ($corrompu as $one){

echo "<br />song failed : ".$one;
}
?>
<br />Version : 1.5
</div>
</body>
</html>

