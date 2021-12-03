@extends('frontend-v2.layouts.app')

@section('css')
<style>
text{
        font-family:Helvetica, Arial, sans-serif;
        font-size:11px;
        pointer-events:none;
    }
    #spin{
        
    }
    #spin img{
        width: 100%;
    }
    #bg1{
        margin-bottom: 20px;
    }
    
    #bg2{
        margin: 20px 0px;
    }
    #bg2 img{
        width: 100%;
    }
    #reward{
        margin: 40px 0px;
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

/* Responsive images */
.typo img {
  max-width: 100%;
}

.hc-luckywheel ul,
.hc-luckywheel li {
  margin: 0;
  padding: 0;
  list-style: none;
}

.hc-luckywheel {
  position: relative;
  width: 375px; /*Change this when change size*/
  height: 375px; /*Change this when change size*/
  border-radius: 50%;
  /*border: 16px solid #e44025;*/
  box-shadow: 0 2px 3px #333, 0 0 2px #000;
}

.hc-luckywheel-container {
  position: absolute;
  left: -100 !important;
  top: -10 !important;
  z-index: 1;
  width: inherit;
  height: inherit;
  border-radius: inherit;
  background-clip: padding-box;
  background-color: #ffcb3f;
  -webkit-transition: transform 6s ease;
  transition: transform 6s ease;
}

.hc-luckywheel-container canvas {
  width: inherit;
  height: inherit;
  border-radius: 50%;
}

.hc-luckywheel-list {
  position: absolute;
  left: 0;
  top: 0;
  width: inherit;
  height: inherit;
  z-index: 2;
}

.hc-luckywheel-item {
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  color: #e4370e;
  font-weight: bold;
  text-shadow: 0 1px 1px rgba(255, 255, 255, 0.6);
}

.hc-luckywheel-item span {
  position: relative;
  display: block;
  padding-top: 20px;
  /* width: 50px; */
  margin: 0 auto;
  text-align: center;
  -webkit-transform-origin: 50% 190px; /*Change this when change size*/
  -ms-transform-origin: 50% 190px; /*Change this when change size*/
  transform-origin: 50% 190px;
} /*Change this when change size*/

.hc-luckywheel-item img {
  position: relative;
  top: -35px;
  left: 0px;
  width: 80px; /*Change this when change size*/
  height: 80px;
} /*Change this when change size*/

.hc-luckywheel-btn {
  position: absolute;
  left: 160px; /*Change this when change size*/
  top: 160px; /*Change this when change size*/
  z-index: 3;
  width: 60px;
  height: 60px;
  border-radius: 50%;
  color: #f4e9cc;
  background-color: #e44025;
  line-height: 60px;
  text-align: center;
  font-size: 20px;
  text-shadow: 0 -1px 1px rgba(0, 0, 0, 0.6);
  box-shadow: 0 3px 5px rgba(0, 0, 0, 0.6);
  text-decoration: none;
}

.hc-luckywheel-btn::after {
  position: absolute;
  display: block;
  content: "";
  left: 10px;
  top: -33px;
  width: 0;
  height: 0;
  overflow: hidden;
  border-width: 20px;
  border-style: solid;
  border-color: transparent;
  border-bottom-color: #e44025;
}

.hc-luckywheel-btn.disabled {
  pointer-events: none;
  background: #b07a7b;
  color: #ccc;
}

.hc-luckywheel-btn.disabled::after {
  border-bottom-color: #b07a7b;
}


