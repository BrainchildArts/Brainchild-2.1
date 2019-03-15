<?php


$date1 = new DateTime("2018-07-13");
$date2 = new DateTime();

$diff = $date2->diff($date1)->format("%r%a");


$s='';
if ($diff!=1) {
     $s='s';
}
?>
<?php if ( $diff >= 1 ): ?>
  <aside class="countdown">
    <span><?php echo $diff. " day$s "; ?>to go!</span>
    <!-- <a href="http://buytickets.at/brainchildfestival/140274/r/websitecountdown" target="_blank">Buy Tickets</a> -->
  </aside>
<?php endif ?>
