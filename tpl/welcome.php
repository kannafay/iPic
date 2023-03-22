<?php

/*Template Name: 维护/隐私模板*/

if(!get_option('ipic_private') || is_user_logged_in()) {
  wp_redirect(home_url(), 302);
}

?>

<!DOCTYPE html>
<html lang="zh">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome</title>
  <link rel="shortcut icon" href="<?=has_site_icon() ? site_icon_url() : ''?>" type="image/x-icon">
</head>
<body>
  <?php
    if(get_option('ipic_private_tpl'))
      require 'welcome/tpl'.get_option('ipic_private_tpl').'.php';
    else
      require 'welcome/tpl1.php';
  ?>
</body>
</html>