.bg {
  background-image: url('../images/bg.png');
}
text{
        font-family:Helvetica, Arial, sans-serif;
        font-size:11px;
        pointer-events:none;
    }
    #spin{
        
    }
    #spin img{
        width: 100%;
    }
    #bg1{

    }
    #bg1 p{
        text-align: center;
        padding: 10px 0px;
        color: #000;
        font-weight: bold;
    }
    #bg2{
        margin: 20px 0px;
    }
    #bg2 img{
        width: 100%;
        margin: 10px 0px;
    }
    #reward{
        margin: 40px 0px;
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
      }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row" id="bg1">
    	<div class="col-sm-4">
            <div class="wrapper typo" id="wrapper">
              <section id="luckywheel" class="hc-luckywheel">
                <div class="hc-luckywheel-container">
                  <canvas class="hc-luckywheel-canvas" width="500px" height="500px">Vòng Xoay May Mắn
                    <img src="images/spin-bg6.svg;" width="600px">
                    </canvas>
                </div>
                <a class="hc-luckywheel-btn" href="javascript:;">Quay</a>
              </section>
    </div>
        </div>
        <!--
        <div class="col-sm-4" id="spin">
            <img src="{{static_asset('assets/img/spin-bg6.svg')}}"/>
		</div>
		-->
        <div class="col-sm-8">
			<img src="{{static_asset('assets/img/Trang-con-mini-game_33.png')}}" style="width: 100%;" />
        </div>
	</div>
	<div class="row" id="bg2">
        <div class="col-sm-4">
			<img src="{{static_asset('assets/img/Trang-con-mini-game_11.png')}}"/>
        </div>
		<div class="col-sm-4">
			<img src="{{static_asset('assets/img/Trang-con-mini-game_13.png')}}"/>
        </div>
		<div class="col-sm-4">
			<img src="{{static_asset('assets/img/Trang-con-mini-game_15.png')}}"/>
        </div>
    </div>
    <div id="reward" style="overflow-x:auto;">
        <table class="table" >
  <thead>
    
    <tr><h4>Danh sách trúng giải</h4>
      <th scope="col">STT</th>
      <th scope="col">Giải thưởng</th>
      <th scope="col">ID</th>
      <th scope="col">Họ và tên</th>
      <th scope="col">Email</th>
      <th scope="col">Số điện thoại</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">01</th>
      <td>Giải nhất</td>
      <td>123456</td>
      <td>Nguyễn Văn A</td>
      <td>*********01*gmail.com</td>
      <td>0949.845.***</td>
    </tr>
    <tr>
      <th scope="row">01</th>
      <td>Giải nhì</td>
      <td>123456</td>
      <td>Nguyễn Văn B</td>
      <td>*********01*gmail.com</td>
      <td>0949.845.***</td>
    </tr>
    <tr>
      <th scope="row">01</th>
      <td>Giải ba</td>
      <td>123456</td>
      <td>Nguyễn Văn C</td>
      <td>*********01*gmail.com</td>
      <td>0949.845.***</td>
    </tr>
  </tbody>
