<!DOCTYPE html>
<html>
    <head>
        <title>jQuery Knob demo</title>
        <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>-->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!--[if IE]><script type="text/javascript" src="excanvas.js"></script><![endif]-->
        <script src="jQuery-Knob/dist/jquery.knob.min.js"></script>
        <script>
            var activeAreas = Array();
            var sample = new Audio("sounds/808-Clap.wav");

            //TODO: Constants
            for (var i=0; i<8; i++){
                activeAreas[i] = 0;
            }

            activeAreas[0] = 1;
            activeAreas[4] = 1;

            $(function($) {

                $(".knob").knob({

                    change : function (value) {
                        //console.log("change : " + value);
                        if (activeAreas[value] == 1){
                            sample.play();
                        }
                        else{
                            console.log(activeAreas[value])
                        }
                    },
                    release : function (value) {
                        //console.log(this.$.attr('value'));
                        //console.log("release : " + value);
                    },
                    cancel : function () {
                        //console.log("cancel : ", this);
                    },
                    /*format : function (value) {
                        return value + '%';
                    },*/
                    draw : function () {

                        // "tron" case
                        if(this.$.data('skin') == 'tron') {

                            this.cursorExt = 0.3;

                            var a = this.arc(this.cv)  // Arc
                                , pa                   // Previous arc
                                , r = 1;

                            this.g.lineWidth = this.lineWidth;

                            if (this.o.displayPrevious) {
                                pa = this.arc(this.v);
                                this.g.beginPath();
                                this.g.strokeStyle = this.pColor;
                                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, pa.s, pa.e, pa.d);
                                this.g.stroke();
                            }

                            this.g.beginPath();
                            this.g.strokeStyle = r ? this.o.fgColor : this.fgColor ;
                            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, a.s, a.e, a.d);
                            this.g.stroke();

                            this.g.lineWidth = 2;
                            this.g.beginPath();
                            this.g.strokeStyle = this.o.fgColor;
                            this.g.arc( this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                            this.g.stroke();

                            return false;
                        }
                    }
                });
            });
        </script>
        <style>
            body{
              padding: 0;
              margin: 0px 50px;
              font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
              font-weight: 300;
              text-rendering: optimizelegibility;
            }
            p{font-size: 30px; line-height: 30px}
            div.demo{text-align: center; width: 280px; float: left}
            div.demo > p{font-size: 20px}
        </style>
    </head>
    <body>
        <script>
        var bpm = 60.0;

        //1000 ms/s
        //(x beats / 1 minute) / (60 seconds / 1 minute) == x beats per second
        //We also need to include a modifier for the quickest note in the circle
            //ie, if we only ever need quarter notes, then no modification.
        var tickRate = (1000.0 / (bpm / 60.0));
        var maxFraction = 8;
        //var metronome = new Audio("sounds/808-Clap.wav");
        
        //Ticks eighth notes
        function eighthClock() {
            var $s = $(".second"),
                d = new Date(),
                s = d.getSeconds();
            $s.val((s%8)+1).trigger("change"); //TODO Maaaaaagic Numbers
            setTimeout("eighthClock()", tickRate / 2);
        }

        //Ticks quarter notes
        function quarterClock(oldBeat){
            //Metronome tick
            //metronome.play();

            //Shake my head
            var $s = $(".second"),
                $m = $(".minute"),
                $h = $(".hour");

            var newBeat = oldBeat+1;
            
            //Update circles
            $s.val(newBeat%maxFraction+1).trigger("change"); //TODO Maaaaaagic Numbers
            //$m.val(((s%8)*2)+1).trigger("change");
            //$h.val(((s%8)+1)/2).trigger("change");
            

            //Anonymous function injected so that we can pass newBeat as a parameter.
            setTimeout(function(){quarterClock(newBeat)}, tickRate);
        }
        //eighthClock();
        quarterClock(1);
        </script>

        <div class="demo" style="color:#EEE;background:#222;height:420px;width:100%">
            <p>&#215; Superpose (clock)</p>
            <div style="position:relative;width:350px;margin:auto">

                <!-- We start indexing data-min with 1, because music is counted "1-2-3-4", not "0-1-2-3" -->
                <div style="position:absolute;left:10px;top:10px">
                    <input class="knob hour" data-min="1" data-max="33" data-bgColor="#333" data-fgColor="#ffec03" data-displayInput=false data-width="300" data-height="300" data-thickness=".3">
                </div>
                <div style="position:absolute;left:60px;top:60px">
                    <input class="knob minute" data-min="1" data-max="33" data-bgColor="#333" data-displayInput=false data-width="200" data-height="200" data-thickness=".45">
                </div>
                <div style="position:absolute;left:110px;top:110px">
                    <input class="knob second" data-min="1" data-max="9" data-bgColor="#333" data-fgColor="rgb(127, 255, 0)" data-displayInput=true data-width="100" data-height="100" data-thickness=".3">
                </div>

                
            </div>
        </div>

        <form id="circleStatsForm" method="POST" action="index.php">
            <input type="text" name="bpmBox" placeholder="BPM"/>
            <br/>
            <select name="timeSigBox" placeholder="Time Signature">
                <option value="24">2/4</option>
                <option value="34">3/4</option>
                <option value="44">4/4</option>
                <option value="68">6/8</option>
            </select>
            <br/>
            <select name="soundkitBox" placeholder="Sound Kit">
                <option value="GBA">GBA</option>
            </select>
            <br/>
            <input type="submit" value="submit"/>
        </form>
    </body>
</html>
