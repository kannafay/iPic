<main id="pjax-box">
  <div class="new">
    <ul class="post">
      <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
        <li>
          <a data-pjax href="<?=the_permalink()?>" class="cover">
            <?php
              if( has_post_thumbnail() ) {
                the_post_thumbnail();
              } else {
                echo '<img src="'.catch_that_image().'">';
              }
            ?>
          </a>
          <section>
            <div class="title">
              <a data-pjax href="<?=the_permalink()?>"><?=the_title()?></a>
            </div>
            <div class="info">
              <?php
                $category = get_the_category();
                if(isset($category[0] -> name))
                  $cate_name = $category[0] -> name;
                else
                  $cate_name = '暂无分类';

                if(isset($category[0] -> cat_ID))
                  $cate_id = $category[0] -> cat_ID;
                else
                  $cate_id = null;
              ?>
              <div class="cate"><span class="iconfont icon-RectangleCopy4"></span><a data-pjax href="<?=get_category_link($cate_id)?>"><?=$cate_name?></a></div>
              <div class="date"><span class="iconfont icon-RectangleCopy6"></span><?=get_the_date()?></div>
            </div>
          </section>
        </li>
      <?php endwhile; endif; ?>
    </ul>

    <?php
      if(get_next_posts_link() || get_previous_posts_link()) { ?>
        <div data-pjax class="pagination"><?=wp_pagination()?></div>
      <?php }
    ?>
  </div>
</main>