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
    <link rel="stylesheet" href="css/site.css">
    <link rel="shortcut icon" href="img/knot.ico">


    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <link rel="stylesheet" href="css/github.css">
    <script src="js/highlight.pack.js"></script>

    <script src="js/knot.min.js"></script>

    <link rel="stylesheet" href="css/tabpage.css">
    <script type="text/cbs" src="cbs/tabpage.pkg.cbs"></script>
    <script type="text/cbs" src="cbs/sourceTab.pkg.cbs"></script>
    <script src="js/tabpage.js"></script>
    <script src="js/sourceTab.js"></script>



<!--    <script src="js/core/PrivateScope.js"></script>-->
<!--    <script src="js/core/Utility.js"></script>-->
<!--    <script src="js/core/Deferred.js"></script>-->
<!--    <script src="js/core/AttachedData.js"></script>-->
<!--    <script src="js/core/DataObserver.js"></script>-->
<!--    <script src="js/core/ArrayMonitor.js"></script>-->
<!--    <script src="js/core/GlobalSymbolHelper.js"></script>-->
<!--    <script src="js/core/OptionParser.js"></script>-->
<!--    <script src="js/core/KnotManager.js"></script>-->
<!--    <script src="js/core/HTMLAPProvider.js"></script>-->
<!--    <script src="js/core/HTMLKnotBuilder.js"></script>-->
<!--    <script src="js/core/AddonHTMLAPProvider.js"></script>-->
<!--    <script src="js/core/KnotInterface.js"></script>-->

    <script src="debugger/knot.debug.js"></script>

    <script>
        Knot.ready(function(){
            //force to hide the debugger button
            $("#knotjs-debugger-debuggerButton").hide();

            $("#debuggerMessage a").click(function(){
                $("#knotjs-debugger-debuggerButton").show();
                $("#debuggerMessage a").hide();
                $("#debuggerMessage span").show();
                return false;
            })
        });

        hljs.initHighlightingOnLoad();
    </script>
</head>
<body>
<?php
    $smarty = \Common::getSmarty();
    $smarty->assign("page", "home");
    $smarty->display("header.tpl");
?>

<section class="content-column content">
    <h1>What?</h1>
    <p><b>Knot.js</b> is an open source Javascript MVVM framework that targets to bring up the best data binding experience for the Web developers.</p>

    <h1>Why?</h1>
    <ul>
        <li>
            <p>
                <b>You don't want to mess up your HTML by the weird markups.</b>
                <p>
                    Knot.js comes with a brand new idea named <i>Cascading Binding Sheet</i> (CBS). The same as Cascading Style Sheet (CSS) to HTML styles, CBS extracts the binding logic from HTML code to
                    CBS script blocks or stand-along CBS files, and leaves you a perfect clean world.
                </p>
            </p>
        </li>

        <li>
            <p>
                <b>You don't want to write more codes just because the framework forces you to do.</b>
                <p>
                    Knot.js has a built-in a fully automatic data awareness system. Just grab your data and throw it to knot.js, it will take care of the rests. When you change the data in your
                    Javascript code, knot.js will update UI for you automatically.
                </p>
            </p>
        </li>

        <li>
            <p>
                <b>You don't want fight with the framework when something goes wrong.</b>
                <p>
                    Just like using DOM inspector to inspect CSS/DOM problems, you can use knot.js debugger to inspect the binding settings and real time statuses in almost the same manner.
                    It turns knot.js into a white box. No more experiences of fighting with framework by tracing error through tons of complex alien source codes.

                </p>
            </p>
        </li>

        <li>
            <p>
                <b>Many other reasons that you should use knot.js</b>
                <p>
                    <ul>
                        <li>
                            <p>Free. MIT license</p>
                        </li>
                        <li>
                            <p>Tiny. 39kb and no dependency.</p>
                        </li>
                        <li>
                            <p>Easy. Knot.js follows intuition in all aspects.</p>
                        </li>
                        <li>
                            <p>Feature-complete. Templates, data validation, multi-binding, single page application, embedded Javascript functions... Everything that you except for an UI binding framework is here.</p>
                        </li>
                        <li>
                            <p>Free (again). Interpose anytime you want, never loose control to the framework. Animations? special requirements? no problem!</p>
                        </li>
                        <li>
                            <p>Extensible. Easy to write your own reusable extension and bind to almost everything.</p>
                        </li>
                    </ul>
                </p>
            </p>
        </li>
        <li>
            <p>
                <b>Few other things you need to know before using knot.js</b>
                <p>
                    <ul>
                        <li>
                            <p>Source codes come with unit test and documents. And I'll stick with knot.js until it's safe to go on without me.</p>
                        </li>
                        <li>
                            <p>Compatible with IE9+ and the other mainstream browsers. I may add limited support for earlier versions of IE in future, please note this is not a promise.</p>
                        </li>
                    </ul>
                </p>
            </p>
        </li>
    </ul>


    <h1>A quick example</h1>
    To use knot.js in your webpage is very easy. You just need to add the line below to reference knot.js package, then everything would work.
    <div class="codeSegment">
        <pre><code class="html">
&lt;script src=&quot;js/knot.min.js&quot;&gt;&lt;/script&gt;
        </code></pre>
    </div>

    <p>
        Here is a simple example to give you some the first impression of knot.js. You can start to learn more about knot.js with the <a href="tutorial/tutorial_1.php"> tutorials</a>
    </p>
    <script type="text/cbs" class="exampleCBS">
        /*
            This option bind the value of input with #helloString.text
            The output of #nameInput.value will be combined with "Hello" then set to #helloString.text
            "[immediately:1]" tells knot.js to update for each of the key stroke
         */
        .knot_example input{
            value[immediately:1] > {return value? ("Hello " + value + " !"): ""}
                : #helloString.text;
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
            <b id="helloString"></b>
        </p>
    </div>

    <div id="debuggerMessage">
        <a href="">Active debugger</a>
        <span>Click on the green bug button in the bottom right to access the debugger.If the debugger is already opened, you'll not see the button.</span>
    </div>

    <p>
        Source code: (Since this quick example just bind two HTML elements with each other, no javascript is needed)
    </p>

    <div id="sourceTab" knot-debugger-ignore  knot-component="SourceTabPage">
    </div>
    <script type="text/cbs">
        #sourceTab{
            sourceInfo:/sourceCodeInfo.codes
        }
    </script>
    <script>
        //collect source codes before knot changes the HTML
        window.sourceCodeInfo = {codes:null};

        window.SourceCodeHelper.collectSourceCodes(
            [{selector:".knot_example",title:"HTML", type:"html"},
                {selector:".exampleCBS",title:"CBS", type:"cbs"}],
            function(res){
                window.sourceCodeInfo.codes = res;
            });
    </script>
</section>

<?php
$smarty = \Common::getSmarty();
$smarty->display("footer.tpl");
?>
</body>
</html>