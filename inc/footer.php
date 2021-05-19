<!-- ============ Footer ============ -->
<div id="footer_iframe" class="bg-black">

<div>
  
    <!-- ============ Check if Plex Server is online ============ -->
	
    <p class="text-right">StreamNet Server: <span id="server-status-msg">&nbsp;checking status ....</span></p>	

    <!-- ============ Call Tautulli/PlexPy for Stats ============ -->
    <?php
      include_once('plexpyAPI.module.php');
            $stats = plexpyAPI('get_libraries')['response']['data'];
        $stat_array = array();
            foreach ((array)$stats as $section) {
        $stat_array[$section['section_name']] = $section['count'];
              if ($section['section_type'] == 'show') {
          $stat_array["Episodes"] = $section['child_count'];
              }
            }
    ?>
    <p style="float: right" id="stats">4K Movies: <span class="text-gamboge"><?php print $stat_array['4K Movies']; ?></span> <span class="text-shuttle-gray">&#124;</span>
    HD Movies: <span class="text-gamboge"><?php print $stat_array['Movies']; ?></span> <span class="text-shuttle-gray">&#124;</span>
    Manga Movies: <span class="text-gamboge"><?php print $stat_array['Manga Movies']; ?></span> <span class="text-shuttle-gray">&#124;</span>
    James Bond World: <span class="text-gamboge"><?php print $stat_array['James Bond World']; ?></span> <span class="text-shuttle-gray">&#124;</span>
    Disney MasterPieces: <span class="text-gamboge"><?php print $stat_array['Disney MasterPieces']; ?></span> <span class="text-shuttle-gray">&#124;</span>
    Marvel Universe: <span class="text-gamboge"><?php print $stat_array['Marvel Universe']; ?></span> <span class="text-shuttle-gray">&#124;</span>
    DC Universe: <span class="text-gamboge"><?php print $stat_array['DC Universe']; ?></span> <span class="text-shuttle-gray">&#124;</span>
	Animation Movies: <span class="text-gamboge"><?php print $stat_array['Animation Movies']; ?></span> <span class="text-shuttle-gray">&#124;</span>
    Music: <span class="text-gamboge"><?php print $stat_array['Music']; ?></span> <span class="text-shuttle-gray">&#124;</span>
    TV Shows: <span class="text-gamboge"><?php print $stat_array['TV Shows']; ?></span> <span class="text-shuttle-gray">&#124;</span>
    Manga Series: <span class="text-gamboge"><?php print $stat_array['Manga Series']; ?></span>

    <p id="logged" style="float: left">Last Login:&nbsp; <span class="text-gamboge"><?php print date_format($newdate,"l, d F Y &#124 H:i:s"); ?></span>
</p>

    <div style="clear: both"></div>

  </div>
</div>
