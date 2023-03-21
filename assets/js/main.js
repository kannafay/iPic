$(document).on('click', 'header .menu-switch', () => {
  $(`
    aside,
    .container,
    header .menu-switch .box,
    header .menu-switch .box span.open,
    header .menu-switch .box span.close
  `).toggleClass('active');

  $(`
    header .title,
    header .search,
    header .search-switch .box,
    header .search-switch .box span.open,
    header .search-switch .box span.close
  `).removeClass('active');
})

$(document).on('click', (e) => {
  if(!$(e.target).is('.menu-switch, .menu-switch *')&& !$(e.target).is('aside, aside *') && $('.menu-switch .box').hasClass('active')) {
    $(`
      aside,
      .container,
      header .menu-switch .box,
      header .menu-switch .box span.open,
      header .menu-switch .box span.close
    `).removeClass('active');
  }

  if(!$(e.target).is('.search-switch, .search-switch *')&& !$(e.target).is('.search, .search *') && $('.search-switch .box').hasClass('active')) {
    $(`
      header .title,
      header .search,
      header .search-switch .box,
      header .search-switch .box span.open,
      header .search-switch .box span.close
    `).removeClass('active');
  }
})

$(document).on('click', 'header .search-switch', () => {
  $(`
    header .title,
    header .search,
    header .search-switch .box,
    header .search-switch .box span.open,
    header .search-switch .box span.close
  `).toggleClass('active');
})

$(document).on('ready scroll', function(){
  scrollHeight = $(this).scrollTop();
  if(scrollHeight >= 100) {
    $('header .title .the-title').addClass("active");
    $('header .title .backtop').addClass("active");
  } else {
    $('header .title .the-title').removeClass("active");
    $('header .title .backtop').removeClass("active");
  }
})

$(document).on('click', 'header .title .backtop span', ()=>{
  $('html, body').animate({scrollTop: 0}, 300);
})


$(document).ready(function() {
  menu_parent = $('aside .main_menu > ul > li.menu-item-has-children');
  menu_parent_hight = [];
  menu_parent_a_hight = [];
  menu_a = $('aside .main_menu ul li a');
  $(menu_a).each(function() {
    if(!$(this).parent().hasClass('menu-item-has-children')) {
      $(this).attr('data-pjax', '');

      if($(this).attr('href') == window.location.href) {
        $(this).addClass('active');
      }
    }
  })

  $(menu_parent).each(function(i) {
    menu_parent_hight[i] = $(this).innerHeight();
    menu_parent_a_hight[i] = $(this).children('a').innerHeight();
    $(this).height(menu_parent_a_hight[i]);
    $(this).children('a').on('click', function(e) {
      e.preventDefault();
      if(!$(this).hasClass('active')) {
        $(this).parent().height(menu_parent_hight[i]);
        $(this).children('.arrow').addClass('active');
        $(this).addClass('active');
      } else {
        $(this).parent().height(menu_parent_a_hight[i]);
        $(this).children('.arrow').removeClass('active');
        $(this).removeClass('active');
      }
    })

    $(this.querySelectorAll('ul li ul li a')).each(function() {
      if($(this).hasClass('active')) {
        $(menu_parent[i]).children('a').addClass('current');
      }
    })

    $(document).click((e)=>{
      if($(this).children('a').hasClass('active')) {
        if(!$(e.target).is($(this).children('a, ul')) && !$(e.target).is(this.querySelectorAll('ul li ul li a, a *'))) {
          $(this).height(menu_parent_a_hight[i]);
          $(this).children('a').removeClass('active');
          $(this.querySelector('.arrow')).removeClass('active');
        }
      }
    })
  })
})