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
    <script type="text/javascript" src="https://blockchain.info/Resources/wallet/pay-now-button.js"></script>

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
        .authorImg{
            width: 400px;
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
    <img class="authorImg" src="/img/author.jpg">
    <p>
        You can reach him by <br>
        <ul>
            <li><span><a href="mailto:knotjs@gmail.com"> knotjs@gmail.com</a></span> </li>
            <li><span><a href="http://au.linkedin.com/in/alexzhaosheng" >Linkedin</span></a></li>
            <li><span><a href="https://www.facebook.com/zhao.alex">Facebook</a> </span></li>
            <li><span><a href="http://weibo.com/2018493034/profile">Weibo</a></span></li>
            <li><span><a href="https://twitter.com/Woodheadz">Twitter</a></span></li>
        </ul>
    </p>

    <h3>Support knot.js</h3>
    <p>First, I'd be very appreciate to any one who uses knot.js and gives me the feedback.</span></p>
        <p><span>If you have some idea about knot.js, just fork it.</span></p>
        <p><span>Join me to build the site/community of knot.js together is warmly welcome. The knot.js site is on GitHub too, feel free to fork it and push your changes back. <a href="https://github.com/alexzhaosheng/knot_website">Knot.js site @GitHub</a> </span></p>


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