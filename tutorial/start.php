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

    <link rel="stylesheet" href="../css/site.css">
    <link rel="shortcut icon" href="../img/knot.ico">


    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <link rel="stylesheet" href="../css/github.css">
    <script src="../js/highlight.pack.js"></script>
    <link rel="stylesheet" href="../css/tabpage.css">
    <script type="text/cbs" src="../cbs/tabpage.cbs"></script>
    <script type="text/cbs" src="../cbs/sourceTab.cbs"></script>

    <script src="../js/knot.min.js"></script>

    <script src="../debugger/knot.debug.js"></script>

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

$smarty->display("tutorialMenu.tpl");
?>

    <div class="tutorialContent">

<script type="text/cbs" class="exampleCBS">
    /*
        This option bind the value of input with #helloString.text
        The output of #nameInput.value will be combined with "Hello" then set to #helloString.text
        "[immediately:1]" tells knot.js to update for each of the key stroke
     */
    .knot_example input{
        value[immediately:1]: #helloString.text;
    }
</script>
<div class="knot_example">

    <!-- Clean HTML, all binding logic is in CBS -->

    <h3>Greeting from knot.js</h3>
    <p>
        <label>Input your name here: </label>
        <input type="text">
    </p>
    <p>
        Hello <b id="helloString"></b>
    </p>
</div>

        <script src="../js/tabpage.js"></script>
        <script src="../js/sourceTab.js"></script>
    </div>
</section>

<?php
$smarty = \Common::getSmarty();
$smarty->display("footer.tpl");
?>
</body>
</html>