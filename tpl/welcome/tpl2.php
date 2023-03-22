<?php
  header("Content-Type: text/html;charset=utf-8");
  // header('Access-Control-Allow-Origin:*');

  $str=file_get_contents('https://cn.bing.com/HPImageArchive.aspx?idx=0&n=1&mkt=zh-CN');
  if (preg_match("/<url>(.+?)<\/url>/", $str, $matches)) {
    if(isset($matches[1])) {
      $url = 'https://cn.bing.com'.$matches[1];
    } else {
      $url = file_url().'/screenshot.jpg';
    }
  }
  if (preg_match("/<copyright>(.+?)<\/copyright>/", $str, $matches)) {
    if($matches[1]) {
      $copyright = $matches[1];
    } else {
      $copyright = '搜索...';
    }
  }
  if (preg_match("/<copyrightlink>(.+?)<\/copyrightlink>/", $str, $matches)) {
    if($matches[1]) {
      $copyrightLink = $matches[1];
    } else {
      $copyrightLink = '';
    }
  }
?>

<style>
  * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'PingFang SC', 'Microsoft YaHei';
  }
  body {
      overflow: hidden;
  }
  .container {
      width: 100%;
      height: 100%;
      position: absolute;
  }
  .bgi {
      width: 100vw;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      pointer-events: none;
      z-index: -1;
  }
  .bgi::before {
      content: '';
      width: 100%;
      height: 100%;
      background-color: rgba(0 0 0 / 20%);
      position: absolute;
      left: 0;
      top: 0;
  }
  .bgi img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      vertical-align: middle;
  }
  .top,
  .bottom {
      display: flex;
      flex-direction: column;
      align-items: center;
      position: relative;
  }
  .top {
    height: 55%;
  }
  .bottom {
    height: 45%;
  }
  .top .datetime {
      text-align: center;
      color: #fff;
      margin-bottom: 50px;
      position: absolute;
      bottom: 50px;
  }
  .top .datetime .time {
      font-size: 100px;
  }
  .top .datetime .date {
      font-size: 20px;
  }
  .top .search {
      width: 800px;
      height: 50px;
      overflow: hidden;
      position: absolute;
      bottom: 0;
  }
  .top .search input {
      width: 100%;
      height: 100%;
      background-color: rgba(255 255 255 / 50%);
      -webkit-backdrop-filter: blur(20px);
      backdrop-filter: blur(20px);
      border-radius: 4px 25px;
      border: 0;
      outline: 0;
      padding: 0 98px 0 25px;
      font-size: 16px;
      color: #333;
      transition: all .3s;
  }
  .top .search input::placeholder {
      font-size: 14px;
      color: #666;
  }
  .top .search input:hover,
  .top .search input:focus {
      background-color: rgba(255 255 255 / 80%);
  }
  .top .search button {
      position: absolute;
      right: 5px;
      top: 5px;
      width: 80px;
      height: 40px;
      border-radius: 4px 20px;
      border: 0;
      background-color: rgba(255 255 255 / 80%);
      text-align: center;
      line-height: 40px;
      font-size: 14px;
      color: #333;
      transition: all .2s;
  }
  .top .search button:hover {
      cursor: pointer;
      background-color: #fff;
  }
  .top .search input:hover ~ button,
  .top .search input:focus ~ button {
      background-color: #fff;
  }

  .bottom {
      justify-content: space-between;
  }
  .bottom,
  .bottom a {
      text-decoration: none;
      font-size: 14px;
      color: #f5f5f5;
      line-height: 1.5;
  }
  .bottom a:hover {
      text-decoration: underline;
  }
  .bottom .bottom-header {
      margin-top: 30px;
      font-size: 14px;
      padding: 4px 10px;
      border-radius: 6px;
      cursor: pointer;
      transition: all .3s;
  }
  .bottom .bottom-header:hover {
      background-color: rgba(0 0 0 / 50%);
  }
  .bottom .bottom-footer {
      text-align: center;
      position: absolute;
      bottom: 30px;
  }
  .bottom .bottom-footer > * {
      line-height: 25px;
  }
  .bottom .bottom-footer a {
      display: inline-block;
  }

  /* nav */
  .nav {
      width: 100vw;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      visibility: visible;
      opacity: 1;
      transform: scale(1);
      transition: all .2s;
  }
  .nav-off {
      visibility: hidden;
      opacity: 0;
      transform: scale(.95);
      transition: all .2s;
  }
  #nav-bg {
      width: 100%;
      height: 100%;
      position: absolute;
  }
  .nav-box {
      width: 890px;
      background-color: #35363A;
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 0 20px rgba(0 0 0 / 20%);
      z-index: 2;
  }
  .nav-tab {
      display: flex;
      width: 100%;
      background-color: #4E4F55;
      margin-bottom: 30px;
      border-radius: 10px;
      padding: 5px;
      overflow: auto;
  }
  .nav-tab::-webkit-scrollbar {
      width: 0;
      height: 0;
  }
  .nav-tab li {
      list-style: none;
      font-size: 14px;
      border-radius: 8px;
      padding: 8px 12px;
      margin-right: 5px;
      color: #f5f5f5;
      cursor: pointer;
      text-overflow: ellipsis;
      white-space: nowrap;
      transition: all .2s;
  }
  .nav-tab li:last-child {
      margin-right: 0;
  }
  .nav-tab li:hover {
      background-color: #35363A80;
  }
  .nav-tab .current,
  .nav-tab .current:hover {
      background-color: #262728;
  }
  .nav-content {
      max-height: 390px;
      overflow: overlay;
      overflow-x: hidden;
  }
  .nav-content::-webkit-scrollbar {
      width: 4px;
      height: 4px;
  }
  .nav-content::-webkit-scrollbar-thumb {
      border-radius: 2px;
  }
  .nav-content:hover::-webkit-scrollbar-thumb {
      background-color: #4E4F55;
  }
  .nav-content ul {
      display: none;
      width: 100%;
      grid-template-columns: 1fr 1fr 1fr 1fr;
      grid-gap: 10px;
  }
  .nav-content .current {
      display: grid;
  }
  .nav-content ul li {
      list-style: none;
      width: 100%;
      height: 70px;
      overflow: hidden;
  }
  .nav-content ul li a {
      width: 100%;
      height: 100%;
      padding: 10px;
      text-decoration: none;
      border-radius: 10px;
      display: flex;
      transition: all .2s;
  }
  .nav-content ul li a:hover {
      background-color: rgba(255 255 255 / 10%);
  }
  .nav-content ul li a img {
      width: 50px;
      height: 50px;
      object-fit: cover;
      vertical-align: middle;
      border-radius: 10px;
  }
  .nav-content ul li a .text {
      display: flex;
      flex-direction: column;
      justify-content: center;
      color: #f5f5f5;
      overflow: hidden;
      padding-left: 10px;
  }
  .nav-content ul li a .text .title {
      font-size: 14px;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
  }
  .nav-content ul li a .text .description {
      font-size: 12px;
      color: #999;
      margin-top: 5px;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
  }

  @media screen and (max-width: 920px) {
      .nav-box {
          width: calc(100% - 40px);
      }
      .nav-content ul {
          grid-template-columns: 1fr 1fr 1fr;
      }
  }

  @media screen and (max-width: 820px) {
      .top {
          padding: 0 20px;
      }
      .top .datetime .time {
          font-size: 80px;
      }
      .top .datetime .date {
          font-size: 16px;
      }
      .top .search {
          width: calc(100% - 40px);
      }
      
  }
  @media screen and (max-width: 720px) {
      .nav-content ul {
          grid-template-columns: 1fr 1fr;
      }
  }
  @media screen and (max-width: 510px) {
      .nav-content ul {
          grid-template-columns: 1fr;
      }
  }
