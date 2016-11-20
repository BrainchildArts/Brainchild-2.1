<?php
$days = ceil((strtotime("7/8/2016") - time())/(60*60*24));
$s='';
if ($days!=1) {
     $s='s';
}

?>
<aside class="countdown">
  <span><?php echo $days. " day$s "; ?>till the festival!</span>
  <a href="http://buytickets.at/brainchildfestival/43686/r/countdown" target="_blank">Buy Your Ticket Now</a>
</aside>
