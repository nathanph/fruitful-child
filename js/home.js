 // A $( document ).ready() block.
jQuery( document ).ready(function() {
	setInterval(function(){changeSmiley()},10000);
});

function changeSmiley() {
	var random = Math.floor((Math.random()*3));
	var character;
	if(random==0)
		character = Math.floor((Math.random()*10)+48);
	else if(random==1)
		character = Math.floor((Math.random()*26)+65);
	else if(random==2)
		character = Math.floor((Math.random()*26)+97);
	else if(random==3) {
		var options = new Array("$","/","%","\"","#","&",".","!");
		character = options[Math.floor(Math.random()*options.length)];
	}
	jQuery('.smiley').fadeOut(400,function(){
		jQuery('.smiley').text(String.fromCharCode(character));
		jQuery('.smiley').fadeIn();
	});
}