</style>

<div class="container">
  <div class="top">
    <div class="datetime">
      <div class="time"></div>
      <div class="date"></div>
    </div>
    <div class="search">
      <input type="text" value="" id="content" placeholder="" />
      <button onclick="go_search()">搜一下</button>
    </div>
  </div>
  <div class="bottom">
    <div class="bottom-footer">
      <?php
        if(get_option('ipic_icp')) { ?>
          <div><a href="https://beian.miit.gov.cn" target="_blank"><?=get_option('ipic_icp')?></a></div>
        <?php }
      ?>

      <?php
        if(get_option('ipic_icp_gov')) { ?>
          <div><a href="<?=icp_gov_url()?>" target="_blank"><?=get_option('ipic_icp_gov')?></a></div>
        <?php }
      ?>
    </div>
  </div>
</div>

<div class="bgi"><img style="opacity: 0;" src="" alt=""></div>

<script>
  if (localStorage.bgImg && localStorage.bgName ) { 
    let tag = document.querySelector('.bgi img');
    tag.setAttribute('src', localStorage.bgImg);
    tag.style.opacity = 1;
  }
  if(localStorage.bgTxt){
    document.querySelector('#content').setAttribute('placeholder', localStorage.bgTxt);
  }

  // datetime
  function now_time() {
    var nowdate = new Date();
    var year = nowdate.getFullYear(),
      month = nowdate.getMonth() + 1,
      date = nowdate.getDate(),
      day = nowdate.getDay(),
      week = ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"],
      h = nowdate.getHours(),
      m = nowdate.getMinutes(),
      s = nowdate.getSeconds();
    h = h < 10 ? '0' + h : h;
    m = m < 10 ? '0' + m : m;
    s = s < 10 ? '0' + s : s;
    document.querySelector('.time').innerHTML = h + ':' + m;
    document.querySelector('.date').innerHTML = year + "年" + month + "月" + date + "日 " + week[day];
  };
  now_time();
  setInterval(now_time, 1000);

  // text
  function get_txt() {
    const text = '<?=$copyright?>';
    document.querySelector('#content').setAttribute('placeholder', text);
    localStorage.bgTxt = text;
  }

  // 背景图
  if (!localStorage.bgImg || !localStorage.bgName) {
    //初始化
    let time = new Date;
    let nian = time.getFullYear();
    let Month = time.getMonth() + 1;
    let Day = time.getDate();
    localStorage.bgName = nian + '' + Month + Day;
    getBase64('<?=$url?>');
  } else {
    let time = new Date;
    let nian = time.getFullYear();
    let Month = time.getMonth() + 1;
    let Day = time.getDate();
    let wch_sb = nian + '' + Month + Day;
    if (localStorage.bgName != wch_sb) {
      localStorage.bgName = wch_sb;
      get_txt();
      getBase64('<?=$url?>');
    }
  }

  // 文字
  if (!localStorage.bgTxt) {
    get_txt();
  } else {
    let time = new Date;
    let nian = time.getFullYear();
    let Month = time.getMonth() + 1;
    let Day = time.getDate();
    let wch_sb = nian + '' + Month + Day;
    if (localStorage.bgName != wch_sb) {
      get_txt();
    }
  }

  // 下载图片，并缓存
  function getBase64(imgUrl) {
    window.URL = window.URL || window.webkitURL;
    var xhr = new XMLHttpRequest();
    xhr.open("get", imgUrl, true);
    xhr.responseType = "blob";
    xhr.onload = function () {
      if (this.status == 200) {
        var blob = this.response;
        let oFileReader = new FileReader();
        oFileReader.onloadend = function (e) {
          localStorage.bgImg = e.target.result;
          let tag = document.querySelector('.bgi img');
          tag.setAttribute('src', localStorage.bgImg);
          tag.style.opacity = 1;
        }
        oFileReader.readAsDataURL(blob);
      }
    }
    xhr.send();
  }
  

  // search
  function go_search() {
    
    var content = document.querySelector('#content').value;
    if (content.length > 0) {
      window.location.href = 'https://cn.bing.com/search?q=' + content;
    } else {
      window.location.href = '<?=$copyrightLink?>';
    }
  }

  document.onkeydown = function (e) {
    var theEvent = window.event || e;
    var code = theEvent.keyCode || theEvent.which || theEvent.charCode;
    if (code == 13) {
      go_search();
    }
  }
</script>