function readImagesAndSetAsBackground(files) {
	for(var i=0; i < files.length; i++) {
		var f = files[i];
		  
		var reader = new FileReader();
			
		reader.onload = function(e) {				
			document.getElementById("imgContainer").style.background = "url('" + e.target.result + "') center";
			document.getElementById("imgContainer").style.backgroundRepeat = "no-repeat";
			document.getElementById("imgContainer").style.backgroundSize = "cover";
	    }
		  
	   reader.readAsDataURL(f);
	}
}
document.getElementById("clearFile").addEventListener("click", function(){
	document.getElementById("prodImg").value = "";
	document.getElementById("imgContainer").style.background = "url('../../imagems/noImage.png') center";
	document.getElementById("imgContainer").style.backgroundRepeat = "no-repeat";
	document.getElementById("imgContainer").style.backgroundSize = "cover";
});