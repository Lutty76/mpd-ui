<?php
$param=" --host=192.168.1.3 ";
switch ($_POST['action']){

	case "play":	exec ( 'mpc '.$param.' toggle' , $out, $ret); break;
	case "next":	exec ( 'mpc '.$param.' next' , $out , $ret);break;
	case "previous": exec ( 'mpc '.$param.' prev' , $out , $ret);break;
	case "repeat":	exec ( 'mpc '.$param.' consume' , $out , $ret);break;
	case "shuffle": exec ( 'mpc '.$param.' random' , $out , $ret);break;
	case "metal":   exec('mpc '.$param.' clear' , $out , $ret);
					exec('mpc '.$param.' findadd genre Metal' , $out , $ret);
					exec('mpc '.$param.' findadd genre \'Hard Rock\'' , $out , $ret)  ;
					exec('mpc '.$param.' play' , $out , $ret);
					break;

	case "rock":	exec('mpc '.$param.' clear' , $out , $ret);
					exec('mpc '.$param.' findadd genre Rock' , $out , $ret);
					exec('mpc '.$param.' findadd genre Blues' , $out , $ret);
					exec('mpc '.$param.' play' , $out , $ret);
					break;

	case "music":   exec('mpc '.$param.' clear' , $out , $ret);
					exec('mpc '.$param.' findadd genre Metal' , $out , $ret);
					exec('mpc '.$param.' findadd genre \'Hard Rock\'' , $out , $ret);
					exec('mpc '.$param.' findadd genre Classical' , $out , $ret);
					exec('mpc '.$param.' findadd genre Rock' , $out , $ret);
					exec('mpc '.$param.' findadd genre Blues' , $out , $ret);
					exec('mpc '.$param.' play' , $out , $ret);
					break;

	case "all": exec('mpc '.$param.' clear' , $out , $ret);   
				exec('mpc '.$param.' ls |mpc add' , $out , $ret);   
				exec('mpc '.$param.' play' , $out , $ret);
					break;

	case "clear": exec('mpc '.$param.' clear' , $out , $ret);  
					break;
	default: break;

}
exec('mpc '.$param.' |grep -oE "random: o(n|ff)" |grep -o "on"' , $out , $ret);
if ($ret !=0)
{
	$shuffle="s_active";
}else{

	$shuffle="s_inactive";
}

exec('mpc '.$param.' |grep -oE "consume: o(n|ff)" |grep -o " on"' , $out , $ret);
if ($ret ==0)
{
	$repeat="r_active";
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
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
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
		<?php system ( "mpc current  -f '%artist%'" );  ?>
	</div>
	<div class="title">
		<?php system ( "mpc current  -f '%title%'" );  ?>
	</div>
	</div>
	<div class="time">
		<div><?php system ( "mpc  | grep -oE '[0-9]{1,2}:[0-9]{2}/[0-9]{1,2}:[0-9]{2}'" );  ?></div>
		<div><?php system ( "mpc  | grep -oEm1 '#[0-9]+/[0-9]+'| grep -oEm1 '[0-9]+/[0-9]+'" );  ?></div>
	</div>
<div class="fullbar_time"> <div class="bar_time" style="width: <?php system (" mpc | grep -oEm1 '[0-9]{1,3}%'"); ?> " > </div> </div>
	<div class="control">
		<div class="div-button">
			<form action="/" method="post" >
				<input class="hidden" name="action" type="text" value="previous" />
				<input class="playbutton" type="submit" value="<<" />
			</form>
		</div><div class="div-button">
			<form action="/" method="post" >
				<input class="hidden" name="action" type="text" value="play" />
				<input class="playbutton" type="submit" value="&nbsp;>&nbsp;" />
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
				<input class="hidden" name="action" type="text" value="music" />
				<input class="button" type="submit" value="Music" />
			</form>
		</div><div class="div-genre">
			<form action="/" method="post" >
				<input class="hidden" name="action" type="text" value="all" />
				<input class="button" type="submit" value="All" />
			</form>
		</div>

	</div>
</body>
</html>

