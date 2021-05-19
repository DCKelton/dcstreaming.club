<?php
$torrent = exec ("docker inspect -f  '{{.State.Running}}' rutorrent");
$portainer = exec ("docker inspect -f  '{{.State.Running}}' portainer");
$plex = exec ("docker inspect -f '{{.State.Running}}' plex");
$tautulli = exec ("docker inspect -f  '{{.State.Running}}' tautulli");
$lidarr = exec ("docker inspect -f  '{{.State.Running}}' lidarr");
$kitana = exec ("docker inspect -f  '{{.State.Running}}' kitana");
$ombi = exec ("docker inspect -f  '{{.State.Running}}' ombi");
$watch = exec ("docker inspect -f  '{{.State.Running}}' watchtower");
$sonarr = exec ("docker inspect -f  '{{.State.Running}}' sonarr");
$radarr = exec ("docker inspect -f  '{{.State.Running}}' radarr");
$jackett = exec ("docker inspect -f  '{{.State.Running}}' jackett");

$torrentIP = exec ("docker inspect -f '{{ .NetworkSettings.IPAddress }}' rutorrent");
$portainerIP = exec ("docker inspect -f '{{ .NetworkSettings.IPAddress }}' portainer");
$plexIP = exec ("docker inspect -f '{{ .NetworkSettings.IPAddress }}' plex");
$tautulliIP = exec ("docker inspect -f '{{ .NetworkSettings.IPAddress }}' tautulli");
$lidarrIP = exec ("docker inspect -f '{{ .NetworkSettings.IPAddress }}' lidarr");
$kitanaIP = exec ("docker inspect -f '{{ .NetworkSettings.IPAddress }}' kitana");
$ombiIP = exec ("docker inspect -f '{{ .NetworkSettings.IPAddress }}' ombi");
$watchIP = exec ("docker inspect -f '{{ .NetworkSettings.IPAddress }}' watchtower");
$sonarrIP = exec ("docker inspect -f '{{ .NetworkSettings.IPAddress }}' sonarr");
$radarrIP = exec ("docker inspect -f '{{ .NetworkSettings.IPAddress }}' radarr");
$jackettIP = exec ("docker inspect -f '{{ .NetworkSettings.IPAddress }}' jackett");

$torrentPort = exec ("docker inspect -f '{{.Config.Image}}' rutorrent");
$portainerPort = exec ("docker inspect -f '{{.Config.Image}}' portainer");
$plexPort = exec ("docker inspect -f '{{.Config.Image}}' plex");
$tautulliPort = exec ("docker inspect -f '{{.Config.Image}}' tautulli");
$lidarrPort = exec ("docker inspect -f '{{.Config.Image}}' lidarr");
$kitanaPort = exec ("docker inspect -f '{{.Config.Image}}' kitana");
$ombiPort = exec ("docker inspect -f '{{.Config.Image}}' ombi");
$watchPort = exec ("docker inspect -f '{{.Config.Image}}' watchtower");
$sonarrPort = exec ("docker inspect -f '{{.Config.Image}}' sonarr");
$radarrPort = exec ("docker inspect -f '{{.Config.Image}}' radarr");
$jackettPort = exec ("docker inspect -f '{{.Config.Image}}' jackett");

$gdrivecheck = exec ('systemctl is-active gdrive');
$gcryptcheck = exec ('systemctl is-active gcrypt');
$tdrivecheck = exec ('systemctl is-active tdrive');
$tcryptcheck = exec ('systemctl is-active tcrypt');
$pgunioncheck = exec ('systemctl is-active pgunion');
$pgblitzcheck = exec ('systemctl is-active pgblitz');
$musiccheck = exec ('systemctl is-active plexmusic');
$localspacecheck = exec ('systemctl is-active localspace');
$renamercheck = exec ('systemctl is-active renamer');
$plex_autoscan = exec ('systemctl is-active plex_autoscan');
$mountcheck = exec ('systemctl is-active mountcheck');
$animecheck = exec ('systemctl is-active plexanime');

if ($plex !== 'true')  {
    $plexstatus = '<td style="background:red;"><i style="color:white; font-style:normal;"> &nbsp;OFFLINE <span style="color:white;" class="fa fa-exclamation-circle"></span></i></td>';
}else{ 
    $plexstatus = '<td><i style="color:green; font-style:normal;"> &nbsp;ONLINE <span style="color:green;" class="fa fa-check-circle"></span></i></td>';
};

if ($watch !== 'true') {
    $watchstatus = '<td style="background:red;"><i style="color:white; font-style:normal;"> &nbsp;OFFLINE <span style="color:white;" class="fa fa-exclamation-circle"></span></i></td>';
}else{ 
    $watchstatus = '<td><i style="color:green; font-style:normal;"> &nbsp;ONLINE <span style="color:green;" class="fa fa-check-circle"></span></i></td>';
};

