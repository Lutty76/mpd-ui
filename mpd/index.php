<?php
$param="";
switch ($_POST['action']){

	case "play":	exec ( 'mpc '.$param.' toggle' , $out, $ret); break;
	case "next":	exec ( 'mpc '.$param.' next' , $out , $ret);break;
	case "previous": exec ( 'mpc '.$param.' prev' , $out , $ret);break;
	case "repeat":	exec ( 'mpc '.$param.' consume' , $out , $ret);break;
	case "shuffle": exec ( 'mpc '.$param.' random' , $out , $ret);break;
	case "vup": 
		exec ( "mpc volume | grep 'volume' |  grep -oE '[0-9]{1,3}'", $out, $ret );
		if (intval($out[0]) >= 78)
		{
			exec ( 'mpc '.$param.' volume 83' , $out , $ret);
		}
		else{
			exec ( 'mpc '.$param.' volume +5' , $out , $ret);
		}
;break;
        case "vdown":   exec ( 'mpc '.$param.' volume -5' , $out , $ret);break;
	case "metal":   exec('mpc '.$param.' clear' , $out , $ret);
					exec('mpc '.$param.' findadd genre Metal' , $out , $ret);
					exec('mpc '.$param.' findadd genre \'Hard Rock\'' , $out , $ret)  ;
		                        exec('mpc repeat off' , $out , $ret);
					exec('mpc '.$param.' play' , $out , $ret);
					break;

	case "rock":	exec('mpc '.$param.' clear' , $out , $ret);
					exec('mpc '.$param.' findadd genre Rock' , $out , $ret);
					exec('mpc '.$param.' findadd genre Blues' , $out , $ret);
		                        exec('mpc repeat off' , $out , $ret);
					exec('mpc '.$param.' play' , $out , $ret);
					break;

	case "radio":   exec('mpc '.$param.' clear' , $out , $ret);
			exec('mpc load radio' , $out , $ret);
                        exec('mpc repeat on' , $out , $ret);
			exec('mpc play' , $out , $ret);
			break;

	case "all": exec('mpc '.$param.' clear' , $out , $ret);
				exec('mpc '.$param.' ls |mpc add' , $out , $ret);
	                        exec('mpc repeat off' , $out , $ret);
				exec('mpc '.$param.' play' , $out , $ret);
					break;

	case "clear": exec('mpc '.$param.' clear' , $out , $ret);
					break;
	default: break;

}
exec('mpc '.$param.' |grep -oE "random: o(n|ff)" |grep -o "on"' , $out , $ret);
if ($ret !=0)
{
	$shuffle="s_inactive";
}else{

	$shuffle="s_active";
}

exec('mpc '.$param.' |grep -oE "consume: o(n|ff)" |grep -o " on"' , $out , $ret);
if ($ret ==0)
{
	$repeat="r_inactive";
}else
{
	$repeat="r_active";
}

?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Lutty Player</title>
  <link rel="stylesheet" href="./style.css">

</head>
<body>	
<div class="div-link">
		<div class="div-artist">
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
		</div><div class="div-clear">
			<form action="/setting.php" method="post" >
				<input class="hidden" name="action" type="text" value="Settings" />
				<input class="button" type="submit" value="Settings" />
			</form>
		</div>
</div>
<div class="info_music">
	<div class="artist">
		<?php system ( "mpc current  -f '%artist%%name%'" );  ?>
	</div>
	<div class="title">
		<?php system ( "mpc  current  -f '%title%'" );  ?>
	</div>
	</div>
	<div id="time-id" class="time">
		<div><?php system ( "mpc  | grep -oE '[0-9]{1,2}:[0-9]{2}/[0-9]{1,2}:[0-9]{2}'" );  ?></div>
		<div><?php system ( "mpc  | grep -oEm1 '#[0-9]+/[0-9]+'| grep -oEm1 '[0-9]+/[0-9]+'" );  ?></div>
	</div>
<div id="full_bar_time_id" >
<div class="fullbar_time"> <div id="bar_time_id" class="bar_time" style="width: <?php system (" mpc | grep -oEm1 '[0-9]{1,3}%'"); ?> " > </div> </div></div>
	<div class="control">
		<div class="div-button">
			<form action="/" method="post" >
				<input class="hidden" name="action" type="text" value="previous" />
				<input class="playbutton" type="submit" value="<<" />
			</form>
		</div><div class="div-button">
			<form action="/" method="post" >
				<input class="hidden" name="action" type="text" value="play" />
<?php
exec('mpc '.$param.'  |grep "\[paused\]"' , $out , $ret);
if ($ret ==0)
{
echo '<input id="play" class="playbutton" type="submit" value="&nbsp;>&nbsp;" />';
}
else{
echo '<input id="pause" class="playbutton" type="submit" value="&nbsp;ll&nbsp;" />';

}

?>
			</form>
		</div><div class="div-button">
			<form action="/" method="post" >
				<input class="hidden" name="action" type="text" value="next" />
				<input class="playbutton" type="submit" value=">>" />
			</form>
		</div><div class="div-button">
			<form action="/" method="post" >
				<input class="hidden" name="action" type="text" value="repeat" />
				<input class="img_button <?php echo $repeat; ?>" type="submit" value="R" />
			</form>
		</div><div class="div-button">
			<form action="/" method="post" >
				<input class="hidden" name="action" type="text" value="shuffle" />
				<input class="img_button <?php echo $shuffle; ?>" type="submit" value="S" />
			</form>
		</div>
	</div>
	<div class="volume"><div class="vdown"><form action="/" method="post" >
                                <input class="hidden" name="action" type="text" value="vdown" />
<input class="volbutton" type="submit" value="-"/></form></div><div id="vbar_full"><div class="vbar_border">
			<span id='volume_id'><?php system ( "mpc volume | grep 'volume' |  grep -oE '[0-9]{1,2}'" );  ?></span>/ 83<div class="vbar"></div>
        </div></div><div class="vup"><form action="/" method="post" >
                                <input class="hidden" name="action" type="text" value="vup" />
<input class="volbutton" type="submit" value="+"/></form></div></div>
	<div class="playlist">
		<div class="div-genre">
			<form action="/" method="post" >
				<input class="hidden" name="action" type="text" value="metal" />
				<input class="button" type="submit" value="Metal" />
			</form>
		</div><div class="div-genre">
			<form action="/" method="post" >
				<input class="hidden" name="action" type="text" value="rock" />
				<input class="button" type="submit" value="Rock" />
			</form>
		</div><div class="div-genre">
			<form action="/" method="post" >
				<input class="hidden" name="action" type="text" value="radio" />
				<input class="button" type="submit" value="Radio" />
			</form>
		</div><div class="div-genre">
			<form action="/" method="post" >
				<input class="hidden" name="action" type="text" value="all" />
				<input class="button" type="submit" value="All" />
			</form>
		</div>

	</div><?php
exec('mpc '.$param.'  |grep "\[paused\]"' , $out , $ret);
if ($ret !=0 || true)
{
echo '  <script src="script.js"></script>';
}

?>
</body>
</html>

