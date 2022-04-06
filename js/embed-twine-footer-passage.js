function EmbedTwineUpdateHeight(){
  var passage = document.getElementsByTagName("tw-passage")[0];

	if (passage === undefined){//SugarCube
		passage = document.getElementById("passages");
	}

  var newHeight = passage.offsetHeight;
  if(newHeight<500){newHeight=500;}
  window.parent.postMessage(["setHeight", newHeight], "*");
	console.log(newHeight);
}
setTimeout(EmbedTwineUpdateHeight, 50);
