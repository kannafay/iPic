$(document).pjax('[data-pjax] a, a[data-pjax]', '#pjax-box', {
  fragment: '#pjax-box',
});

$(document).on('pjax:send', function() {
  $("#pjax-box").addClass("active");
});

$(document).on('pjax:complete', function() {
  $("#pjax-box").removeClass("active");

  fix_url();

  $(menu_a).each(function(){
    if(!$(this).parent().hasClass('menu-item-has-children')) {
      $(this).attr('data-pjax', '');

      if($(this).attr('href') == window.location.href) {
        $(this).addClass('active');
      } else {
        $(this).removeClass('active');
      }
    }
  })

  $(menu_parent).each(function(i) {
    $(this).children('a').removeClass('current');
    $(this.querySelectorAll('ul li ul li a')).each(function() {
      if($(this).hasClass('active')) {
        $(menu_parent[i]).children('a').addClass('current');
      }
    })
  })
});


const fix_url = () => {
  $('[data-pjax] a, a[data-pjax]').each(function() {
    cur_url = $(this).attr('href').replace(/\/\?_pjax=%23pjax-box/, '');

    if(cur_url.indexOf('/page/1') > -1) {
      cur_url = cur_url.replace(/\/page\/1/, '');
    } else if(cur_url.indexOf('/page/1/') > -1) {
      cur_url = cur_url.replace(/\/page\/1\//, '');
    }

    $(this).attr('href', cur_url);
  })
}
fix_url();


$(document).on('click', '[data-pjax] a, a[data-pjax]', function() {
  url = $(this).attr('href');
  $.ajax({
    type: 'get',
    url: url,
    success: function(data){
      $('#title').text(($(data).find('#title').text()).trim());
    }
  });
})
window.onpopstate = () => {
  url = location.href;
  $.ajax({
    type: 'get',
    url: url,
    success: function(data){
      $('#title').text(($(data).find('#title').text()).trim());
    }
  });
}