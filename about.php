<?php

require_once "comm.php";

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
        p, img, ul{
            padding-left: 30px;
        }
        .content li{
            list-style: none;
            padding-left: 30px;
            color: black;
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

    <h3>Author</h3>
    <p>
        Sheng Zhao (Alex) is living in Australia with his wife and two little troubles.
    </p>
    <img src="/img/author.jpg">
    <p>
        You can reach him by <br>
        <ul>
            <li><span><a href="mailto:knotjs@gmail.com"> knotjs@gmail.com</a></span> </li>
            <li><span><a href="http://au.linkedin.com/in/alexzhaosheng" >Linkedin</span></a></li>
        </ul>
    </p>

    <h3>Site</h3>
    <p><a href="https://jquery.com/">jQuery </a>is used everywhere</p>
    <p><a href="https://angularjs.org/">AngularJS</a> for performance comparison</p>
    <p>Syntax high light ability is from <a href="https://highlightjs.org/">highlight.js</a></p>
    <p>The hand-drawn style flowchart is created with <a href="http://yuml.me/">yUML</a></p>


</section>

<?php
$smarty = \Common::getSmarty();
$smarty->display("footer.tpl");
?>
</body>
</html>