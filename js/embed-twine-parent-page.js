var myIframeTop = null;

window.addEventListener('message', function(e) {

  //var $iframe = jQuery("#my_iframe");
  var eventName = e.data[0];
  var data = e.data[1];
  switch(eventName) {
    case 'setHeight':
      //$iframe.height(data);
      fixData = data + heightAdjustment;
      document.getElementById("my_iframe").style.height = fixData + "px";
      if(autoscroll){
        window.scrollTo({
          top: myIframeTop,
          left: 0,
          behavior: 'smooth'
        });
      }
      break;
  }
}, false);

function EmbedTwineCacheIframe(){
    var myIframeEl = document.getElementById("my_iframe");
    var position = myIframeEl.getBoundingClientRect();
    myIframeTop = position.top - scrollAdjustment;
}

setTimeout(EmbedTwineCacheIframe, 50);
