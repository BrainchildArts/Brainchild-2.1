<?php
$days = ceil((strtotime("12/18/2016") - time())/(60*60*24));
$s='';
if ($days!=1) {
     $s='s';
}

?>
<aside class="countdown">
  <p>If you want your goodies for Christmas, place your order before Tue 20th @ 2pm!</p>
  <span class="countdown__time"><span id="time"></span>till last delivery!</span>
</aside>
