@extends('frontend-v2.layouts.app')

@section('css')
<style>
text{
        font-family:Helvetica, Arial, sans-serif;
        font-size:11px;
        pointer-events:none;
    }
    #minigame{
        margin-bottom: 40px;
    }
    #minigame h2{
        text-align: center;
        font-style: ;
        font-weight: bold;
    }
    #minigame h4{
        text-align: center;
        font-style: ;
        font-weight: ;
    }
	#spin{
		
	}
	#spin img{
		width: 100%;
	}
	#bg{
		margin-bottom: 20px;
	}
	#bg img{
        margin: 10px 0px;
		width: 100%;
	}
	
   //* #chart{
      
        width:500px;
        height:500px;
        top:0;
        left:0;
    }
    #question{
    }
    #question h1{
        font-size: 50px;
        font-weight: bold;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    }
</style>
@endsection

@section('content')
<div class="container" id="minigame">
    <h2>MINI GAME QUAY SỐ MAY MẮN</h2>
    <div class="row" id="bg">
        <div class="col-sm-12">
			<a href="{{ route('game3')}}"><img src="{{static_asset('assets/img/Trang-Mini-Game-2_03.png')}}"/></a>
        </div>
        <div class="col-sm-12">
            <a href="{{ route('game3')}}"><img src="{{static_asset('assets/img/Trang-Mini-Game-2_06.png')}}"/></a>
        </div>
        <div class="col-sm-12">
            <a href="{{ route('game3')}}"><img src="{{static_asset('assets/img/Trang-Mini-Game-2_08.png')}}"/></a>
        </div>
	</div>

    <h4>Điều kiện tham dự quay thưởng</h4>
	
</div>

    <!--
    <div class="row my-5">
        <div class="col-sm-4">
            <div id="chart"  style="background-image: url('{{static_asset('assets/img/spin-bg6.svg')}}'); width: 500px;"></div>
        </div>
        <div class="col d-flex align-items-center">
            <div id="question"><h1></h1></div>
        </div>
    </div>
-->
</div>

    
<!--<script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>


@endsection

