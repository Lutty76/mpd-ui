<?php


 exec ('mpc -f %artist%  search track 10 |sort -u', $artist ,$code);


?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Lutty Player</title>
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
        </div>

        <div class="div-album">
            <form action="/album.php" method="post" >
                <input class="hidden" name="action" type="text" value="album" />
                <input class="button" type="submit" value="Album" />
            </form>
        </div>
        <div class="div-playlist">
            <form action="/playlist.php" method="post" >
                <input class="hidden" name="action" type="text" value="playlist" />
                <input class="button" type="submit" value="Playlist" />
            </form>
        </div>

        <div class="div-clear">
            <form action="/setting.php" method="post" >
                <input class="hidden" name="action" type="text" value="Settings" />
                <input class="button" type="submit" value="Settings" />
            </form>
        </div>


</div>
   
<div class="list-artist">

<?php
foreach ($artist as $one){
echo '
<div class="button-artist">
    <form action="/album.php" method="post" >
        <input class="hidden" name="artist" type="text" value="'.$one.'" />
        <input class="button" type="submit" value="'.$one.'" />
    </form>
</div>

';
}



?>

</div>

<?php
if ($_POST['action']!= 'artist'){

    
       exec('mpc findadd artist \''.$_POST['action'].'\'' , $out , $ret);  
                exec('mpc play' , $out , $ret);
echo "Added !";
}


?>
<a class="top" href="#top">/\</a>
</body>
</html>

