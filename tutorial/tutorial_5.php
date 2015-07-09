<?php

require_once "../comm.php";

?>
<!DOCTYPE html>
<html>
<head>
    <title>Knot.js</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Javascript bind framework knot.js help you." />
    <meta name="keywords" content="javascript, mvvm, framework, data binding, angular.js, knotout.js, ember.js" />

    <meta property="og:locale" content="en_US" />
    <meta property="og:site_name" content="knot.js" />
    <meta property="og:title" content="knot.js" />
    <meta property="og:type" content="website" />

    <link rel="shortcut icon" href="../img/knot.ico">

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <link rel="stylesheet" href="../css/github.css">
    <script src="../js/highlight.pack.js"></script>


    <link rel="stylesheet" href="../css/site.css">
    <script src="../js/knot.min.js"></script>

    <link rel="stylesheet" href="../css/tabpage.css">
    <script type="text/cbs" src="../cbs/tabpage.pkg.cbs"></script>
    <script type="text/cbs" src="../cbs/sourceTab.pkg.cbs"></script>
    <script src="../js/tabpage.js"></script>
    <script src="../js/sourceTab.js"></script>

    <script src="../debugger/knot.debug.js"></script>

    <link rel="stylesheet" href="css/bookstore.css" id="bookStoreCSS">
    <script src="cbs/bookstore.cbs" type="text/cbs" id="bookStoreCBS"></script>
    <script src="js/bookstore.js" id="bookStoreJS"></script>

    <!-- this line just intends to provide a url reference for source tabpage -->
    <script src="rsc/bookstore.json" type="text/json" id="bookStoreDATA"></script>


    <script>
        window.sourceModel = {};
        hljs.initHighlightingOnLoad();
    </script>
</head>
<body>
<?php
$smarty = \Common::getSmarty();
$smarty->assign("page", "tutorial");
$smarty->display("header.tpl");
?>

<section class="content-column content">

    <?php
    $smarty = \Common::getSmarty();
    $smarty->assign("page", 5);
    $smarty->display("tutorialMenu.tpl");
    ?>

    <div class="tutorialContent">
        <h2>Single Page App</h2>
        <p>Single Page App is very helpful for improving the user experience. Here's a link tells you more about <a target="_blank" href="https://en.wikipedia.org/wiki/Single-page_application">Single Page App</a></p>
        <p>Knot.js comes with a <i>Knot Variant</i> named "$hash", which enables you directly bind to hash status of your browser window, and make Single Page App easily implementable.</p>
        <p>For more information about <i>Knot Variant</i>, please follow this link:
            <a href="https://github.com/alexzhaosheng/knot.js/wiki/Knot-Variant">Knot Variant</a></p>
        <p>Let's learn from the example:</p>


        <section class="knot_example" id="bookStoreHTML">
            <h2>Knot.js example - Bookstore</h2>

            <div class="navMenu">
                <ul>
                    <li knot-template></li>
                </ul>
            </div>

            <div id="contentContainer"></div>

            <div id="booksList" knot-template-id="bookListTemplate">
                <ul>
                    <li knot-template>
                        <img>
                        <div></div>
                    </li>
                </ul>
            </div>

            <div id="bookDetails" knot-template-id="bookDetailsTemplate">
                <div>
                    <p>
                        <span class="title"></span>  <br>
                    </p>
                    <img>
                    <p class="intro"></p>
                    <button>Return</button>
                </div>
            </div>
        </section>

        <div id="bookStoreCodePages" knot-debugger-ignore  knot-component="SourceTabPage"></div>

        <ul>
            <li><span>The basic idea of the example is to bind the current selected category and book to the hash status of the window. When use select a category/book, it simple change the hash status of window,
                then knot.js will change the selected category and book accordingly. Here's the flow chart (click to view it in big size):</span>
                <p><a target="flowChart" href="/img/tutorial/t5_1.png" title="Click to view the original picture."> <img src="/img/tutorial/t5_1.png" style="width: 700px"></a></p>
            </li>
            <li><span>The data of the books is loaded from this <a target="_blank" href="rsc/bookstore.json">stand along JSON file</a> to simulate loading data from server.</span></li>
            <li><span>The hash status binding works with browser bookmarks and history buttons (bark, forward).</span></li>
            <li><span>You are actually able to load the resources(HTMLs,CBSs) from external files by the <i>Private CBS Package</i>, we'll talk about it soon. Knot.js doesn't come with embedded on-demand loading and
                automatic dependency solving at current stage. But I'll add them in the near future (this is a promise).</span></li>
            <li><span>Yes I'm the fan of <a target="_blank" href="http://www.amazon.com/The-Three-Body-Problem-Cixin-Liu/dp/0765377063">"The Three Body Problems"</a> trilogy and I'd like to recommend it
                    (especially the 2nd and 3rd book) to anyone who loves SF. The 2nd & 3rd book will be available in English soon.</span></li>
        </ul>

        <div class="footNote">
            <ul>
                <li><span>All of the text and images of the books are from <a target="_blank" href="https://www.amazon.com">Amazon.com</a></span></li>
            </ul>
        </div>
    </div>

</section>

<script type="text/cbs">
    #bookStoreCodePages{
        sourceInfo:/sourceModel.codePages;
        height:'500px';
    }
</script>
<script>
    window.sourceModel = {};
    window.SourceCodeHelper.collectSourceCodes(
        [
            {selector:"#bookStoreCBS",title:"CBS", type:"css"},
            {selector:"#bookStoreJS",title:"Javascript", type:"javascript"},
            {selector:"#bookStoreHTML",title:"HTML", type:"html"},
            {selector:"#bookStoreDATA",title:"Data", type:"json"},
            {selector:"#bookStoreCSS",title:"CSS", type:"ss"}
        ],
        function(res){
            window.sourceModel.codePages = res;
        });
</script>

<?php
$smarty = \Common::getSmarty();
$smarty->display("footer.tpl");
?>
</body>
</html>