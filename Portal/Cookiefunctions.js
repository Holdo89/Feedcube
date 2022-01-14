function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }
  
  function checkCookie(cookiename, elementid){
    let cookie = getCookie(cookiename);
    if (cookie == 0) {
      document.getElementById(elementid).style.display="block";
    } 
    else{
      document.getElementById(elementid).style.display="none";
    }
  }

  function showExample(id){
    document.getElementById(id).style.display="block";
    document.getElementById(id).style.height="auto";
    if(id=="range"){
      document.getElementById("range").innerHTML="<div style='text-align:center'><p style='margin-bottom:20px;'>Bewertung: <span id='output' style='font-size:15px;'>50</span></p><input type='range' style='width:70%; margin:auto;' min='0' max='100' value='50' name='element_1_1' id='element_1_1' ontouchend='input_update(1)' oninput='input_update(1), color(1)'></div>";
    }
  }

  function input_update(i)
  {
      var value = document.getElementById("element_1_"+i).value;
      var output = document.getElementById("output");
      output.innerHTML = value;
  }
  function color(i) 
  { 
      var slider = document.getElementById("element_1_"+i)
      var value = (slider.value-slider.min)/(slider.max-slider.min)*100
      var value2 = value-10
      var temp =  (slider.value-slider.min)*(100/(slider.max-slider.min));
      var color =  "hsl("+temp+", 100%, 50%) ";
      var color2 =  "#82CFD0 ";
      slider.style.background = 'linear-gradient(to right, '+color+'0%, '+color + value2 + '%, '+color+value2+'%, '+color2 + value + '%, #fff ' + value + '%, white 100%)'
  }