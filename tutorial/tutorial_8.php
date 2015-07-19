<?php

require_once "../comm.php";

?>
<!DOCTYPE html>
<html>
<head>
    <title>Tutorial 8: Tricks And Traps - Knot.js</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Knot.js is an open source Javascript framework that targets to provide the best biding experience to frontend developers. It comes with CBS support to give you the best maintainability." />
    <meta name="keywords" content="javascript,mvvm,framework,data binding,knot.js,CBS,angular.js,knockout.js,ember.js,tutorial,trick,trap" />

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

    <script src="../js/debugger/knot.debug.js"></script>

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
    $smarty->assign("page", 8);
    $smarty->display("tutorialMenu.tpl");
    ?>

    <div class="tutorialContent">
        <h2>Tricks And Traps</h2>
        <h3 id="tricks">Tricks</h3>
        <ul>
            <li><span>Use <span class="inlineCode">Knot.getDataContext(htmlElement)</span> to get the current Data Context of the HTML element.</span></li>
            <li><span>You can also benefit from the data-awareness system directly. Just use <span class="inlineCode">Knot.monitorObject(object, path, callback)</span> to monitor the change of any object.
                    You would find this is very useful sometimes. Don't forget to stop monitoring the object by using <span class="inlineCode">Knot.stopMonitoringObject(object, path, callback)</span>
                </span></li>
            <li><span>Except monitoring the change of the object directly, you can also let knot.js monitor the change and tell you the changed properties by using
                    <span class="inlineCode">Knot.getPropertiesChangeRecords(object)</span>. Use <span class="inlineCode">Knot.clearPropertiesChangeRecords(object)</span> to clear the old changed records.</span></li>
            <li><span>There's the list for the helper functions come with knot.js: <a target="gitHubWiki" href="https://github.com/alexzhaosheng/knot.js/wiki/Helper-Functions">Helper Functions @GitHubWiki</a></span></li>
        </ul>
        <h3 id="traps">Traps</h3>
        <ul>
            <li><span>One of the most significant difference between CSS and CBS is CSS is always applied dynamically while CBS is always applied statically.<br>
                When you modify the DOM structure, CSS changes the styles but CBS will not change the binding accordingly. The reason of this design is to keep things as simple and clear as possible.<br>
                If you want to add CBS dynamically, please use <span class="inlineCode">Knot.Advanced.loadPrivatePackage</span> to load <i>Private CBS Package</i></span></li>
            <li><span>Don't forget to remove the reference to the <i>Debugger</i> before release, it may bring serious performance problem!</span></li>
            <li><span>Due to some technique limits, data-awareness system <b>DOES NOT</b> fully work with array. Therefore please note:</span>
                <ul>
                    <li><span>If you change the data in array by using index, please use <span class="inlineCode">setValueAt</span> method on array. Here's the example:
                        <div class="codeSegment">
                            <pre><code class="javascript">var arr = ["a", "b", "c"];
// equivalent to arr[1] = "replace b". but this works with knot.js
arr.setValueAt(1, "replace b");</div>
                    </li>
                    <li><span>Please don't set the length of the array. Always uses the array functions (pop,push,shift,unshift,splice), you'll get the best performance in knot.js with them.
                            If you want to empty an array by setting the length to 0, please use <span class="inlineCode">clear()</span> on the array object instead.</span></li>
                    <li><span>If you are modifying a property on the items of the array, knot.js will know it.</span></li>
                </ul>
            </li>
            <li><span>If your object has some properties that defined with "Object.defineProperty", I'm sorry they won't work with knot.js automatically.
                    You need to set "configurable" to false when define the properties to prevent your definition won't be overwritten by knot.js, and call <span class="inlineCode">Knot.notifyObjectChanged(object, path, oldValue, newValue)</span>
                    to tell knot.js when it's changed.</li>
        </ul>

    </div>
</section>

<?php
$smarty = \Common::getSmarty();
$smarty->display("footer.tpl");
?>
</body>
</html>