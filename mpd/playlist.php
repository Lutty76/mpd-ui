<?php


 exec ('mpc -f \'%artist% - %track% - %title%\' playlist', $artist ,$code);


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
            <form action="/artist.php" method="post" >
                <input class="hidden" name="action" type="text" value="artist" />
                <input class="button" type="submit" value="Artist" />
            </form>
        </div>
        
        <div class="div-album">
            <form action="/album.php" method="post" >
                <input class="hidden" name="action" type="text" value="album" />
                <input class="button" type="submit" value="Album" />
            </form>
        </div>

</div>
   
<div class="list-artist">

<?php
$i=1;
foreach ($artist as $one){
echo '
<div class="button-song">
    <a class="button" href="/playlist.php?action='.$i.'" > '.$i++.'. '.$one.'</a>
</div>';
}



?>

</div>

<?php
if ($_GET['action']!= 'playlist'){

   
                exec('mpc play '.$_POST['action'] , $out , $ret);
echo "Played !";
}


?>

<a class="top" href="#top">/\</a>
</body>
</html>

