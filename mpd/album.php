<?php


if (isset($_POST['artist'])){

 exec ('mpc -f %album%  search track 10 artist '.$_POST['artist'].' |sort -u', $album,$code);
 
}
else{


 exec ('mpc -f %album%  search track 5 |sort -u', $album,$code);
}
    


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
            <form action="/artist.php" method="post" >
                <input class="hidden" name="action" type="text" value="artist" />
                <input class="button" type="submit" value="Artist" />
            </form>
        </div><div class="div-album">
            <form action="/" method="post" >
                <input class="hidden" name="action" type="text" value="" />
                <input class="button" type="submit" value="Play" />
            </form>
        </div><div class="div-playlist">
            <form action="/playlist.php" method="post" >
                <input class="hidden" name="action" type="text" value="playlist" />
                <input class="button" type="submit" value="Playlist" />
            </form>
        </div><div class="div-clear">
            <form action="/setting.php" method="post" >
                <input class="hidden" name="action" type="text" value="Settings" />
                <input class="button" type="submit" value="Settings" />
            </form>
        </div>

</div>
   
<div class="list-artist">

<?php

if (isset($_POST['artist'])){
echo'
<div class="button-artist">
    <form action="/artist.php" method="post" >
        <input class="hidden" name="action" type="text" value="'.$_POST['artist'].'" />
        <input class="button" type="submit" value="Tous" />
    </form>
</div>
';

}
foreach ($album as $one){
echo '<div class="button-artist">
    <form action="/album.php" method="post" >
        <input class="hidden" name="action" type="text" value="'.$one.'" />
        <input class="button" type="submit" value="'.$one.'" />
    </form>
</div>';
}



?>

</div>

<?php
if (isset($_POST['action']) && $_POST['action']!= 'album'){

    
       exec('mpc findadd album \''.$_POST['action'].'\'' , $out , $ret);  
                        exec('mpc repeat off' , $out , $ret);
                exec('mpc play' , $out , $ret);


echo "Added !";
}



?>
<a class="top" href="#top">/\</a>
</body>
</html>

