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

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <link rel="stylesheet" href="../css/github.css">
    <script src="../js/highlight.pack.js"></script>


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
$smarty->assign("page", 1);
$smarty->display("tutorialMenu.tpl");
?>

    <div class="tutorialContent">
        <h2>Start</h2>
        <p> The first thing you need to know about knot.js is CBS.</p>
        <h3 id="cbs">CBS Basic</h3>
        <p>
           <b>CBS</b> stands for <b>C</b>ascading <b>B</b>inding <b>S</b>heet. It is intended to extract binding logic from your HTML.
            In addition to the clean HTML, you also get the structured, clean, easily readable data binding logic that is defined in CBS.
        </p>
        <p>
            CBS is not only looks like CSS, it works almost in the same manner as CSS.<br>
            Here's a typical CBS:<br>
            <img src="../img/tutorial/t1_2.png">
            <ul>
                <li><span>To enable CBS in your page, you just need to add the line below to reference knot.js package:</span>
                    <div class="codeSegment">
                        <pre><code class="html"> &lt;script src=&quot;[PATH_TO_KNOTJS]/knot.min.js&quot;&gt;&lt;/script&gt;</code></pre>
                    </div>
                </li>
                <li><span><i>Selector</i> works in exactly the same way as CSS Selector. It can be any of the <a href="http://www.w3schools.com/cssref/css_selectors.asp" target="w3schools">CSS selectors</a> or <i> a Object Selector</i>.
                        For more information about <i>Selector</i>, please follow this link: <a target="gitHubWiki" href="https://github.com/alexzhaosheng/knot.js/wiki/Selector">Selector(Wiki@GitHub)</a> </span></li>
                <li><span>Each section ends with "<b>;</b>"</span></li>
                <li><span><i>Access Point</i> is the description of where you want to bind to the target, it depends on the target.</span>
                    <ul>
                        <li><span><i>Left Access Point</i> is on the object selected by <i>"Selector"</i> (in most case, it's a HTML element). It can be any properties on the HTML element, or it can be a path like "style.backgroundColor". </span></li>
                        <li><span><i>Right Access Point</i> is on the current <i>Data Context</i>. It can be properties or path of value like "address.postCode".
                                And it can also be the absolute path of value that starts with "/". In this case, knot.js ignores the current <i>Data Context</i> and get the data from the global scope. </span></li>
                    </ul>
                    <span>In the example above, it binds "value" of #userNameInput to the "name" property of current Data Context. For more information about the <i>Access Point</i>, please follow this link:
                        <a target="gitHubWiki" href="https://github.com/alexzhaosheng/knot.js/wiki/Access-Point">Access Point(Wiki@GitHub)</a> </span>
                    <p class="specialHint"><i>Access Point</i> is extensible. The component created by knot.js often supports it's own special <i>Access Points</i>. Please check the document of the component that you are using.</p>
                </li>
                <li><span>There are four <i>Binding Types</i>: <i>:</i> for two-way binding, <i>"=>"</i>,<i>"<="</i> for one-way binding and <i>"="</i> for one-off binding. For more information about <i>Binding Types</i>,
                        please follow this link:<a target="gitHubWiki" href="https://github.com/alexzhaosheng/knot.js/wiki/Binding-types">Binding-types(Wiki@GitHub)</a> </span>
                    <p class="specialHint">Just use <i>":"</i> if you don't know which type you should use.</p>
                </li>
                <li><span><i>Data Context</i> is the data you want to bind to the HTML element.</span>
                    <ul>
                        <li><span>Data Content is specified by the Access Point named "dataContext". Here's an example:</span>
                            <div class="codeSegment">
                                <pre><code class="css">body{ dataContext: /model }</code></pre>
                            </div>
                        </li>
                        <li><span>If there's no dataContext specified, a HTML node inherits it's  <i>Data Context</i> from the closest DOM ancestors that has <i>Data Context</i>.</span></li>
                    </ul>
                </li>
                <li><span>You can embed a CBS declaration into another by adding "->" before the selector. This makes your CBS looks more structured and easier for reading. Here's example:</span>
                    <div class="codeSegment">
                        <pre><code class="css">/*this is the "traditional" way*/
.example input{value:name;}
.example .message{text: name;}

/*This is the better way in CBS. They are identical in result*/
.example{
    -> input{value:name;};
    -> .message{text: name;};
}</code></pre>
                    </div>
                </li>
            </ul>
        </p>

        <br>

        <p>Let's take a look at the "Greeting" example again (with a little bit of change to get Javascript involved):</p>

        <script type="text/cbs" class="exampleCBS">
            .knot_example {
                /*
                    Set the default dataContext of all elements in example to "/greetingModel",
                    which is window.greetingModel that created in Javascript
                */
                dataContext: /greetingModel;


                /*
                    Bind "value" of the input to "name".  Since the dataContext is window.greetingModel,
                    it is actually bind to window.greetingModel.name.
                    Another way to do the same thing is to use absolute path:
                    "value[immediately:1]: /greetingModel.name"
                    "[immediately:1]" is the binding option, it tells knot.js to update for each of the
                    key stroke. We'll talk about it later
                */
                -> input{
                    value[immediately:1]: name;
                };

                /*Bind to the textContent of .helloString to show the name after "Hello" */
                -> .helloString{
                    text: name;
                }
            }
        </script>
        <script type="text/javascript" class="exampleJS">
            //Use a simple plain object as the model, the data awareness system will
            //monitor the changes of the object automatically
            window.greetingModel = {name:"Alex"};
        </script>
        <div class="knot_example">
            <h3>Greeting from knot.js (V2)</h3>
            <p>
                <label>Input your name here: </label>
                <input type="text">
            </p>
            <p>
                Hello <b class="helloString"></b>
            </p>
        </div>
        <br/><br/>
        <p> In this example, the input box is bound to the "model.name" , and then "model.name"  is tied up to the text content of a &lt;b&gt; tag(".helloString") to show the value.</p>
        <img src="/img/tutorial/t1_1.png"><br/><br/>

        <p>The magic is done by the code below, please check the comments to learn more:</p>
        <div id="codePages" knot-debugger-ignore  knot-component="SourceTabPage"></div>


        <h3 id="more">More about CBS</h3>
        <ul>
            <li><span>If you want to do something after knot.js is initialized (all bindings have been established), just do it in this way:</span>
                <div class="codeSegment">
                    <pre><code class="javascript">Knot.ready(function(succeed, err){
    if(!succ) {
        global.alert(err.message);
        return;
    }
    // your own code....
}</code></pre>
                </div>
            </li>
            <li>
                <span>You can also put your options onto HTML tag just like how you do it in the other frameworks (I don't think it's a good way, but I agree to disagree). Here's an example:</span>
                <div class="codeSegment">
                    <pre><code class="html">&lt;input type=&quot;text&quot; binding=&quot;value:name&quot;&gt;</code></pre>
                </div>
            </li>
            <li>
                <span>CBS can be put into a stand-along file, and loaded into system by "script" tag with content type "text/cbs". Here's an example:</span>
                <div class="codeSegment">
                    <pre><code class="html"> &lt;script type=&quot;text/cbs&quot; src=&quot;[PATH_TO_CBS]/example.cbs&quot;&gt;&lt;/script&gt;</code></pre>
                </div>
            </li>
            <li>
                <span>Similar to CSS, binding option apply to <b>all</b> HTML elements that selected by <i>Selector</i>. For example, the CBS below will bind the text content
                    of all of the elements with class "title" to the "title" property of <b>their own</b> <i>Data Context</i> objects.</span>
                <div class="codeSegment">
                    <pre><code class="css">.title{ text: title }</code></pre>
                </div>
            </li>
            <li><span>Not all of the <i>Access Points</i> is available for two-way binding. For instance, in the example above, ".helloString.text" will never change by it self, therefore these two declare are <b>identical in this case</b>. </span>
                <div class="codeSegment">
                    <pre><code class="css">.helloString{text: name;}

.helloString{text <= name;}</code></pre>
                </div>
                <span>Here is the list for the observable Access Points for HTML element: <a target="gitHubWiki" href="https://github.com/alexzhaosheng/knot.js/wiki/Observable-HTML-Access-Points">Observable HTML Access Point List @GitHubWiki </a> </span>
            </li>
        </ul>



        <h3 id="debugger">Debugger</h3>
        <p>
            One of the coolest features comes with knot.js is the <i>Debugger</i>. With the <i>Debugger</i>, knot.js is not another mystery black box to you.
            It's transparent, you can see all of the real time statuses as well as the dynamic data flow process. It helps you understanding how does knot.js work in short time.<br>
        </p>
        <p>
            <b>Please do utilize <i>Debugger</i> to learn knot.js.</b> Why don't you call out the <i>Debugger</i> now, change something in the example input box and watch how knot.js works in this example?
        </p>
        <p>
            Click on the <img src="../js/debugger/img/debugger.png" style="height:16px;width: 16px"> button in the bottom right of the Window to bring up the <i>Debugger</i> window.
            If it doesn't work, please check you popup blocker setting.<br>
            The image blow explains how to use the <i>Debugger</i>
            <img src="../img/tutorial/t1_3.png">

            <p>To activate the <i>Debugger</i> in your project, just add this line to the head of the page:</p>
            <div class="codeSegment">
                <pre><code class="html"> &lt;script src=&quot;[PATH_TO_DEBUGGER]/knot.debug.js&quot;&gt;&lt;/script&gt;</code></pre>
            </div>
            <p>Please note the Debugger must be put in the same domain as your webpage, otherwise it won't work. And don't forget to remove this line before the release!</p>
            <p>The <i>Debugger</i> button turns into <img src="../js/debugger/img/debugger_warning.png" style="height:16px;width: 16px"> when there are warning messages, and <img src="../js/debugger/img/debugger_error.png" style="height:16px;width: 16px">
               where there are error messages. When you find something wrong, please check the error/warning messages first.</p>
           <p class="specialHint">Do you know the <i>Debugger</i> it-self is created with knot.js? Check the source files to see how simple and slick knot.js can do!</p>
            <p class="specialHint">Always remove the reference to <i>Debugger</i> before you do the release!</p>
        </p>


    </div>
</section>

<script type="text/cbs">
    #codePages{
        sourceInfo:/sourceModel.codes
    }
</script>
<script>
    window.SourceCodeHelper.collectSourceCodes(
        [
            {selector:".exampleCBS",title:"CBS", type:"cbs"},
            {selector:".knot_example",title:"HTML", type:"html"},
            {selector:".exampleJS",title:"Javascript", type:"javascript"}
        ],
        function(res){
            window.sourceModel.codes = res;
        });
</script>

<?php
$smarty = \Common::getSmarty();
$smarty->display("footer.tpl");
?>
</body>
</html>