<div class="nav-bar-background"></div>

<div class="knotDiv">
    <svg id="knotAndString" xmlns="http://www.w3.org/2000/svg" version="1.0"  preserveAspectRatio="xMidYMid meet" xmlns:svg="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <defs id="svgEditorDefs"><polygon id="svgEditorPolygonDefs" stroke="black" fill="khaki" style="vector-effect: non-scaling-stroke; stroke-width: 1px;"/></defs>
        <rect id="knotStringBackground" x="0" y="10" width="142" height="25" style="fill: white; stroke: none;"/>

        <svg id="knotVisual" x="100">
            <g  transform="scale(0.5,0.5)">
                <polygon id="e1_polygon" style="stroke-width: 1px; vector-effect: non-scaling-stroke; stroke: none;" points="20.0782 22.2034 32.4669 9.30204 53.3995 5.79904 86.9771 17.5042 113.292 23.485 138.326 23.485 142.256 23.9976 142.256 57.8315 115.172 58.3442 92.6161 65.6065 92.5307 65.6065 75.0156 69.3658 74.4176 69.5367 62.0289 73.8087 49.6402 76.4573 33.9194 73.6378 26.8279 66.6318 20.42 58.6859 2.73406 52.6197 7.21837e-8 49.8002 -0.0854392 37.0698 3.07581 31.0036 13.2431 25.1083" fill="white" transform=""/>
                <g transform="translate(0.000000,82.000000) scale(0.100000,-0.100000)" fill="#FB6149" stroke="#FB6149" >
                    <path d="M371,770c-67,-25,-117,-67,-158,-132c-17,-27,-19,-28,-115,-28l-98,0l0,-95l0,-95l310,0c240,0,318,3,343,14c28,11,38,11,70,-1c20,-9,37,-19,37,-25c0,-5,-17,-16,-37,-24c-33,-14,-40,-14,-70,0c-29,14,-81,16,-343,16l-310,0l0,-95l0,-95l98,0l97,0l30,-47c33,-52,107,-107,163,-123c71,-19,169,-12,234,17c54,24,63,25,92,14c85,-35,106,-40,172,-41c39,0,86,5,105,12c54,18,117,66,156,119l37,49l118,0l118,0l0,25l0,25l-126,0c-126,0,-126,0,-120,23c4,12,9,43,13,70l6,47l113,0c69,0,114,4,114,10c0,6,-45,10,-114,10l-113,0l-6,48c-3,26,-9,57,-12,70l-7,22l126,0l126,0l0,25l0,25l-118,0l-119,0l-45,58c-28,36,-64,68,-99,87c-49,27,-62,30,-149,30c-82,0,-103,-4,-152,-27l-56,-26l-54,26c-73,35,-182,40,-257,12ZM625,709c33,-16,89,-47,125,-69c36,-21,88,-44,115,-51c96,-22,132,-54,142,-127l6,-42l-36,0c-47,0,-163,25,-218,46c-24,10,-74,36,-110,60c-37,23,-77,48,-90,55c-16,9,-76,15,-173,19l-150,5l33,38c97,110,222,133,356,66ZM1010,373c0,-35,-36,-109,-58,-118c-9,-4,-42,-13,-72,-21c-68,-18,-128,-46,-200,-94c-73,-47,-100,-59,-164,-66c-88,-11,-160,16,-226,84l-55,57l155,5l155,5l71,47c96,63,173,96,264,113c118,21,130,20,130,-12Z"/>
                </g>
            </g>
        </svg>

        <rect class="leftStrings" x="0" y="10.4" height="20.5" style="fill:#FB6149;stroke:none" width="100"></rect>
        <rect class="leftStringsGap" x="0" y="19.9" height="1.5" style="fill:white;stroke:none" width="100"></rect>
        <rect class="rightStrings" x="500" y="10.4" height="2.6" style="fill:#FB6149;stroke:none" width="100"></rect>
        <rect class="rightStrings" x="500" y="28.0" height="2.6" style="fill:#FB6149;stroke:none" width="100"></rect>
        <rect class="rightStrings" x="500" y="19.9" height="1.5" style="fill:#FB6149;stroke:none" width="100"></rect>
    </svg>
</div>

<nav class="nav-bar">
    <div class="content-column">
        <div class="left">
            <h1>knot.js</h1>
        </div>

        <div class="right">
            <ul class="nav-menu">
                <li class="home"><a href="/">Home</a></li>
                <li class="tutorial"><a href="/tutorial/tutorial_1.php">Tutorial</a></li>
                <li class="forum"><a href="https://groups.google.com/forum/#!forum/knot_js">Forum</a></li>
                <li class="GitHub"><a href="https://github.com/alexzhaosheng/knot.js">GitHub</a></li>
            </ul>
        </div>
    </div>
</nav>
<script type="text/javascript">
    function updateSize(){
        $(".content").css("min-height",  $(window).innerHeight() - $(".nav-bar").height() - $(".footer").height() - 54);

        var w = $(window).innerWidth();
        $("#knotStringBackground")[0].setAttribute("width", w);
        var knotPos = Math.max(0, (w - 980)/2) + 50;
        $("#knotVisual")[0].setAttribute("x", knotPos);
        $(".leftStrings").each(function(i, s){
            s.setAttribute("width", knotPos+10);
        });
        $(".leftStringsGap")[0].setAttribute("width", knotPos+30);

        $(".rightStrings").each(function(i, s){
            s.setAttribute("width", w - knotPos - 50);
            s.setAttribute("x", knotPos+50);
        });

        $("#knotAndString").show();
    }
    $(window).resize(updateSize);
    $(document).ready(function(){
        updateSize();

        $(".nav-menu>." + "{$page}").addClass("selected");
    });
</script>