</table>
    </div>
	
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

    
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script >(function() {
  var $,
    ele,
    container,
    canvas,
    num,
    prizes,
    btn,
    deg = 0,
    fnGetPrize,
    fnGotBack,
    optsPrize;

  var cssPrefix,
    eventPrefix,
    vendors = {
      "": "",
      Webkit: "webkit",
      Moz: "",
      O: "o",
      ms: "ms"
    },
    testEle = document.createElement("p"),
    cssSupport = {};

  Object.keys(vendors).some(function(vendor) {
    if (
      testEle.style[vendor + (vendor ? "T" : "t") + "ransitionProperty"] !==
      undefined
    ) {
      cssPrefix = vendor ? "-" + vendor.toLowerCase() + "-" : "";
      eventPrefix = vendors[vendor];
      return true;
    }
  });

  /**
   * @param  {[type]} name [description]
   * @return {[type]}      [description]
   */
  function normalizeEvent(name) {
    return eventPrefix ? eventPrefix + name : name.toLowerCase();
  }

  /**
   * @param  {[type]} name [description]
   * @return {[type]}      [description]
   */
  function normalizeCss(name) {
    name = name.toLowerCase();
    return cssPrefix ? cssPrefix + name : name;
  }

  cssSupport = {
    cssPrefix: cssPrefix,
    transform: normalizeCss("Transform"),
    transitionEnd: normalizeEvent("TransitionEnd")
  };

  var transform = cssSupport.transform;
  var transitionEnd = cssSupport.transitionEnd;

  // alert(transform);
  // alert(transitionEnd);

  function init(opts) {
    fnGetPrize = opts.getPrize;
    fnGotBack = opts.gotBack;
    opts.config(function(data) {
      prizes = opts.prizes = data;
      num = prizes.length;
      draw(opts);
    });
    events();
  }

  /**
   * @param  {String} id
   * @return {Object} HTML element
   */
  $ = function(id) {
    return document.getElementById(id);
  };

  function draw(opts) {
    opts = opts || {};
    if (!opts.id || num >>> 0 === 0) return;

    var id = opts.id,
      rotateDeg = 360 / num / 2 + 90,
      ctx,
      prizeItems = document.createElement("ul"),
      turnNum = 1 / num,
      html = [];

    ele = $(id);
    canvas = ele.querySelector(".hc-luckywheel-canvas");
    container = ele.querySelector(".hc-luckywheel-container");
    btn = ele.querySelector(".hc-luckywheel-btn");

    if (!canvas.getContext) {
      showMsg("Browser is not support");
      return;
    }

    ctx = canvas.getContext("2d");

    for (var i = 0; i < num; i++) {
      ctx.save();
      ctx.beginPath();
      ctx.translate(250, 250); // Center Point
      ctx.moveTo(0, 0);
      ctx.rotate((((360 / num) * i - rotateDeg) * Math.PI) / 180);
      ctx.arc(0, 0, 250, 0, (2 * Math.PI) / num, false); // Radius
      if (i % 2 == 0) {
        ctx.fillStyle = "#ffb820";
      } else {
        ctx.fillStyle = "#ffcb3f";
      }
      ctx.fill();
      ctx.lineWidth = 1;
      ctx.strokeStyle = "#e4370e";
      ctx.stroke();
      ctx.restore();
      var prizeList = opts.prizes;
      html.push('<li class="hc-luckywheel-item"> <span style="');
      html.push(transform + ": rotate(" + i * turnNum + 'turn)">');
      if (opts.mode == "both") {
        html.push("<p id='curve'>" + prizeList[i].text + "</p>");
        html.push('<img src="' + prizeList[i].img + '" />');
      } else if (prizeList[i].img) {
        html.push('<img src="' + prizeList[i].img + '" />');
      } else {
        html.push('<p id="curve">' + prizeList[i].text + "</p>");
      }
      html.push("</span> </li>");
      if (i + 1 === num) {
        prizeItems.className = "hc-luckywheel-list";
        container.appendChild(prizeItems);
        prizeItems.innerHTML = html.join("");
      }
    }
  }

  /**
   * @param  {String} msg [description]
   */
  function showMsg(msg) {
    alert(msg);
  }

  /**
   * @param  {[type]} deg [description]
   * @return {[type]}     [description]
   */
  function runRotate(deg) {
    // runInit();
    // setTimeout(function() {
    container.style[transform] = "rotate(" + deg + "deg)";
    // }, 10);
  }

  /**
   * @return {[type]} [description]
   */
  function events() {
    bind(btn, "click", function() {

      addClass(btn, "disabled");

      fnGetPrize(function(data) {
        if (data[0] == null && !data[1] == null) {
          return;
        }
        optsPrize = {
          prizeId: data[0],
          chances: data[1]
        };
        deg = deg || 0;
        deg = deg + (360 - (deg % 360)) + (360 * 10 - data[0] * (360 / num));
        runRotate(deg);
      });
      bind(container, transitionEnd, eGot);
    });
  }

  function eGot() {
    if (optsPrize.chances == null) {
      return fnGotBack(null);
    } else {
      removeClass(btn, "disabled");
      return fnGotBack(prizes[optsPrize.prizeId].text);
    }
  }

  /**
   * Bind events to elements
   * @param {Object}    ele    HTML Object
   * @param {Event}     event  Event to detach
   * @param {Function}  fn     Callback function
   */
  function bind(ele, event, fn) {
    if (typeof addEventListener === "function") {
      ele.addEventListener(event, fn, false);
    } else if (ele.attachEvent) {
      ele.attachEvent("on" + event, fn);
    }
  }

  /**
   * hasClass
   * @param {Object} ele   HTML Object
   * @param {String} cls   className
   * @return {Boolean}
   */
  function hasClass(ele, cls) {
    if (!ele || !cls) return false;
    if (ele.classList) {
      return ele.classList.contains(cls);
    } else {
      return ele.className.match(new RegExp("(\\s|^)" + cls + "(\\s|$)"));
    }
  }

  // addClass
  function addClass(ele, cls) {
    if (ele.classList) {
      ele.classList.add(cls);
    } else {
      if (!hasClass(ele, cls)) ele.className += "" + cls;
    }
  }

  // removeClass
  function removeClass(ele, cls) {
    if (ele.classList) {
      ele.classList.remove(cls);
    } else {
      ele.className = ele.className.replace(
        new RegExp(
          "(^|\\b)" + className.split(" ").join("|") + "(\\b|$)",
          "gi"
        ),
        " "
      );
    }
  }

  var hcLuckywheel = {
    init: function(opts) {
      return init(opts);
    }
  };

  window.hcLuckywheel === undefined && (window.hcLuckywheel = hcLuckywheel);

  if (typeof define == "function" && define.amd) {
    define("HellCat-Luckywheel", [], function() {
      return hcLuckywheel;
    });
  }
})();
</script>
    <script>
      var isPercentage = true;
      var prizes = [
              {
                text: "Tivi SamSung LED 43 Inch",
                img: "{{static_asset('assets/img/tv.png')}}",
                number: 1, //
                percentpage: 0.0011// 1%
              },
              {
                text: "Xe đạp địa hình",
                img: "{{static_asset('assets/img/xe_dap.png')}}",
                number: 1,
                percentpage: 0 // 5%
              },
              {
                text: "Tai nghe Sony",
                img: "{{static_asset('assets/img/tai_nghe.png')}}",
                number : 1,
                percentpage: 0 // 10%
              },
              {
                text: "Voucher 500k",
                img: "{{static_asset('assets/img/voucher.png')}}",
                number: 1,
                percentpage: 0 // 24%
              },
              {
                text: "Chúc bạn may mắn lần sau",
                img: "{{static_asset('assets/img/may_man.png')}}",
                percentpage: 0 // 60%
              },
            ];
      document.addEventListener(
        "DOMContentLoaded",
        function() {
          hcLuckywheel.init({
            id: "luckywheel",
            config: function(callback) {
              callback &&
                callback(prizes);
            },
            mode : "both",
            getPrize: function(callback) {
              var rand = randomIndex(prizes);
              var chances = rand;
              callback && callback([rand, chances]);
            },
            gotBack: function(data) {
              if(data == null){
                Swal.fire(
                  'Chương trình kết thúc',
                  'Đã hết phần thưởng',
                  'error'
                )
              } else if (data == 'Chúc bạn may mắn lần sau'){
                Swal.fire(
                  'Bạn không trúng thưởng',
                  data,
                  'error'
                )
              } else{
                Swal.fire(
                  'Đã trúng giải',
                  data,
                  'success'
                )
              }
            }
          });
        },
        false
      );
      function randomIndex(prizes){
        if(isPercentage){
          var counter = 1;
          for (let i = 0; i < prizes.length; i++) {
            if(prizes[i].number == 0){
              counter++
            }
          }
          if(counter == prizes.length){
            return null
          }
          let rand = Math.random();
          let prizeIndex = null;
          console.log(rand);
          switch (true) {
            case rand < prizes[4].percentpage:
              prizeIndex = 4 ;
              break;
            case rand < prizes[4].percentpage + prizes[3].percentpage:
              prizeIndex = 3;
              break;
            case rand < prizes[4].percentpage + prizes[3].percentpage + prizes[2].percentpage:
              prizeIndex = 2;
              break;
            case rand < prizes[4].percentpage + prizes[3].percentpage + prizes[2].percentpage + prizes[1].percentpage:
              prizeIndex = 1;
              break;  
            case rand < prizes[4].percentpage + prizes[3].percentpage + prizes[2].percentpage + prizes[1].percentpage  + prizes[0].percentpage:
              prizeIndex = 0;
              break;  
          }
          if(prizes[prizeIndex].number != 0){
            prizes[prizeIndex].number = prizes[prizeIndex].number - 1
            return prizeIndex
          }else{
            return randomIndex(prizes)
          }
        }else{
          var counter = 0;
          for (let i = 0; i < prizes.length; i++) {
            if(prizes[i].number == 0){
              counter++
            }
          }
          if(counter == prizes.length){
            return null
          }
          var rand = (Math.random() * (prizes.length)) >>> 0;
          if(prizes[rand].number != 0){
            prizes[rand].number = prizes[rand].number - 1
            return rand
          }else{
            return randomIndex(prizes)
          }
        }
      }
    </script>
    
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