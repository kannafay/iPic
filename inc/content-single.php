<main id="pjax-box">
  <link rel="stylesheet" href="<?=file_url()?>/assets/static/fancybox/fancybox.css">

  <?=the_breadcrumb()?>
  <div class="single">
    <div class="main">
      <div class="text">
        <h2 class="title"><?=the_title()?></h2>
        <div class="content">
          <?=the_content()?>
        </div>        
      </div>
    </div>
    <div data-pjax class="side">
      <div class="cate">
        <h3>分类</h3>
        <?=the_category('', 'multiple')?>
      </div>
      <div class="tag">
        <h3>标签</h3>
        <div class="post-tags">
          <?=has_tag() ? the_tags('', '', '') : '<a class="no-tag">暂无标签</a>'?>
        </div>
      </div>
    </div>
  </div>

  <script src="<?=file_url()?>/assets/static/fancybox/fancybox.umd.js"></script>
</main>

