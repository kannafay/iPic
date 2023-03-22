<style>
  @import url('https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap');
  * {
    margin: 0;
    padding: 0;
    user-select: none;
  }
  *,
  *:before,
  *:after {
    box-sizing: border-box; 
  }
  *:before,
  *:after {
    content: ''; 
    position:absolute;
  }
  :root{
    --bg:rgb(231,227,226);
    --shadow:rgb(221,215,215);
    --border:rgb(0,0,0);
    --bubble:rgb(199,141,127);
    --text:rgb(255,254,243);
    --cup:rgb(255,255,255);
    --cup_heart:rgb(187,127,136);
    --book_1:rgb(184,152,157);
    --book_1D:rgb(159,130,134);
    --book_2:rgb(220,181,186);
    --book_2D:rgb(239,239,239);
    --book_2L:rgb(247,246,249);
    --book_3:rgb(192,178,178);
    --book_3D:rgb(158,148,149);
    --book_4:rgb(163,149,149);
    --book_4D:rgb(238,236,237);
    --book_4L:rgb(245,243,244);
    --steam:rgb(169,156,149);
    --leave_1:rgb(187,127,136); 
    --leave_2:rgb(224, 143, 98);
    --leave_3:rgb(157, 171, 134);
    --leave_4:rgb(236, 234, 95);
  /*    font-size:30px; */
  }
  body{
    background:var(--bg);
    overflow: hidden;
  }
  img{
    width:25em;
    height:auto; 
    position:absolute;
    top:62.5%;
    left:49%;
    transform:translate(-50%,-50%);
    opacity:0;
  }
  .container {
    width:20em;
    height:28em; 
    position:absolute;
    top:50%;
    left:50%;
    transform:translate(-50%,-50%);
  }
  .bubble{
    width:8em;
    height:6em;
    border-radius:57% 97% 78% 75% / 84% 70% 91% 76% ;
    position:absolute;
    top:0em;
    left:4em; 
  }
  .bubble::after{
    width:2em;
    height:3em;
    transform:scale(-1,1) rotate(-60deg) skew(-60deg) ;
    clip-path: polygon(0 78%, 54% 85%, 100% 100%, 0 100%);
    top:1.5em;
    left:0.55em;
  }
  .bubble-origin{
    border:0.13em solid var(--border);
  }

  .bubble-origin::after{
    background:var(--bg);
    border:0.13em solid var(--border);  
  }
  .bubble-shadow{
    background:var(--bubble);
    left:4.45em; 
  }
  .bubble-shadow::after{
    background:var(--bubble);
    z-index:1;
  }
  h1{
    display:inline-block;
    color:var(--text);
    font-size:1.6rem;
  /*   font-family: 'Sacramento', cursive; */
    font-family: 'Dancing Script', cursive;
    font-weight: lighter;
    position:absolute;
    top:1.2em;
    left:3.4em;   
  }
  .shadow{
    background:var(--shadow);
    position:absolute;
    transform:skew(43deg);
  }
  .shadow-1{
    width:4.5em;
    height:5em;
    top:13em;
    left:10.5em; 
  }
  .shadow-2{
    width:25em;
    height:14em;
    top:17em;
    left:-1em; 
    clip-path: polygon(51% 0, 100% 0, 100% 100%, 0 100%, 0 72%);
  }
  .book-1{
    width:16em;
    height:3.25em;
    background:linear-gradient(90deg 
      ,rgba(0,0,0,0) 8.5%
      ,var(--book_1D) 9%
      ,var(--book_1D) 15%
      ,rgba(0,0,0,0) 15.5%
      ,rgba(0,0,0,0) 17%
      ,var(--book_1D) 17.5%
      ,var(--book_1D) 19%
      ,rgba(0,0,0,0) 19.5%
      ,rgba(0,0,0,0) 80.5%
      ,var(--book_1D) 81%
      ,var(--book_1D) 82.5%
      ,rgba(0,0,0,0) 83%
      ,rgba(0,0,0,0) 84.5% 
      ,var(--book_1D) 85% 
      ,var(--book_1D) 91%
      ,rgba(0,0,0,0) 91.5% )
      ,var(--book_1); 
    border-radius:7%/30% ;
    position:absolute;
    bottom:0em;
    left:2em; 
  }
  .book-1::before{
    width:7em;
    height:0.4em;
    background:var(--book_1D);
    top:1.2em;
    left:4.7em;
  }
  .book-1::after{
    width:6em;
    height:0.15em;
    background:var(--book_1D);
    top:1.9em;
    left:5.3em;
  }
  .book-2{
    width:15.8em;
    height:2.1em;
    background:linear-gradient(180deg 
      ,var(--book_2D) 49% 
      ,var(--book_2L) 50%
  ); 
    position:absolute;
    bottom:3.7em;
    left:2.2em; 
  }
  .book-2::before{
    width:16em;
    height:0.4em;
    background:var(--book_2);
    position:absolute;
    top:-0.4em;
    left:-0.1em; 
  }
  .book-2::after{
    width:16em;
    height:0.4em;
    background:var(--book_2);
    position:absolute;
    bottom:-0.45em;
    left:-0.1em; 
  }
  .book-3{
    width:14.8em;
    height:2.8em;
    background:linear-gradient(90deg 
      ,rgba(0,0,0,0) 8.5%
      ,var(--book_3D) 9%
      ,var(--book_3D) 9.5%
      ,rgba(0,0,0,0) 10%
      ,rgba(0,0,0,0) 11.5%
      ,var(--book_3D) 12%
      ,var(--book_3D) 12.5%
      ,rgba(0,0,0,0) 13%
      ,rgba(0,0,0,0) 87%
      ,var(--book_3D) 87.5%
      ,var(--book_3D) 88%
      ,rgba(0,0,0,0) 88.5%
      ,rgba(0,0,0,0) 90% 
      ,var(--book_3D) 90.5% 
      ,var(--book_3D) 91%
      ,rgba(0,0,0,0) 91.5% )
      ,var(--book_3); 
    border-radius:7%/30% ;
    position:absolute;
    bottom:6.2em;
    left:2.7em; 
  }
  .book-3::before{
    width:6.7em;
    height:0.6em;
    background:var(--book_3D);
    top:0.95em;
    left:4.4em;
  }
  .book-3::after{
    width:3.8em;
    height:0.1em;
    background:var(--book_3D);
    top:1.8em;
    left:6.8em;
  }
  .book-4{
    width:14.5em;
    height:1.8em;
    background:linear-gradient(180deg 
      ,var(--book_4L) 49% 
      ,var(--book_4D) 50% ); 
    position:absolute;
    bottom:9.22em;
    left:2.8em; 
  }
  .book-4::before{
    width:14.6em;
    height:0.35em;
    background:var(--book_4);
    position:absolute;
    top:-0.3em;
    left:-.03em; 
  }
  .book-4::after{
    width:14.6em;
    height:0.35em;
    background:var(--book_4);
    position:absolute;
    bottom:-0.3em;
    left:-.03em; 
  }
  .cup{
    width:4.5em;
    height:4.8em;
    background:var(--cup); 
    position:absolute;
    bottom:11.35em;
    left:7.8em;  
    clip-path: polygon(0 0, 100% 0, 80% 100%, 20% 100%);
  }
  .cup::before{
    width:0.8em;
    height:1.5em;
    background:var(--cup_heart); 
    border-radius: 50% 50% 0 0;
    top:1.2em;
    left:1.5em;
    transform: rotate(-50deg);
  }
  .cup::after{
    width:0.8em;
    height:1.5em;
    background:var(--cup_heart); 
    border-radius: 50% 50% 0 0;
    top:1.2em;
    left:2.2em; 
    transform: rotate(50deg);
  }
  .cup-hand{
    width:3.2em;
    height:2.5em;
    background:var(--cup); 
    border-radius:89% 40% 57% 50% / 64% 53% 80% 57% ;
    position:absolute;
    bottom:12.7em;
    left:9.8em;  
  }
  .cup-hand::after{
    width:3em;
    height:2.2em;
    background:var(--shadow);
    border-radius:89% 40% 57% 50% / 64% 53% 80% 57% ;
    top:0.15em
  }
  .cup-steam{
    width:2em;
    height:1.4em;
    position:absolute;
    top:10.1em;
    left:8.2em;
    overflow:hidden;
  }
  .cup-steam::before{
    width: 2em;
    height: 1em;
    border-radius: 100%;
    border: 0.2em solid var(--steam);
    top: -0.1em;
    left:0.1em;
    clip-path: circle(40% at 5% 90%);
    transform: skew(-20deg);
  }
  .cup-steam::after{
    width: 2em;
    height: 1em;
    border-radius: 100%;
    border: 0.2em solid var(--steam);
    top: 0.5em;
    left: -1em;
    clip-path: circle(50% at 100% 5%);
    transform: rotate(8deg);
  }

  .cup-steam_2{
    left:9em;
  }

  .leave {
    width: 2em;
    height: 2em;
    border-radius: 0 50% 50% 50%;
    position:absolute;
    opacity:1;
  }
  .leave::before {
    width: 0.3em;
    height: 1em;
    top: 1.3em;
    left: 1.5em;
    transform:rotate(-50deg);
  }
  .leave-1{
    top: -3em;
    left: 5vw;
    background: var(--leave_4);  
    animation:moveLeave 2s infinite;
  }
  .leave-1::before{
    background: var(--leave_4);  

  }
  .leave-2{
    top: -3em;
    left: 30vw;
    background:var(--leave_2);  
    transform:rotate(-90deg);
    animation:moveLeave2 3s infinite both;
  }
  .leave-2::before{
    background:var(--leave_2);   
  }

  .leave-3{
    top:-3em;
    left: 70vw;
    background:var(--leave_3);  
    transform:rotate(90deg);
    animation:moveLeave3 3s infinite;
  }
  .leave-3::before{
    background:var(--leave_3);   
  }
  .leave-4{
    top: -3em;
    left: 90vw;
    background:var(--leave_1);  
    transform:rotate(180deg);
    animation:moveLeave4 2s infinite;
  }
  .leave-4::before{
    background:var(--leave_1);  
  }

  /* **********Animation************ */
  @keyframes moveLeave{
    0%{
    opacity:1;
    transform:translate(0,0);
    }
    100%{
    opacity:0;
    transform:translate(95vw,95vh);
    }
  }

  @keyframes moveLeave2{
    0%{
    opacity:1;
    transform:translate(0,0);
    }
    100%{
    opacity:0;
    transform:translate(0,95vh);
    }
  }
  @keyframes moveLeave3{
    0%{
    transform: translate(0,0) rotate(90deg);
    }
    100%{
    transform: translate(0,95vh) rotate(180deg);
    }
  }

  @keyframes moveLeave4{
    0%{
    opacity:1;
    transform:translate(0,0) rotate(180deg);
    }
    100%{
    opacity:0;
    transform:translate(-95vw,95vh) rotate(0deg);
    }
  }

  /* ********  Media Queries ********* */
  @media only screen and (max-width: 600px) {
    :root{
      font-size:10px;
    }
  } 
</style>

<div class="container">
  <div class="bubble bubble-shadow"></div>
  <div class="bubble bubble-origin"></div>
  <h1>Welcome</h1>
  <div class="shadow shadow-1"></div>
  <div class="shadow shadow-2"></div>
  <div class="book-1"></div>
  <div class="book-2"></div>
  <div class="book-3"></div>
  <div class="book-4"></div>
  <div class="cup-hand"></div>
  <div class="cup"></div>
  <div class="cup-steam"></div>
  <div class="cup-steam cup-steam_2"></div>  
</div>

<div class="leave leave-1"></div>
<div class="leave leave-2"></div>
<div class="leave leave-3"></div>
<div class="leave leave-4"></div>
