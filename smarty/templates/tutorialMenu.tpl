<div class="tutorialMenuExpander">
    <span> Tutorials </span>
    <div class="arrow"></div>
</div>
<div class="tutorialMenu">
    <h3>Tutorials</h3>
    <ul>
        <li class="tutorial_1"><p><a href="/tutorial/1">Start</a></p>
            <ul>
                <li><p><a href="/tutorial/1#cbs">CBS Basic</a></p></li>
                <li><p><a href="/tutorial/1#more">More About CBS</a></p></li>
                <li><p><a href="/tutorial/1#debugger">Debugger</a></p></li>
            </ul>
        </li>
        <li class="tutorial_2"><p><a href="/tutorial/2">Pipe</a></p>
            <ul>
                <li><p><a href="/tutorial/2#converter">Converter</a></p></li>
                <li><p><a href="/tutorial/2#validator">Validator And Binding to Error Status</a></p></li>
                <li><p><a href="/tutorial/2#multi">Multi-Binding</a></p></li>
            </ul>
        </li>
        <li class="tutorial_3"><p><a href="/tutorial/3">Event</a></p></li>
        <li class="tutorial_4"><p><a href="/tutorial/4">Template</a></p>
            <ul>
                <li><p><a href="/tutorial/4#static">Static Template</a></p></li>
                <li><p><a href="/tutorial/4#templateSelector">Template Selector</a></p></li>
                <li><p><a href="/tutorial/4#dynamic">Dynamic Template</a></p></li>
            </ul>
        </li>
        <li class="tutorial_5"><p><a href="/tutorial/5">Single Page App</a></p></li>
        <li class="tutorial_6"><p><a href="/tutorial/6">Component</a></p></li>
        <li class="tutorial_7"><p><a href="/tutorial/7">Animation</a></p></li>
        <li class="tutorial_8"><p><a href="/tutorial/8">Tricks And Traps</a></p>
            <ul>
                <li><p><a href="/tutorial/8#tricks">Tricks</a></p></li>
                <li><p><a href="/tutorial/8#traps">Traps</a></p></li>
            </ul>
        </li>
    </ul>
</div>

<script>
    var curPage = ".tutorial_{$page}";
    $(curPage + ">p").addClass("selected");
    function updateMenu(){
        if($("body").width() < 720){
            return;
        }
        var startTop = 185;
        var curScrollTop = $(window).scrollTop();
        $(".tutorialMenu").css("top", Math.max(0, startTop - curScrollTop)+5);

        var curList = $(curPage + ">ul>li");
        var curItem;
        for(var i=0; i< curList.length; i++){
            var id = curList.eq(i).find("a").attr("href").split("#")[1];
            if($("#"+id).offset().top - curScrollTop < $(window).innerHeight()/5*2){
                curItem = curList.eq(i);
            }
            else{
                break;
            }
        }
        curList.find("p").removeClass("inReading");
        if(curItem)
            curItem.find("p").addClass("inReading");
    }
    $(document).ready(function(){
        $(window).scroll(function(){
            updateMenu();
        });
        updateMenu();

        $(".tutorialMenuExpander").click(function(){
            $(".tutorialMenu").css("top", $(".tutorialMenuExpander").offset().top + 32) .toggle();
        });
        $(".tutorialMenu a").click(function(evt){
            if($("body").width() < 720){
               $(".tutorialMenu").hide();
            }
        });
    });

</script>