<?php

switch ($_POST['action']){

    case "play":    exec ( 'mpc toggle' , $out, $ret); break;
    case "next":    exec ( 'mpc next' , $out , $ret);break;
    case "previous": exec ( 'mpc prev' , $out , $ret);break;
    case "metal":   exec('mpc clear' , $out , $ret);
                    exec('mpc findadd genre Metal' , $out , $ret);
                    exec('mpc findadd genre \'Hard Rock\'' , $out , $ret)  ;
                    exec('mpc play' , $out , $ret);
                    break;

    case "rock":    exec('mpc clear' , $out , $ret);
                    exec('mpc findadd genre Rock' , $out , $ret);
                    exec('mpc findadd genre Blues' , $out , $ret);
                    exec('mpc play' , $out , $ret);
                    break;

    case "music":   exec('mpc clear' , $out , $ret);
                    exec('mpc findadd genre Metal' , $out , $ret);
                    exec('mpc findadd genre \'Hard Rock\'' , $out , $ret);
                    exec('mpc findadd genre Classical' , $out , $ret);
                    exec('mpc findadd genre Rock' , $out , $ret);
                    exec('mpc findadd genre Blues' , $out , $ret);
                    exec('mpc play' , $out , $ret);
                    break;

    case "all": exec('mpc clear' , $out , $ret);   
                exec('mpc ls |mpc add' , $out , $ret);   
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
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
</head>
<body>
    <div class="title">
        <?php system ( "mpc current  -f '%artist% <br /> %title%'" );  ?>
    </div>
    <div class="time">
        <?php system ( "mpc | grep -oE '[0-9]{1,2}:[0-9]{2}/[0-9]{1,2}:[0-9]{2}'" );  ?>
    </div>

    <div class="control">
        <div class="div-button">
            <form action="/mpd/" method="post" >
                <input class="hidden" name="action" type="text" value="previous" />
                <input class="button" type="submit" value="<<" />
            </form>
        </div>

        <div class="div-button">
            <form action="/mpd/" method="post" >
                <input class="hidden" name="action" type="text" value="play" />
                <input class="button" type="submit" value=">" />
            </form>
        </div>

        <div class="div-button">
            <form action="/mpd/" method="post" >
                <input class="hidden" name="action" type="text" value="next" />
                <input class="button" type="submit" value=">>" />
            </form>
        </div>
    </div>
    <div class="playlist">
        <div class="div-genre">
            <form action="/mpd/" method="post" >
                <input class="hidden" name="action" type="text" value="metal" />
                <input class="button" type="submit" value="Metal" />
            </form>
        </div>

        <div class="div-genre">
            <form action="/mpd/" method="post" >
                <input class="hidden" name="action" type="text" value="rock" />
                <input class="button" type="submit" value="Rock" />
            </form>
        </div>

        <div class="div-genre">
            <form action="/mpd/" method="post" >
                <input class="hidden" name="action" type="text" value="music" />
                <input class="button" type="submit" value="Music" />
            </form>
        </div>


        <div class="div-genre">
            <form action="/mpd/" method="post" >
                <input class="hidden" name="action" type="text" value="all" />
                <input class="button" type="submit" value="All" />
            </form>
        </div>

    </div>
</body>
</html>

