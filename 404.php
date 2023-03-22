<?php

if(get_option('ipic_private')) {
  welcome();
}

wp_redirect(home_url(), 302);

?>

