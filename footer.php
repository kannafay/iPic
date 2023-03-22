<footer>
  <div class="copyright">Copyright © 2023 <a data-pjax href="<?=bloginfo('url')?>"><?=bloginfo('name')?></a></div>
  <?php
    if(get_option('ipic_icp')) { ?>
      <div class="icp"><a href="https://beian.miit.gov.cn" target="_blank"><?=get_option('ipic_icp')?></a></div>
    <?php }
  ?>

  <?php
    if(get_option('ipic_icp_gov')) { ?>
      <div class="icp-gov"><a href="<?=icp_gov_url()?>" target="_blank"><?=get_option('ipic_icp_gov')?></a></div>
    <?php }
  ?>
  
</footer>