if ($portainer !== 'true') {
    $portainerstatus = '<td style="background:red;"><i style="color:white; font-style:normal;"> &nbsp;OFFLINE <span style="color:white;" class="fa fa-exclamation-circle"></span></i></td>';
}else{ 
    $portainerstatus = '<td><i style="color:green; font-style:normal;"> &nbsp;ONLINE <span style="color:green;" class="fa fa-check-circle"></span></i></td>';
};

if ($tautulli !== 'true') {
    $tautullistatus = '<td style="background:red;"><i style="color:white; font-style:normal;"> &nbsp;OFFLINE <span style="color:white;" class="fa fa-exclamation-circle"></span></i></td>';
}else{ 
    $tautullistatus = '<td><i style="color:green; font-style:normal;"> &nbsp;ONLINE <span style="color:green;" class="fa fa-check-circle"></span></i></td>';
};

if ($ombi !== 'true') {
    $ombistatus = '<td style="background:red;"><i style="color:white; font-style:normal;"> &nbsp;OFFLINE <span style="color:white;" class="fa fa-exclamation-circle"></span></i></td>';
}else{ 
    $ombistatus = '<td><i style="color:green; font-style:normal;"> &nbsp;ONLINE <span style="color:green;" class="fa fa-check-circle"></span></i></td>';
};

if ($sonarr !== 'true') {
    $sonarrstatus = '<td style="background:red;"><i style="color:white; font-style:normal;"> &nbsp;OFFLINE <span style="color:white;" class="fa fa-exclamation-circle"></span></i></td>';
}else{ 
    $sonarrstatus = '<td><i style="color:green; font-style:normal;"> &nbsp;ONLINE <span style="color:green;" class="fa fa-check-circle"></span></i></td>';
};

if ($radarr !== 'true') {
    $radarrstatus = '<td style="background:red;"><i style="color:white; font-style:normal;"> &nbsp;OFFLINE <span style="color:white;" class="fa fa-exclamation-circle"></span></i></td>';
}else{ 
    $radarrstatus = '<td><i style="color:green; font-style:normal;"> &nbsp;ONLINE <span style="color:green;" class="fa fa-check-circle"></span></i></td>';
};

if ($jackett !== 'true') {
    $jackettstatus = '<td style="background:red;"><i style="color:white; font-style:normal;"> &nbsp;OFFLINE <span style="color:white;" class="fa fa-exclamation-circle"></span></i></td>';
}else{ 
    $jackettstatus = '<td><i style="color:green; font-style:normal;"> &nbsp;ONLINE <span style="color:green;" class="fa fa-check-circle"></span></i></td>';
};

if ($lidarr !== 'true') {
    $lidarrstatus = '<td style="background:red;"><i style="color:white; font-style:normal;"> &nbsp;OFFLINE <span style="color:white;" class="fa fa-exclamation-circle"></span></i></td>';
}else{ 
    $lidarrstatus = '<td><i style="color:green; font-style:normal;"> &nbsp;ONLINE <span style="color:green;" class="fa fa-check-circle"></span></i></td>';
};

if ($kitana !== 'true'){
    $kitanastatus = '<td style="background:red;"><i style="color:white; font-style:normal;"> &nbsp;OFFLINE <span style="color:white;" class="fa fa-exclamation-circle"></span></i></td>';
}else{ 
    $kitanastatus = '<td><i style="color:green; font-style:normal;"> &nbsp;ONLINE <span style="color:green;" class="fa fa-check-circle"></span></i></td>';
}

if ($torrent !== 'true') {
    $torrentstatus = '<td style="background:red;"><i style="color:white; font-style:normal;"> &nbsp;OFFLINE <span style="color:white;" class="fa fa-exclamation-circle"></span></i></td>';
}else{ 
    $torrentstatus = '<td><i style="color:green; font-style:normal;"> &nbsp;ONLINE <span style="color:green;" class="fa fa-check-circle"></span></i></td>';
};

if ($renamercheck !== 'active') {
    $renamerstatus = '<td style="background:red;"><i style="color:white; font-style:normal;"> &nbsp;NOT RUNNING <span style="color:white;" class="fa fa-exclamation-circle"></span></i></td>';
}else{ 
    $renamerstatus = '<td><i style="color:green; font-style:normal;"> &nbsp;RUNNING <span style="color:green;" class="fa fa-check-circle"></span></i></td>';
};

if ($gdrivecheck !== 'active') {
    $gdrivestatus = '<td style="background:red;"><i style="color:white; font-style:normal;"> &nbsp;NOT LOADED <span style="color:white;" class="fa fa-exclamation-circle"></span></i></td>';
}else{ 
    $gdrivestatus = '<td><i style="color:green; font-style:normal;"> &nbsp;OPERATIONAL <span style="color:green;" class="fa fa-check-circle"></span></i></td>';
};

