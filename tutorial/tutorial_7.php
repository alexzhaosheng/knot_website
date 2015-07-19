<?php

require_once "../comm.php";

?>
<!DOCTYPE html>
<html>
<head>
    <title>Tutorial 7: Animation - Knot.js</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Knot.js is an open source Javascript framework that targets to provide the best biding experience to frontend developers. It comes with CBS support to give you the best maintainability." />
    <meta name="keywords" content="javascript,mvvm,framework,data binding,knot.js,CBS,angular.js,knockout.js,ember.js,tutorial,animation,knot event" />

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
    $smarty->assign("page", 7);
    $smarty->display("tutorialMenu.tpl");
    ?>

    <div class="tutorialContent">
        <h2>Animation</h2>
        <p>Knot.js comes with a series of <i>Access Point Events</i> which allow you interposing anytime to do something special such as animation.</p>
        <p>To know more about <i>Access Point Events</i>, please follow this link: <a target="gitHubWiki" href="https://github.com/alexzhaosheng/knot.js/wiki/Access-Point-Events">Access Point Events @GitHubWiki</a></p>
        <p> Knot.js works with almost all of the animation libraries. In this example, we use jQuery Animation to bump the text when it's value is changed, and animate adding new item to the list.
        </p>

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
                overflow: hidden;
            }
            #animationExample .user{
                background: lightgreen;;
            }
            #animationExample .admin{
                background:  lightpink;
            }
            #animationExample .ghostVisualContainer{
                position: absolute;
                width: 150px;
            }
        </style>
        <script type="text/cbs" id="animationCBS">
#animationExample{
    dataContext:/animationExampleModel;
    -> .userInfo{
            class: type>@{return value=="u"?"+user -admin":"+admin -user";};

            /* user "@set" event to animate the text when text is changed. */
            ->span{text[@set: @/animationExampleModel.onTextSet]: name};
    };

    -> .userList{
        /* user "@added" event to animate adding item to list. */
        foreach[template: userInfo; @added: @/animationExampleModel.onUserAdded]: userList;
    };

    -> .editArea{
        -> .userInEditing{
            content[template: userInfo]: inEditing;
        };

        /* This is ghost visual when animate adding item  */
        -> .ghostVisualContainer{
            style.display: inAnimating> @{return value?"block":"none";};
            content[template: userInfo]: inAnimating;
        };

        -> .editUI{
            -> input{value[immediately:1]:inEditing.name};
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

                //when animate adding item, set the item to animationExampleModel.inAnimating
                //CBS will create a ghost visual for it and we just need to simply animating that visual.
                inAnimating:null,

                //this is called when new item is added to list. "node" is the new item's HTML element
                onUserAdded: function(node, value){
                    //hide the new item first, will show it after animation is finished.
                    $(node).css("opacity", 0);

                    // set new value to "inAnimating", ghostVisual will be created automatically.
                    window.animationExampleModel.inAnimating = value;
                    var ghostVisual = $("#animationExample .ghostVisualContainer");


                    //the animation is moving ghost visual from the position in editor to
                    //the position in list. therefore set the position of the ghost to the position
                    // of editor first.
                    var inEditing = $("#animationExample .userInEditing");

                    ghostVisual
                        .css("left", inEditing.offset().left)
                        .css("top", inEditing.offset().top)
                        .animate({left: $(node).offset().left, top: $(node).offset().top-4}, 600, function () {
                            //show the node in list.
                            $(node).css("opacity", 1);
                            //set inAnimating to null to dispose the ghost visual
                            window.animationExampleModel.inAnimating = null;
                        });
                },

                //bump the text when it's changed.
                onTextSet: function(node, value){
                    var p = this.parentNode;
                    $(p).css("transform", "translate(0,-2px)");
                    setTimeout(function(){
                        $(p).css("transform", "translate(0,0px)");
                    },100)
                }
            };
        </script>

        <div class="knot_example" id="animationExample">
            <h2>Knot.js example - Animation</h2>
            <div class="userInfo" knot-template-id="userInfo">Name:<span></span></div>
            <div class="userList">
            </div>

            <div class="editArea">
                <div class="userInEditing"></div>
                <div class="editUI">
                    <p>
                    <label>User Type:</label><br>
                    <select>
                        <option value="a">Admin</option>
                        <option value="u">User</option>
                    </select>
                    </p>
                    <p>
                    <label>User name</label><br>
                    <input type="text"> <br>
                    </p>
                    <button class="okButton">Add</button>
                </div>
                <div class="ghostVisualContainer"></div>
            </div>
        </div>

        <div id="animationExampleCodePages" knot-debugger-ignore  knot-component="SourceTabPage"></div>

        <ul>
            <li><span>There's a "ghost visual" that is created for adding user animation. When the new user is added, it first hides the newly added HTML element in the list, creates the ghost visual with knot.js template, then animates the ghost visual
            from the editor to the list. When animation is finished, it disposes the ghost visual and shows the HTML element.</span></li>
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