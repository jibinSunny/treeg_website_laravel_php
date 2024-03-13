
<style>
  #myProgress {
    width: 100%;
    padding-top:5px;
  }
  
  #myBar {
    width: 100%;
    height: 1px;
    background-color: #fff;
    text-align: center;
  }
  #message {
    visibility: hidden;
    min-width: 250px;
    margin-left: -125px;
    color: #fff;
    text-align: center;
    border-radius: 4px;
    padding: 16px;
    position: fixed;
    z-index: 1000;
    left: 50%;
    top:100px;
    font-size: 17px;  
  }
  #message.show {
    visibility: visible;
    -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
    z-index: 1000;  
  }
  @-webkit-keyframes fadein {
    from {top: 0; opacity: 0;} 
    to {top: 100px; opacity: 1;}
  }
  
  @keyframes fadein {
    from {top: 0; opacity: 0;}
    to {top: 100px; opacity: 1;}
  }
  /* @-webkit-keyframes fadeout {
    from {top: 100px; opacity: 1;} 
    to {top: 0; opacity: 0;}
  } */
  
  /* @keyframes fadeout {
    from {top: 100px; opacity: 1;}
    to {top: 0; opacity: 0;}
  } */
  </style>
  
  @if( Session::has('success'))
      <div class="section notification is-success" id="message" style="background-color: #23d160;">
          {{ Session::get('success') }}   
          <div id="myProgress"><div id="myBar"></div></div>
      </div>
  @endif
  @if( Session::has('warning'))
      <div class="section notification is-warning" id="message" style="background-color: #000;">
          {{ Session::get('warning') }}
          <div id="myProgress"><div id="myBar"></div></div>
      </div>   
  @endif
  @if( Session::has('danger'))
      <div class="section notification is-danger" id="message" style="background-color: #f00;">
          {{ Session::get('danger') }}    
          <div id="myProgress"><div id="myBar"></div></div>
      </div>    
  @endif
  @if ($errors->any())
      <div class="section notification is-warning"  id="message" style="background-color: #000;">
          <ul type="disc">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>   
          <div id="myProgress"><div id="myBar"></div></div>
      </div>
  @endif
  
  <script>
  function message() 
  {
    var x = document.getElementById("message");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 6000);
    var elem = document.getElementById("myBar");   
    var width = 100;
    var id = setInterval(frame, 50);
    function frame() {
      if (width <= 0) {
        clearInterval(id);
      } else {
        width--; 
        elem.style.width = width + '%'; 
      }
    }
  }
  window.onload = message;
  </script>
  