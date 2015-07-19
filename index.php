<?php

require_once "comm.php";

?>
<!DOCTYPE html>
<html>
<head>
    <title>Javascript MVVM Framework Knot.js</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Knot.js is an open source Javascript framework that targets to provide the best biding experience to frontend developers. It comes with CBS support to give you the best maintainability." />
    <meta name="keywords" content="javascript,mvvm,framework,data binding,knot.js,CBS,angular.js,knockout.js,ember.js" />

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

    <script src="js/debugger/knot.debug.js"></script>

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
    <p><b>Knot.js</b> is an open source Javascript MVVM framework that targets to bring up the best data binding experience for Javascript developers. If you are not familiar with MVVM, please follow this link:
        <a href="https://en.wikipedia.org/wiki/Model_View_ViewModel"> MVVM@Wikipedia</a></p>
    <h1>Why?</h1>
    <ul>
        <li>
            <p>
                <b>You don't want to mess up your HTML by the weird markups.</b>
                <p>
                    Knot.js comes with a brand new idea named <i>Cascading Binding Sheet</i> (CBS).  Just like Cascading Style Sheet (CSS) to HTML styles, CBS extracts the binding logic from HTML code to
                    CBS script blocks or stand-along CBS files, and leaves you a perfect clean world.<br/>
                </p>
                <p class="imageComment">The left is the code fragment of AngularJS, the right is how you do the same thing with knot.js <br>
                    <a target="fullImage" href="img/intro_1.png"><img alt="Comparing the code style between AngularJS and knot.js" class="inPageImage" src="img/intro_1.png"></a>
                </p>
            </p>
        </li>

        <li>
            <p>
                <b>You don't want to write more code just because the framework forces you.</b>
                <p>
                    With the automatic data awareness system of knot.js, you don't have to write code in the odd style that framework requires. Just do it in your most familiar way and the simplest way, it always works with knot.js .<br/>
                    (The left is the code fragment of AngularJS, the right is how you do the same thing with knot.js )<br/>
                </p>
                <p class="imageComment">The left is the code fragment of AngularJS, the right is how you do the same thing with knot.js <br>
                    <a target="fullImage" href="img/intro_2.png"><img alt="Comparing the code style between AngularJS and knot.js" class="inPageImage" src="img/intro_2.png"></a>
                </p>
            </p>
        </li>

        <li>
            <p>
                <b>You don't want fight with the framework when something goes wrong.</b>
                <p>
                    Just like using DOM inspector to inspect CSS/DOM problems, you can use knot.js debugger to inspect the binding settings and real time statuses in almost the same manner.
                    It turns knot.js into a white box. No more experiences of fighting with framework by tracing error through tons of complex alien source code.
                    <a target="fullImage" href="img/intro_3.png"><img alt="Knot.js debugger" class="inPageImage" src="img/intro_3.png"></a>
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
                            <p>Tiny. 45kb and no dependency.</p>
                        </li>
                        <li>
                            <p>Easy. Knot.js follows intuition in all aspects.</p>
                        </li>
                        <li>
                            <p>Fast. Knot.js has very good performance. It's almost as fast as using jQuery directly. Check this link for <a href="performance/"> the performance comparison between jQuery, knot.js and AngularJS</a> </p>
                        </li>
                        <li>
                            <p>Feature-complete. Template, data validation, multi-binding, single page application, component, embedded Javascript function... Everything that you except for an UI binding framework is here.</p>
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

    <p>
        Here is a simple example to give you the first impression of knot.js. <br>
        Or why not start to learn more about <b>knot.js</b> with the <b><a href="tutorial/"> tutorials</a></b> now?
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