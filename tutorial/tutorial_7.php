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
    $smarty->assign("page", 7);
    $smarty->display("tutorialMenu.tpl");
    ?>

    <div class="tutorialContent">
        <h2>Tricks And Traps</h2>
        <h3>Animation</h3>
        <p>Knot.js works with almost all of the animation libraries. You can interpose anytime to add the animation effect. Here's an example of using jQuery Animation effect.</p>
        <style type="text/css" id="animationCSS">
            #animationExample .userList{
                width: 150px;
                height: 300px;
                overflow: auto;
                float: left;
                border: 1px solid lightgray;
                padding: 2px;
            }
            #animationExample .editArea{
                padding-left: 10px;
                float: left;
                height: 300px;
            }
            #animationExample .editArea *{
                margin: 3px 0px;
            }
            #animationExample .userInfo{
                padding: 5px 10px;
                border: 1px lightgray solid;
                line-height: 20px;
                margin: 1px;
            }
            #animationExample .user{
                background: lightgreen;;
            }
            #animationExample .admin{
                background:  lightpink;
            }
            #animationExample .inAnimatingContainer{
                position: absolute;
                width: 150px;
            }
        </style>
        <script type="text/cbs" id="animationCBS">
           #animationExample{
                dataContext:/animationExampleModel;
                -> .userInfo{
                        class: type>@{return value=="u"?"+user -admin":"+admin -user";};
                        ->span{text: name};
                };

                -> .userList{
                    foreach[template: userInfo; @added: @onUserAdded]: userList;
                };

                -> .editArea{
                    -> .userInEditing{
                        content[template: userInfo]: inEditing;
                    };
                    -> .inAnimatingContainer{
                        style.display: inAnimating> @{return value?"block":"none";};
                        content[template: userInfo]: inAnimating;
                    };

                    -> .editUI{
                        -> input{value:inEditing.name};
                        -> select{value:inEditing.type};
                        -> .okButton{
                            @click:@{
                                this.userList.push(this.inEditing);
                                this.inEditing = {type:"u"};
                            }
                        }
                    }
                }
            }
        </script>
        <script id="animationJS">
            window.animationExampleModel = {
                userList:[],
                inEditing: {type:"u"},

                inAnimating:null,

                onUserAdded: function(node, value){
                    window.animationExampleModel.inEditing = value;
                    $(node).hide();
                    var inEditing = $("#animationExample .userInEditing");
                    $("#animationExample .inAnimatingContainer")
                        .css("left", inEditing.offset().left  - $("body").scrollLeft())
                        .css("right", inEditing.offset().right  - $("body").scrollTop())
                        .animate({opacity:1, left: $(node).offset().left, top: $(node).offset().top}, 600, function () {
                            $(node).css("opacity", 1);
                            window.animationExampleModel.inAnimating = null;
                        });
                }
            };
        </script>

        <div class="knot_example" id="animationExample">
            <h2>Knot.js example - Animation</h2>
            <div class="userInfo" knot-template-id="userInfo">&nbsp;<span></span></div>
            <div class="userList">
            </div>

            <div class="editArea">
                <div class="userInEditing"></div>
                <div class="editUI">
                    <input type="text" placeholder="User name"> <br>
                    <label>User Type:</label>
                    <select>
                        <option value="a">Admin</option>
                        <option value="u">User</option>
                    </select>
                    <br>
                    <button class="okButton">OK</button>
                </div>
                <div class="inAnimatingContainer"></div>
            </div>
        </div>

        <div id="animationExampleCodePages" knot-debugger-ignore  knot-component="SourceTabPage"></div>

        <h3>Traps</h3>
        <ul>
            <li><span>Don't forget to remove the reference to the <i>Debugger</i> before you release, it may bring serious performance problem!</span></li>
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
                    You can set "configurable" to false when define the property and use <span class="inlineCode">Knot.notifyObjectChanged(object, path, oldValue, newValue)</span>
                    to tell knot.js when it's changed.</li>
        </ul>

    </div>
</section>

<script type="text/cbs">
    #animationExampleCodePages{
        sourceInfo:/sourceModel.codePages
    }
</script>
<script>
    window.sourceModel = {};
    window.SourceCodeHelper.collectSourceCodes(
        [
            {selector:"#animationCBS",title:"CBS", type:"cbs"},
            {selector:"#animationJS",title:"Javascript", type:"javascript"},
            {selector:"#animationExample",title:"HTML", type:"html"}
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