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

    <style>
        h4{
            margin-left: 10px;
        }
        img{
            width: 600px;
            margin-left: 50px;
        }
    </style>
</head>
<body>
<?php
$smarty = \Common::getSmarty();
$smarty->assign("page", "");
$smarty->display("header.tpl");
?>

<section class="content-column content">
    <h2>Performance</h2>
    <p>
        Here's the performance test result between jQuery, knot.js and angularJS.
    </p>
    <p>This test create 1000 todo items, toggle their complete status and set a random number for it for 10 times, then remove those items.
        It sleeps 500 milliseconds between each of the actions to try to avoid the impact of GC (hopefully).</p>

    <p><b>Note this is just for your reference.</b> Performance is effected by many aspects, you may get totally different result from the different scenarios.
        These results are just what I get on my computer with this <a target="performanceTest" href="pfTest.html">performance test</a>.</p>

    <p>The score is the time cost for the test action in milliseconds. The lower the better.</p>
    <p>
        Knot.js test works in two modes:
        <ul>
            <li><span>Normal mode (knot.js): Add/remove the items one by one.</span></li>
            <li><span>Batch mode (knot.js(Batch mode)): Add/remove all of the items in one time.</span></li>
        </ul>
    </p>
    <p>
        <h4>Chrome</h4>
        <img src="img/chrome.png">
    </p>
    <p>
        <h4>IE</h4>
        <img src="img/ie.png">
    </p>
    <p>
        <h4>Firefox</h4>
        <img src="img/firefox.png">
    </p>
    <p>
        <h4>Safari</h4>
        <img src="img/safari.png">
    </p>
    <p>
        <h4>Opera</h4>
        <img src="img/opera.png">
    </p>
</section>

<?php
$smarty = \Common::getSmarty();
$smarty->display("footer.tpl");
?>
</body>
</html>