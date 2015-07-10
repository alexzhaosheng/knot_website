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

    <link rel="stylesheet" href="css/tagEditor.css">
    <script type="text/cbs" src="cbs/tagEditor.pkg.cbs" id="tagEditorCBS"></script>
    <script src="js/tagEditor.js" id="tagEditorJS"></script>

    <style>
        #tagEditorContainer{
            padding: 5px;
            background: whitesmoke;
            border: 1px solid lightgray;
        }
    </style>

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
$smarty->assign("page", 6);
$smarty->display("tutorialMenu.tpl");
?>

<div class="tutorialContent">
    <h2>Component</h2>
    <p>Knot.js providers a simple while flexible way to build components. You can use CBS or other knot.js component to create your own component.</p>
    <p>A component can be applied by adding <span class="inlineCode">knot-component</span> attribute with the component name to the container of the component. </p>
    <p class="specialHint"> You've already seen a knot.js component already. The tab pages that show the codes on this site are from a component named "SourceTabPage",
        which uses another component named "TabPage" to show the tab pages. The reason you can't see them from the <i>Debugger</i> is because they are marked with "knot-debugger-ignore" to have the Debugger skipping them.</p>
    <p>
        Here are the steps to implement a knot.js component:
        <ul>
            <li><span>Create a Javascript class which comes with these interface methods:</span>
                <div class="codeSegment">
                    <pre><code class="javascript">//Knot.js will call this function to
//tell you the Access Point that bound in CBS is changed.
function setValue(apDescription, value, options){}

//Knot.js will call this function to get value from Access Point
function getValue(apDescription, options){}

//Tell knot.js whether this Access Point is monitor-able.
//If the Access Point may be changed by the component it-self, it's monitor-able.
function doesSupportMonitoring(apDescription){}

//Monitor the Access Point. If the Access Point is changed, you should call
//the "callback" to notify knot.js that the Access Point is changed.
function monitor(apDescription, callback, options){}

// Stop monitor theAccess Point.
function stopMonitoring(apDescription, callback, options){}

// Dispose the component. Release the resources used.
function dispose(){}
</code></pre>
                </div>
            </li>
            <li>
                <span>Register the factory method of component to knot.js.</span>
                <div class="codeSegment">
                    <pre><code class="javascript">global.Knot.Advanced.registerComponent(
    "[COMPONENT_NAME]",
    function(node, componentName){
        return new YourComponent(node);
    });
                    </code></pre>
                </div>
            </li>
            <li>
                <span>Use <i>Private CBS Package</i> to store HTML and CBS resources that used by the component.
                    <i>Private CBS Package</i> always starts with <span class="inlineCode">$private</span> as it's first line, and always comes with HTML and CBS.
                    HTML is enclosed with <span class="inlineCode">&lt;&lt;{{</span> and <span class="inlineCode">}}&gt;&gt;</span>. The CBS in the <i>Private CBS Package</i>
                    is only applied to the HTML in that <i>Private CBS Package</i>.
                </span>
            </li>
        </ul>
    </p>

    <p>Again, let's learn from the example. This time we will create a tag edit component. this component accept a tag string (tags separated with ","), and provider and UI for editing.
     This component also provide an <i>Access Point</i> to allow user modifying it's color by CBS. </p>

    <div class="knot_example" id="tagEditorExampleHTML">
        <h2>Knot.js example - Tag editor</h2>
        <div class="curValue">
            <p>Current tags: <b id="currentTags"></b></p>
        </div>
        <p> Tag Color:
        <select>
            <option value="red">Red</option>
            <option value="blue">Blue</option>
            <option value="green">Green</option>
        </select>
        </p>

        <div id="tagEditorContainer" knot-component="TagEditor"></div>
    </div>

    <script id="tagEditorExampleJS">
        window.tags = "knot.js, tag editor";
    </script>

    <script type="text/cbs" id="tagEditorExampleCBS">
        #tagEditorContainer{
            tags: /tags;
            tagColor: #(#tagEditorExampleHTML select).value;
        }
        #currentTags{
            text: /tags
        }
    </script>

    <div id="tagEditorExampleCodePages" knot-debugger-ignore  knot-component="SourceTabPage"></div>

    <ul>
        <li><span>When component is bound with CBS to application's models, it's actually bound to the component object though the component interface methods.
            Then component object update it's relevant values that have been bound with UI by the component's <i>Private CBS Package</i>.</span>
            <img src="../img/tutorial/t6_1.png">
        </li>
        <li>
            <span>The HTML resources in the <i>Private CBS Package</i> must be template. And can only accessed by the template id.</span>
        </li>
    </ul>
</div>

</section>

<script type="text/cbs">
    #tagEditorExampleCodePages{
        sourceInfo:/sourceModel.codePages;
        height:'400px';
    }
</script>
<script>
    window.sourceModel = {};
    window.SourceCodeHelper.collectSourceCodes(
        [
            {selector:"#tagEditorExampleHTML",title:"HTML", type:"html"},
            {selector:"#tagEditorExampleCBS",title:"CBS", type:"css"},
            {selector:"#tagEditorExampleJS",title:"Javascript", type:"javascript"},
            {selector:"#tagEditorJS",title:"Component Javascript", type:"javascript"},
            {selector:"#tagEditorCBS",title:"Component CBS", type:"css"}
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