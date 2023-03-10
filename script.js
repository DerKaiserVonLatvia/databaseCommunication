// NOTE: RUN WITH HTTP://, NOT FILE://
function FETCHDB() {
  var xmlhttp = new XMLHttpRequest();

  xmlhttp.open("POST", "https://magical-starlight-de7eaf.netlify.app/serverside.js", true);
  xmlhttp.setRequestHeader("Access-Control-Allow-Origin", "*");
xmlhttp.setRequestHeader("Content-Type","application/json");
  xmlhttp.onreadystatechange = function () {
    if (this.readyState === 4 || this.status === 200) {
      document.getElementById("demo").innerHTML = xmlhttp.responseText;
    }
  };
  xmlhttp.send("dataSent="+"request_DB");
}

function WRITEDB(){
  "use strict";   


  let payload={
    "org_name":org.value,
    "event_name":evname.value,
    "contacts":cont.value,
    "start_date":start.value,
    "end_date":end.value
  };
  let DT_regex=/(:)/g;
  payload["start_date"]=payload["start_date"].replace(DT_regex, '@');
  payload["end_date"]=payload["end_date"].replace(DT_regex, '@');
  Object.keys(payload).forEach(key => {
    if (payload[key]=="" || payload[key]==null)
    {
      payload[key]="NULL";
    }
  });
  let payloadString=JSON.stringify(payload);
  console.log(payloadString);
  //var regex=/([{-}",=])+()/g;

  //payloadString = payloadString.replace(regex, " ");
  //regex=/( : )/g;
  //payloadString=payloadString.replace(regex, ':');

  let regex=/([{-}"])/g
  payloadString=payloadString.replace(regex, '');
  payloadString=payloadString.replace(DT_regex, '=');
  DT_regex=/(@)/g;
  payloadString=payloadString.replace(DT_regex, ':');
  console.log(payloadString);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("POST", "https://magical-starlight-de7eaf.netlify.app/serverside.js", true);
  xmlhttp.setRequestHeader("Access-Control-Allow-Origin", "*");
xmlhttp.setRequestHeader("Content-Type","application/json");
  xmlhttp.onreadystatechange = function() {
      if (this.readyState === 4 || this.status === 200){ 
          console.log(this.responseText); // echo from php
      }       
  };
  xmlhttp.send("dataSent="+payloadString);
  }

