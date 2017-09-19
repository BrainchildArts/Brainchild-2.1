<?php
$days = ceil((strtotime("7/7/2017") - time())/(60*60*24));
$s='';
if ($days!=1) {
     $s='s';
}

?>
<aside class="countdown">
  <span><?php echo $days. " day$s "; ?>to go!</span>
  <a href="http://buytickets.at/brainchildfestival/80298/r/countdown" target="_blank">Buy Tickets</a>
</aside>
