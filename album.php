<?php

if ($_POST['action']!= 'album'){

    
       exec('mpc findadd album '.$_POST['action'] , $out , $ret);  
                exec('mpc play' , $out , $ret);

}

 system ('mpc -f %album%  search track 10 |sort -u',$artist);
$artist=['avatar','disturbed'];

?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Lutty Player</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
</head>
<body>
<div class="div-link">
        <div class="div-artist">
            <form action="/mpd/artist.php" method="post" >
                <input class="hidden" name="action" type="text" value="artist" />
                <input class="button" type="submit" value="Artist" />
            </form>
        </div>

        <div class="div-album">
            <form action="/mpd/" method="post" >
                <input class="hidden" name="action" type="text" value="" />
                <input class="button" type="submit" value="Play" />
            </form>
        </div>

</div>
   
<div class="list-artist">

<?php
foreach ($artist as $one){
echo '
<div class="button-artist">
    <form action="/mpd/" method="post" >
        <input class="hidden" name="action" type="text" value="'.$one.'" />
        <input class="button" type="submit" value="'.$one.'" />
    </form>
</div>

';
}



?>

</div>
</body>
</html>

