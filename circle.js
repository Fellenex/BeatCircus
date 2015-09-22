function drawCircle(canvasSize,circleSize,beatsPerBar,basalBeat){
	var c = document.getElementById("myCanvas");
	var ctx = c.getContext("2d");
	var cCentre = canvasSize/2;
	var beatCircleSize = 15
	

	ctx.beginPath();
	ctx.arc(cCentre,cCentre,circleSize,0,2*Math.PI);
	ctx.stroke();

	ctx.beginPath();
	ctx.moveTo(cCentre,cCentre);
	ctx.lineTo(cCentre,cCentre-circleSize);
	ctx.stroke();

	if (basalBeat == 4){
		if (beatsPerBar == 4){
			//4/4 time
			ctx.beginPath();
			ctx.arc(cCentre,cCentre-circleSize,beatCircleSize,0,2*Math.PI); //top circle
			ctx.stroke();

			ctx.beginPath();
			ctx.arc(cCentre+circleSize,cCentre,beatCircleSize,0,2*Math.PI); //right circle
			ctx.stroke();

			ctx.beginPath();
			ctx.arc(cCentre,cCentre+circleSize,beatCircleSize,0,2*Math.PI); //bottom circle
			ctx.stroke();

			ctx.beginPath();
			ctx.arc(cCentre-circleSize,cCentre,beatCircleSize,0,2*Math.PI); //left circle
			ctx.stroke();


			//ctx.beginPath();
			//ctx.stroke();
		}
		else if (beatsPerBar == 3){
			//3/4 time
		}
		else if (beatsPerBar == 2){
			//2/4 time
		}
	}
	else if (basalBeat == 8){

	}
	else{
		//Oops, no good.
	}
	return 0;
}

function rotateBar(interval){
	//pass
}

//use http://anthonyterrien.com/knob/ and CSS classes to swap circle types