@section('extended_scripts')
<script>
var padding = {top:20, right:40, bottom:0, left:0},
            w = 500 - padding.left - padding.right,
            h = 500 - padding.top  - padding.bottom,
            r = Math.min(w, h)/2,
            rotation = 0,
            oldrotation = 0,
            picked = 100000,
            oldpick = [],
            color = d3.scale.category20();
            //category20c()
            //randomNumbers = getRandomNumbers();
        //http://osric.com/bingo-card-generator/?title=HTML+and+CSS+BINGO!&words=padding%2Cfont-family%2Ccolor%2Cfont-weight%2Cfont-size%2Cbackground-color%2Cnesting%2Cbottom%2Csans-serif%2Cperiod%2Cpound+sign%2C%EF%B9%A4body%EF%B9%A5%2C%EF%B9%A4ul%EF%B9%A5%2C%EF%B9%A4h1%EF%B9%A5%2Cmargin%2C%3C++%3E%2C{+}%2C%EF%B9%A4p%EF%B9%A5%2C%EF%B9%A4!DOCTYPE+html%EF%B9%A5%2C%EF%B9%A4head%EF%B9%A5%2Ccolon%2C%EF%B9%A4style%EF%B9%A5%2C.html%2CHTML%2CCSS%2CJavaScript%2Cborder&freespace=true&freespaceValue=Web+Design+Master&freespaceRandom=false&width=5&height=5&number=35#results
        var data = [
            //giải đặc biệt- giải nhất- giải nhì- giải ba- giải khuyến khích- chúc bạn may nắm lần sau
            {"label":"Giải Đặc Biệt", "value" : 1, "question":"Bạn trúng giải đặc biệt"},
            {"label":"Giải Nhất", "value" : 2, "question":"Bạn trúng giải nhất"},
            {"label":"Giải Nhì", "value" : 3, "question":"Bạn trúng giải nhì"},
            {"label":"Giải Ba", "value" : 4, "question":"Bạn trúng giải ba"},
            {"label":"Giải Khuyến Khích", "value" : 5, "question":"Bạn trúng giải khuyến khích"},
            {"label":"Chúc Bạn May Mắn Lần Sau", "value" : 6, "question":"Chúc bạn may mắn lần sau.."}
        ];
        var svg = d3.select('#chart')
            .append("svg")
            .data([data])
            .attr("width",  w + padding.left + padding.right)
            .attr("height", h + padding.top + padding.bottom);
        var container = svg.append("g")
            .attr("class", "chartholder")
            .attr("transform", "translate(" + (w/2 + padding.left) + "," + (h/2 + padding.top) + ")");
        var vis = container
            .append("g");
            
        var pie = d3.layout.pie().sort(null).value(function(d){return 1;});
        // declare an arc generator function
        var arc = d3.svg.arc().outerRadius(r);
        // select paths, use arc generator to draw
        var arcs = vis.selectAll("g.slice")
            .data(pie)
            .enter()
            .append("g")
            .attr("class", "slice");
            
        arcs.append("path")
            .attr("fill", function(d, i){ return color(i); })
            .attr("d", function (d) { return arc(d); });
        // add the text
        arcs.append("text").attr("transform", function(d){
                d.innerRadius = 0;
                d.outerRadius = r;
                d.angle = (d.startAngle + d.endAngle)/2;
                return "rotate(" + (d.angle * 180 / Math.PI - 90) + ")translate(" + (d.outerRadius -10) +")";
            })
            .attr("text-anchor", "end")
            .text( function(d, i) {
                return data[i].label;
            });
        container.on("click", spin);
        function spin(d){
            
            container.on("click", null);
            //all slices have been seen, all done
            console.log("OldPick: " + oldpick.length, "Data length: " + data.length);
            if(oldpick.length == data.length){
                console.log("done");
                container.on("click", null);
                return;
            }
            var  ps       = 360/data.length,
                 pieslice = Math.round(1440/data.length),
                 rng      = Math.floor((Math.random() * 1440) + 360);
                
            rotation = (Math.round(rng / ps) * ps);
            
            picked = Math.round(data.length - (rotation % 360)/ps);
            picked = picked >= data.length ? (picked % data.length) : picked;
            if(oldpick.indexOf(picked) !== -1){
                d3.select(this).call(spin);
                return;
            } else {
                oldpick.push(picked);
            }
            rotation += 90 - Math.round(ps/2);
            vis.transition()
                .duration(3000)
                .attrTween("transform", rotTween)
                .each("end", function(){
                    //mark question as seen
                    d3.select(".slice:nth-child(" + (picked + 1) + ") path")
                        .attr("fill", "#111");
                    //populate question
                    d3.select("#question h1")
                        .text(data[picked].question);
                    oldrotation = rotation;
              
                    /* Get the result value from object "data" */
                    console.log(data[picked].value)
              
                    /* Comment the below line for restrict spin to sngle time */
                    container.on("click", spin);
                });
        }
        //make arrow
        svg.append("g")
            .attr("transform", "translate(" + (w + padding.left + padding.right) + "," + ((h/2)+padding.top) + ")")
            .append("path")
            .attr("d", "M-" + (r*.15) + ",0L0," + (r*.05) + "L0,-" + (r*.05) + "Z")
            .style({"fill":"black"});
        //draw spin circle
        container.append("circle")
            .attr("cx", 0)
            .attr("cy", 0)
            .attr("r", 60)
            .style({"fill":"white","cursor":"pointer"});
        //spin text
        container.append("text")
            .attr("x", 0)
            .attr("y", 15)
            .attr("text-anchor", "middle")
            .text("QUAY")
            .style({"font-weight":"bold", "font-size":"30px"});
        
        
        function rotTween(to) {
          var i = d3.interpolate(oldrotation % 360, rotation);
          return function(t) {
            return "rotate(" + i(t) + ")";
          };
        }
        
        
        function getRandomNumbers(){
            var array = new Uint16Array(1000);
            var scale = d3.scale.linear().range([360, 1440]).domain([0, 100000]);
            if(window.hasOwnProperty("crypto") && typeof window.crypto.getRandomValues === "function"){
                window.crypto.getRandomValues(array);
                console.log("works");
            } else {
                //no support for crypto, get crappy random numbers
                for(var i=0; i < 1000; i++){
                    array[i] = Math.floor(Math.random() * 100000) + 1;
                }
            }
            return array;
        }
</script>
@endsection