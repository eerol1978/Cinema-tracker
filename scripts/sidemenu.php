<div class="sidemenu">
  <div class="sidemenuitem date"><label>Kuupäev</label>
  <div class="input"><?=$show_date?></div>
  <div class="options">
<?php
$result = db("schedule", "showtime", "showtime >= CURDATE() AND showtime < CURDATE() + INTERVAL 7 DAY AND location = '$location' GROUP BY DATE(showtime) ORDER BY showtime ASC");
$i=0;
foreach($result as $sqldate) {
  $date = new DateTime($sqldate['showtime']);
  echo "\n<a".$selected[($i+1)]." href=\"";
  if ($i==0) {
      echo $currenturl.$city;
  } else {
      echo $currenturl.$city."?day=".($i+1);
  }
  echo "\">";
  if ($i==0) {
      echo "Täna, ".$date->format('d').". ".$months[$date->format('n')-1]." ".$date->format('Y');
  } elseif ($i==1) {
      echo "Homme, ".$date->format('d').". ".$months[$date->format('n')-1]." ".$date->format('Y');
  } else {
      echo $days[$date->format('w')].", ".$date->format('d').". ".$months[$date->format('n')-1]." ".$date->format('Y');
  }
  echo "</a>";
  $i++;
}
echo "\n";
if ($getDay) {
  $linkDay = "?day=".$getDay;
} else {
  $linkDay = "";
}

?>
</div>
</div>
<div class="sidemenuitem city"><label>Asukoht</label>
<div class="input"><?=$location?></div>
<div class="options">
  <a<?=$location_selected[1]?> href="<?=$currenturl.$linkDay?>" title="Tallinna kinokavad">Tallinn</a>
  <a<?=$location_selected[2]?> href="<?=$currenturl."tartu/".$linkDay?>" title="Tartu kinokavad">Tartu</a>
  <a<?=$location_selected[3]?> href="<?=$currenturl."parnu/".$linkDay?>" title="Pärnu kinokavad">Pärnu</a>
  <a<?=$location_selected[4]?> href="<?=$currenturl."narva/".$linkDay?>" title="Narva kinokavad">Narva</a>
  <a<?=$location_selected[5]?> href="<?=$currenturl."viljandi/".$linkDay?>" title="Viljandi kinokavad">Viljandi</a>
  <a<?=$location_selected[6]?> href="<?=$currenturl."saaremaa/".$linkDay?>" title="Saaremaa kinokavad">Saaremaa</a>
</div>
</div>
<div class="sidemenuitem theme"><label>Välimus</label>
<div class="options open">
  <a class="mode day<?=$theme_selected[1]?>" title="Hele välimus">Hele</a>
  <a class="mode night<?=$theme_selected[2]?>" title="Tume välimus">Tume</a>
</div>
</div>
<div class="sidemenuitem stats"><label>Statistika</label>
  <a href="https://kinos.ee/stats/" class="input blank" target="_blank" title="Täna kinodes (fun facts)">Täna kinodes</a>
</div>
<div class="sidemenuitem about">Kinos.ee on veebirakendus, mis koondab mugavalt ühe katuse alla kõik kinokavad ning lubab neis hõlpsasti orienteeruda. Lehel vahendatud filmide info, kinokavade ja muu meedia õigsuse eest vastutavad mainitud infot jagavate kinode operaatorid.<br><br>&copy; <? echo date('Y'); ?> Kinos.ee</div>
<div class="fb-like" data-href="https://kinos.ee" data-layout="button_count" data-action="like" data-size="large" data-show-faces="false" data-share="true"></div>
</div>
