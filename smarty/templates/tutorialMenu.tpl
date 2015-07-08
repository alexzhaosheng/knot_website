<div class="tutorialMenu">
    <h3>Tutorials</h3>
    <ul>
        <li class="tutorial_1"><p><a href="/tutorial/tutorial_1.php">Start</a></p>
            <ul>
                <li><p><a href="/tutorial/tutorial_1.php#cbs">CBS Basic</a></p></li>
                <li><p><a href="/tutorial/tutorial_1.php#more">More About CBS</a></p></li>
                <li><p><a href="/tutorial/tutorial_1.php#debugger">Debugger</a></p></li>
            </ul>
        </li>
        <li class="tutorial_2"><p><a href="/tutorial/tutorial_2.php">Pipe</a></p>
            <ul>
                <li><p><a href="/tutorial/tutorial_2.php#converter">Converter</a></p></li>
                <li><p><a href="/tutorial/tutorial_2.php#validator">Validator And Binding to Error Status</a></p></li>
                <li><p><a href="/tutorial/tutorial_2.php#multi">Multi-Binding</a></p></li>
            </ul>
        </li>
        <li class="tutorial_3"><p><a href="/tutorial/tutorial_3.php">Event</a></p></li>
        <li class="tutorial_4"><p><a href="/tutorial/tutorial_4.php">Template</a></p>
            <ul>
                <li><p><a href="/tutorial/tutorial_4.php#static">Static Template</a></p></li>
                <li><p><a href="/tutorial/tutorial_4.php#templateSelector">Template Selector</a></p></li>
                <li><p><a href="/tutorial/tutorial_4.php#dynamic">Dynamic Template</a></p></li>
            </ul>
        </li>
        <li><p>Bind to everything</p></li>
        <li><p>Single Page App</p></li>
    </ul>
</div>

<script>
    var curPage = ".tutorial_{$page}";
    $(curPage + ">p").addClass("selected");
    $(document).ready(function(){
        var startTop = $(".tutorialMenu").offset().top;
        $(window).scroll(function(){
            var curScrollTop = $(window).scrollTop();
            $(".tutorialMenu").css("marginTop", Math.max(0, curScrollTop - startTop + 5));

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
            curItem.find("p").addClass("inReading");
        });
    });
</script>