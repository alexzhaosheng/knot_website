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
$smarty->assign("page", 3);
$smarty->display("tutorialMenu.tpl");
?>

<div class="tutorialContent">
    <h2>Event</h2>

    <p>Knot.js comes with built-in event support.</p>
    <p>Event Access Point is often start with "<b>@</b>", and is bound to a function. You can use all of the DOM events in knot.js</p>
    <p>Here's an example:</p>
    <script type="text/cbs" id="exampleCBS">
            #greetingExampleV5{
                dataContext: /greetingModelV5Model;

                -> input{
                    value[immediately:1]: name;
                };

                -> .clearButton{
                    @click: @{this.name= "";};
                };

                -> .sayHelloButton{
                    /*
                        bind the function "sayHello" with click event. "sayHello" is in global scope,
                        therefore use "/sayHello" to access it
                    */
                    @click: @/sayHello;
                }
            }
        </script>
    <script type="text/javascript" id="exampleJS">
        window.greetingModelV5Model = {
            name:""
        };

        //In the event handler, "this" point is set to the current data context
        //and knot.js also passes in the original event parameter and the source HTML
        // element for your convenience.
        function sayHello(event, node){
            alert("Hello "  + this.name + "!"+
                  "\n\nEvent argument:"+ event.toString() +
                  "\nSource HTML Element:" + node.tagName);
        }
    </script>
    <div class="knot_example" id="greetingExampleV5">
        <h3>Greeting from knot.js (V5)</h3>
        <p>
            <label>Input your name here: </label>
            <input type="text"> <button class="clearButton">Clear</button>
        </p>
        <p>
          <button class="sayHelloButton">Say hello</button>
        </p>
    </div>

    <div id="greetingExampleV5CodePages" knot-debugger-ignore  knot-component="SourceTabPage"></div>

    <p>
    Here's something you need to know about <i>Event</i>:
    </p>
    <ul>
        <li><span>In the event handler, "this" point is set to the current data context</span></li>
        <li><span>In the event handler, original event parameter and the source HTML element is passed in as arguments</span></li>
    </ul>
</div>
</section>

<script type="text/cbs">
    #greetingExampleV5CodePages{
        sourceInfo:/sourceModel.codePages
    }
</script>
<script>
    window.sourceModel = {};
    window.SourceCodeHelper.collectSourceCodes(
        [
            {selector:"#exampleCBS",title:"CBS", type:"cbs"},
            {selector:"#exampleJS",title:"Javascript", type:"javascript"},
            {selector:"#greetingExampleV5",title:"HTML", type:"html"}
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