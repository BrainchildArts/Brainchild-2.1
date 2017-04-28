<?php if( have_rows('ticket_buttons') ): ?>


  <div class="ticket-buttons">

  <?php while( have_rows('ticket_buttons') ): the_row();

    // vars
    $text = get_sub_field('button_text');
    $status = get_sub_field('button_status');
    ?>

      <?php if( $status == 'Active' ){ ?>

        <div class="active-tier"><a class="cta button ticket-link" href="http://buytickets.at/brainchildfestival/80298/r/website" target="_blank"><?php echo $text ?></a></div>

      <?php } elseif ( $status == 'Inactive' ) { ?>

      <span><?php echo $text ?></span>

      <?php } elseif ( $status == 'Sold Out' ) { ?>

        <span class="previous"><?php echo $text?></span>

      <?php }; ?>

  <?php endwhile; ?>

  <?php while( have_rows('ticket_buttons') ): the_row();

    // vars
    $text = get_sub_field('button_text');
    $status = get_sub_field('button_status');

    if( $status == 'Volunteer' ){ ?>

      <div class="active-tier volunteer"><a class="button cta volunteer-link" href="#volunteering"><?php echo $text ?></a></div>


    <?php }; ?>
  <?php endwhile; ?>

  </div>

<?php endif; ?>
