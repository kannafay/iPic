if ($.support.pjax) {
  $(document).pjax('[data-pjax] a, a[data-pjax]', '#pjax-box', {
    fragment: '#pjax-box',
    timeout: 6000,
  })
  
  $(document).on('submit', 'form[data-pjax]', function(event) {
    $.pjax.submit(event, '#pjax-box', {
      fragment: '#pjax-box',
      timeout: 6000,
    })
  
    $(this).children('input').blur();
    $('#title').text($(this).children('input').val());
  })
}


$(document).on('pjax:send', function() {
  $('#pjax-box, #title').addClass('active');
})

$(document).on('pjax:complete', function() {
  $('#pjax-box, #title').removeClass('active');
  $('html, body').animate({scrollTop: 0}, 0);
  img_preview();
  fix_url();
  menu_func();
})


const img_preview = () => {
  let postImg = document.querySelectorAll('.single .main .content img');
  if(postImg.length > 0) {
    let postImgUrl = [];
    $(postImg).each(function(i) {
      postImgUrl[i] = $('<a data-fancybox="gallery"></a>').attr('href',$(postImg[i]).attr('src'));
      postImg[i].parentNode.replaceChild($(postImgUrl[i])[0], postImg[i]);
      $(postImg[i]).appendTo($(postImgUrl[i])[0]);
    })
  }
}
img_preview();


const fix_url = () => {
  $('[data-pjax] a, a[data-pjax]').each(function() {
    if($(this).attr('href')) {
      cur_url = $(this).attr('href').replace(/\/\?_pjax=%23pjax-box/, '');
      $(this).attr('href', cur_url);
    }
  })
}
fix_url();


const menu_func = () => {
  $(document).ready(()=>{
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
  
    $('.menu-set').removeAttr('data-pjax');
  
    $(menu_parent).each(function(i) {
      $(this).children('a').removeClass('current');
      $(this.querySelectorAll('ul li ul li a')).each(function() {
        if($(this).hasClass('active')) {
          $(menu_parent[i]).children('a').addClass('current');
        }
      })
    })
  })
}


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

  menu_func();
}