if ($tdrivecheck !== 'active') {
    $tdrivestatus = '<td style="background:red;"><i style="color:white; font-style:normal;"> &nbsp;NOT LOADED <span style="color:white;" class="fa fa-exclamation-circle"></span></i></td>';
}else{ 
    $tdrivestatus = '<td><i style="color:green; font-style:normal;"> &nbsp;OPERATIONAL <span style="color:green;" class="fa fa-check-circle"></span></i></td>';
};

if ($tcryptcheck !== 'active') {
    $tcryptstatus = '<td style="background:red;"><i style="color:white; font-style:normal;"> &nbsp;NOT LOADED <span style="color:white;" class="fa fa-exclamation-circle"></span></i></td>';
}else{ 
    $tcryptstatus = '<td><i style="color:green; font-style:normal;"> &nbsp;OPERATIONAL <span style="color:green;" class="fa fa-check-circle"></span></i></td>';
};

if ($gcryptcheck !== 'active') {
    $gcryptstatus = '<td style="background:red;"><i style="color:white; font-style:normal;"> &nbsp;NOT LOADED <span style="color:white;" class="fa fa-exclamation-circle"></span></i></td>';
}else{ 
    $gcryptstatus = '<td><i style="color:green; font-style:normal;"> &nbsp;OPERATIONAL <span style="color:green;" class="fa fa-check-circle"></span></i></td>';
};

if ($pgunioncheck !== 'active') {
    $pgunionstatus = '<td style="background:red;"><i style="color:white; font-style:normal;"> &nbsp;NOT LOADED <span style="color:white;" class="fa fa-exclamation-circle"></span></i></td>';
}else{ 
    $pgunionstatus = '<td><i style="color:green; font-style:normal;"> &nbsp;OPERATIONAL <span style="color:green;" class="fa fa-check-circle"></span></i></td>';
};

if ($pgblitzcheck !== 'active') {
    $pgblitzstatus = '<td style="background:red;"><i style="color:white; font-style:normal;"> &nbsp;NOT LOADED <span style="color:white;" class="fa fa-exclamation-circle"></span></i></td>';
}else{ 
    $pgblitzstatus = '<td><i style="color:green; font-style:normal;"> &nbsp;OPERATIONAL <span style="color:green;" class="fa fa-check-circle"></span></i></td>';
};

if ($musiccheck !== 'active') {
    $musicstatus = '<td style="background:red;"><i style="color:white; font-style:normal;"> &nbsp;NOT LOADED <span style="color:white;" class="fa fa-exclamation-circle"></span></i></td>';
}else{ 
    $musicstatus = '<td><i style="color:green; font-style:normal;"> &nbsp;OPERATIONAL <span style="color:green;" class="fa fa-check-circle"></span></i></td>';
};

if ($animecheck !== 'active') {
    $animestatus = '<td style="background:red;"><i style="color:white; font-style:normal;"> &nbsp;NOT LOADED <span style="color:white;" class="fa fa-exclamation-circle"></span></i></td>';
}else{ 
    $animestatus = '<td><i style="color:green; font-style:normal;"> &nbsp;OPERATIONAL <span style="color:green;" class="fa fa-check-circle"></span></i></td>';
};

if ($localspacecheck !== 'active')	{
    $localspacestatus = '<td style="background:red;"><i style="color:white; font-style:normal;"> &nbsp;NOT LOADED <span style="color:white;" class="fa fa-exclamation-circle"></span></i></td>';
}else{ 
    $localspacestatus = '<td><i style="color:green; font-style:normal;"> &nbsp;RUNNING <span style="color:green;" class="fa fa-check-circle"></span></i></td>';
};

if ($plex_autoscan !== 'active') {
    $plex_autoscanstatus = '<td style="background:red;"><i style="color:white; font-style:normal;"> &nbsp;NOT RUNNING <span style="color:white;" class="fa fa-exclamation-circle"></span></i></td>';
}else{ 
    $plex_autoscanstatus = '<td><i style="color:green; font-style:normal;"> &nbsp;RUNNING <span style="color:green;" class="fa fa-check-circle"></span></i></td>';
};

if ($mountcheck !== 'active') {
    $mountcheckstatus = '<td style="background:red;"><i style="color:white; font-style:normal;"> &nbsp;NOT LOADED <span style="color:white;" class="fa fa-exclamation-circle"></span></i></td>';
}else{ 
    $mountcheckstatus = '<td><i style="color:green; font-style:normal;"> &nbsp;RUNNING <span style="color:green;" class="fa fa-check-circle"></span></i></td>';
};

?>