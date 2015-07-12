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
                    You would find this is very useful in some case. Don't forget to stop monitoring the object by using <span class="inlineCode">Knot.stopMonitoringObject(object, path, callback)</span>
                </span></li>
            <li><span>Except monitoring the change of the object directly, you can also let knot.js monitor the change and tell you the changed properties by using
                    <span class="inlineCode">Knot.getPropertiesChangeRecords(object)</span>. Use <span class="inlineCode">Knot.clearPropertiesChangeRecords(object)</span> to clear the old changed records.</span></li>

        </ul>
        <h3 id="traps">Traps</h3>
        <ul>
            <li><span>Don't forget to remove the reference to the <i>Debugger</i> before release, it may bring serious performance problem!</span></li>
            <li><span>Due to some technique limits, data-awareness system <b>DOES NOT</b> fully work with array. Therefore please note:</span>
                <ul>
                    <li><span>If you change the data in array by using index, you need to tell knot.js by calling <span class="inlineCode">notifyChanged</span>. Here's the example:
                        <div class="codeSegment">
                            <pre><code class="javascript">var arr = ["a", "b", "c"];
arr[1] = "x";
//tell knot.js that the old item at 1 has been removed and a new item is inserted at 1.
//you can also simply call arr.notifyChange(); but if you are working with a big array,
//it may bring up performance problem.
arr.notifyChanged([1],[1]);
                        </div>
                    </li>
                    <li><span>Similar problem happens when you set the length of the array, you have to tell knot.js the array has been modified.</span></li>
                    <li><span>If you are modifying a property on the items of the array, knot.js will know it.</span></li>
                </ul>
            </li>
            <li><span>If your object has some properties that defined with "Object.defineProperty", I'm sorry they won't work with knot.js directly.
                    You can set "configurable" to false when define the properties and use <span class="inlineCode">Knot.notifyObjectChanged(object, path, oldValue, newValue)</span>
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