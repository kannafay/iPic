<!DOCTYPE html>
<html lang="zh">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="renderer" content="webkit">
  <title><?=show_wp_title()?></title>
  <link rel="shortcut icon" href="<?=has_site_icon() ? site_icon_url() : ''?>" type="image/x-icon">
  <link rel="stylesheet" href="<?=file_url()?>/assets/css/style.css">
  <link rel="stylesheet" href="<?=file_url()?>/assets/static/iconfont/iconfont.css">
  <script src="<?=file_url()?>/assets/js/jquery.min.js"></script>
  <script src="<?=file_url()?>/assets/js/jquery.pjax.min.js"></script>
  <?php
    if(get_option("ipic_cover_size") == '2') {
    ?>
      <style>
        main .new ul li .cover {
          height: 200px;
        }
        main .new ul li section {
          min-height: calc(100% - 200px);
        }

        @media screen and (max-width: 600px) {
          main .new ul li .cover {
            height: 180px;
          }
          main .new ul li section {
            min-height: calc(100% - 180px);
            
          }
        }

        @media screen and (max-width: 500px) {
          main .new ul li .cover {
            height: 150px;
          }
          main .new ul li section {
            min-height: calc(100% - 150px);
          }
        }

        @media screen and (max-width: 400px) {
          main .new ul li .cover {
            height: 125px;
          }
          main .new ul li section {
            min-height: calc(100% - 125px);
          }
        }
      </style>
    <?php }
  ?>
</head>
<body>