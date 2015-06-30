<nav class="nav-bar">
    <div class="knotStringLeft"></div>
    <div class="content-column">
        <div class="left">
            <h1>knot.js</h1>
            <div class="knotOnThread"></div>
        </div>

        <div class="right">
            <ul class="nav-menu">
                <li class="home">Home</li>
                <li class="tutorial">Tutorial</li>
                <li class="forum"><a href="https://groups.google.com/forum/#!forum/knot_js">Forum</a></li>
                <li class="GitHub"><a href="https://github.com/woodheadz/knot">GitHub</a></li>
            </ul>
        </div>
    </div>
</nav>
<script type="text/javascript">
    function updateSize(){
        $(".knotStringLeft").width($(".knotOnThread").offset().left);
        $(".content").css("min-height",  $(window).innerHeight() - $(".nav-bar").height() - $(".footer").height() - 4);
    }
    $(window).resize(updateSize);
    $(document).ready(function(){
        updateSize();
        var currentPage = "{$page}";
        $(".nav-menu>." + currentPage).addClass("selected");
    });
</script>
