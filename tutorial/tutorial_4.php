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

    <link rel="stylesheet" href="../css/tabpage.css">
    <link rel="stylesheet" href="../css/site.css">


    <script src="../js/knot.min.js"></script>

    <script type="text/cbs" src="../cbs/tabpage.pkg.cbs"></script>
    <script type="text/cbs" src="../cbs/sourceTab.pkg.cbs"></script>
    <script src="../js/tabpage.js"></script>
    <script src="../js/sourceTab.js"></script>

    <script src="../debugger/knot.debug.js"></script>

    <script>
        window.sourceModel = {};
        hljs.initHighlightingOnLoad();
    </script>

    <style id="exampleCSS">
        .memberList{
            width: 290px;
            height: 300px;
            border: 1px solid lightgray;
            padding: 2px;
            float: left;

            overflow: auto;
        }

        .memberList>div{
            margin: 2px 0px;
        }

        .selectedMember{
            width: 250px;
            float: left;
            margin-left: 10px;
        }

        .memberList .memberTemplate div{
            display: inline-block;
            line-height: 64px;
            margin-left: 10px;
            cursor: pointer;
        }
        .memberList .memberTemplate img{
            height:60px;
            width: 40px;
            margin: 2px;
            float: left;
        }

        .selectedMember .memberTemplate div{
            font-weight: bold;
        }
        .selectedMember .memberTemplate img{
            height: 290px;
        }

        .memberList .memberTemplateV2 div{
            display: inline-block;
            line-height: 64px;
            margin-left: 10px;
            cursor: pointer;

            width: calc(100% - 120px);
        }

        .memberList .memberTemplateV2 .portrait{
            height:60px;
            width: 40px;
            margin: 2px;
            float: left;
        }
        .memberList .memberTemplateV2 .armory{
            height: 40px;
            width: 35px;
            margin: 12px 2px;
            float: right;
        }

        .starkMemberTemplate{
            background-color: whitesmoke;
        }
        .lanisterMemberTemplate{
            background-color: #ff9999;
        }


        .selectedMember .memberTemplateV2{
            text-align: center;
            padding: 5px;
        }
        .selectedMember .memberTemplateV2 .armory{
            width: 30px;
            margin: 2px 100px;
        }
        .selectedMember .memberTemplateV2 .portrait{
            height: 230px;
        }

        .memberList .selected{
            background-color: lightblue;
        }
    </style>

    <script type="text/javascript" id="iceAndFileCharactersList">
        window.iceAndFileCharactersModel = {
            selectedHouse: null,
            selectedMember: null,
            houses:[
                {
                    houseName:"Lannister",
                    members:[
                        {
                            name:"Tyrion Lannister",
                            url:"https://upload.wikimedia.org/wikipedia/en/thumb/5/50/Tyrion_Lannister-Peter_Dinklage.jpg/240px-Tyrion_Lannister-Peter_Dinklage.jpg"
                        },
                        {
                            name:"Jaime Lannister",
                            url:"https://upload.wikimedia.org/wikipedia/en/b/b5/JaimeLannister.jpg"
                        },
                        {
                            name:"Cersei Lannister",
                            url:"https://upload.wikimedia.org/wikipedia/en/thumb/a/a7/Queencersei.jpg/250px-Queencersei.jpg"
                        }
                    ]
                },
                {
                    houseName:"Stark",
                    members:[
                        {
                            name:"Jon Snow",
                            url:"https://upload.wikimedia.org/wikipedia/en/thumb/f/f0/Jon_Snow-Kit_Harington.jpg/240px-Jon_Snow-Kit_Harington.jpg"
                        },
                        {
                            name:"Arya Stark",
                            url:"https://upload.wikimedia.org/wikipedia/en/thumb/3/39/Arya_Stark-Maisie_Williams.jpg/220px-Arya_Stark-Maisie_Williams.jpg"
                        },
                        {
                            name:"Sansa Stark",
                            url:"https://upload.wikimedia.org/wikipedia/en/thumb/7/74/SophieTurnerasSansaStark.jpg/220px-SophieTurnerasSansaStark.jpg"
                        },
                        {
                            name:"Catelyn Stark",
                            url:"https://upload.wikimedia.org/wikipedia/en/thumb/1/1b/Catelyn_Stark_S3.jpg/220px-Catelyn_Stark_S3.jpg"
                        }
                    ]
                },
                {
                    houseName:"All",
                    members:[]
                }
            ]
        };
        //select Stark house as the default
        window.iceAndFileCharactersModel.selectedHouse =  window.iceAndFileCharactersModel.houses[1];

        //add all members to "All" and sort them by name
        window.iceAndFileCharactersModel.houses[2].members =
            window.iceAndFileCharactersModel.houses[1].members.concat(window.iceAndFileCharactersModel.houses[0].members);

        window.iceAndFileCharactersModel.houses[2].members.sort(function(c1, c2){return c1.name>c2.name?1:-1;});
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
    $smarty->assign("page", 4);
    $smarty->display("tutorialMenu.tpl");
    ?>

<div class="tutorialContent">
    <h2>Template</h2>
    <p>
        Template is essential for creating the sophisticated UI. Especially in knot.js, template takes a vital position.
        You'll need it not only for repeating or nested UI blocks, but also for reusable UI component.
    </p>
    <p>To use template, you can use <i>Access Point</i> "foreach" (for repeating UI blocks) or "content" for (for nested UI blocks).
        You can also create UI blocks from template in your Javascript, we'll talk about this in the tutorial relevant to reusable UI component</p>


    <h3 id="static">Static Template</h3>
    <p>
        Static Template is defined in HTML as a single HTML element, and is assigned the template id by attribute "<b>knot-template-id</b>", or is marked with attribute "<b>knot-template</b>" (for the anonymous template).
    </p>
    <p>Check the example below:</p>


    <script type="text/cbs" id="staticTemplateExampleCBS">
        #staticTemplateExample{
            dataContext: /iceAndFileCharactersModel;

            -> select{
                /*select options are set as anonymous template, therefore no need to specify "template" for foreach option*/
                foreach: houses;

                selectedData: selectedHouse;

                /*clear the current selected member when house is changed.*/
                @change: @{iceAndFileCharactersModel.selectedMember = null;};

                /*option is the template, it's Data Context will be set with the item in the array*/
                -> option{
                    text: houseName
                }
            };

            -> .memberList{
                /*
                    Directly bind the list to the members of the selected House
                    it's template is template with id "member"
                */
                foreach[template: memberTemplate]: selectedHouse.members
            };

            -> .selectedMember>div{
                /*
                    use template "memberTemplate" to show the selected member.
                */
                content[template: memberTemplate]: selectedMember
            };

            /*
                This is the template. Note it's Data Context has set to the relevant data.
            */
            -> .memberTemplate{
                /* if current selected member is it-self, set the selected style, otherwise remove the selected style */
                class: /iceAndFileCharactersModel.selectedMember >@{return this === value? "+selected": "-selected";};

                /* set it-self as current selected member*/
                @click: @{iceAndFileCharactersModel.selectedMember = this;};

                -> div { text: name; };
                -> img{ src: url; };
            }
        }
    </script>

    <div class="knot_example" id="staticTemplateExample">
        <h3>A Song of Ice and Fire characters (V1)</h3>
        <p> House:
        <select>
            <option knot-template></option>
        </select>
        </p>
        <div>
            <div class="memberList"></div>
            <div class="selectedMember">
                <div></div>
            </div>
        </div>
        <!-- This is template for showing members. it's template id is "memberTemplate"
            Note it's presentation depends whether it's in list or not, that is done by CSS -->
        <div class="memberTemplate" knot-template-id="memberTemplate">
            <div></div>
            <img>
        </div>
    </div>
    <div id="staticTemplateExampleCodePages" knot-debugger-ignore  knot-component="SourceTabPage"></div>


    <ul>
        <li><span>In this example, the house drop down's options are added by anonymous template. The items in member list are created with template "memberTemplate" </span></li>
        <li><span>Please note that the <i>Data Context</i> of the template is set with the corresponding data. Elements created from template has different Data Context than it's parent.</span></li>
        <li><span>Anonymous template must be the only child of the element that use it as template by "foreach" or "content" <i>Access Point</i></span></li>
        <li><span>Jon Snow is a Stark. Here is the <a target="_blank" href="https://en.wikipedia.org/wiki/Jon_Snow_(character)#Family_tree_of_House_Stark">proof</a></span></li>
    </ul>



    <h3 id="templateSelector">Template Selector</h3>
    <p><i>Template Selector</i> is a very convenient way to deal with the complex template utilizing scenario. It is a function that created by user. Knot.js passes the data in to selector to get the correct template id.</p>
    <p><i>Template Selector</i> is declared by the <i>Access Point</i> option "templateSelector".</p>
    <p>Let's learn from the example. This time we want to use the different template for the different house.</p>
    <script type="text/cbs" id="templateSelectorExampleCBS">
        #templateSelectorExample{
            dataContext: /iceAndFileCharactersModel;

            -> select{
                foreach: houses;
                selectedData: selectedHouse;
                @change: @{iceAndFileCharactersModel.selectedMember = null;};
                -> option{
                    text: houseName
                }
            };

            -> .memberList{
                /* use templateSelector to show different templates for members */
                foreach[templateSelector: @/memberTemplateSelector]: selectedHouse.members
            };

            -> .selectedMember>div{
                /* use templateSelector to show different templates for members */
                content[templateSelector: @/memberTemplateSelector]: selectedMember
            };

            -> .memberTemplateV2{
                class: /iceAndFileCharactersModel.selectedMember >@{return this === value? "+selected": "-selected";};
                @click: @{iceAndFileCharactersModel.selectedMember = this;};

                /* show the first name only */
                -> div>b { text: name > @{return value.split(" ")[0];}};
                -> .portrait{ src: url; };
            }
        }
    </script>
    <script id="templateSelectorExampleJS">
        window.memberTemplateSelector = function(member, node){
            if(window.iceAndFileCharactersModel.houses[0].members.indexOf(member) >= 0){
                return "lanisterMemberTemplate";
            }
            else{
                return "starkMemberTemplate";
            }
        }
    </script>
    <div class="knot_example" id="templateSelectorExample">
        <h3>A Song of Ice and Fire characters (V2)</h3>
        <p> House:
            <select>
                <option knot-template></option>
            </select>
        </p>
        <div>
            <div class="memberList"></div>
            <div class="selectedMember">
                <div></div>
            </div>
        </div>

        <!-- template for Starks -->
        <div class="memberTemplateV2 starkMemberTemplate" knot-template-id="starkMemberTemplate">
            <div><b></b> of Stark</div>
            <img class="armory" src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cb/Stark_Coat_of_Arms.png/150px-Stark_Coat_of_Arms.png">
            <img class="portrait">
        </div>

        <!-- template for Lanisters -->
        <div class="memberTemplateV2 lanisterMemberTemplate" knot-template-id="lanisterMemberTemplate">
            <div>Lanister's <b></b> </div>
            <img class="armory" src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7f/Escudo_de_Armas_de_la_Casa_de_Lannister.png/150px-Escudo_de_Armas_de_la_Casa_de_Lannister.png">
            <img class="portrait">
        </div>
    </div>
    <div id="templateSelectorExampleCodePages" knot-debugger-ignore  knot-component="SourceTabPage"></div>
    <ul>
        <li><span>In this example, the items in house member list are created from two different templates:"starkMemberTemplate", "lanisterMemberTemplate". Knot.js calls <i>Template Selector</i>
                "window.memberTemplateSelector" to decide which template it should use. </span></li>
        <li><span>You may have noticed, the status of this V2 list is synchronized with the V1 list. This is because they all bind to the same data model, which is "window.iceAndFileCharactersModel".</span></li>
    </ul>


    <h3 id="dynamic">Dynamic Template</h3>
    <p>
        Template selector is still not flexible enough for you ? Fine,
    </p>
</div>

</div>
</section>

<script type="text/cbs">
    #staticTemplateExampleCodePages{
        sourceInfo:/sourceModel.staticTemplateExampleCodePages
    }
    #templateSelectorExampleCodePages{
        sourceInfo:/sourceModel.templateSelectorExampleCodePages
    }
</script>
<script>
    window.sourceModel = {};
    window.SourceCodeHelper.collectSourceCodes(
        [
            {selector:"#staticTemplateExample",title:"HTML", type:"html"},
            {selector:"#iceAndFileCharactersList",title:"Javascript", type:"javascript"},
            {selector:"#staticTemplateExampleCBS",title:"CBS", type:"cbs"},
            {selector:"#exampleCSS",title:"CSS", type:"css"}
        ],
        function(res){
            window.sourceModel.staticTemplateExampleCodePages = res;
        });

    window.SourceCodeHelper.collectSourceCodes(
        [
            {selector:"#templateSelectorExample",title:"HTML", type:"html"},
            {selector:"#templateSelectorExampleJS",title:"Javascript", type:"javascript"},
            {selector:"#templateSelectorExampleCBS",title:"CBS", type:"cbs"},
            {selector:"#iceAndFileCharactersList",title:"Javascript(Data)", type:"javascript"},
            {selector:"#exampleCSS",title:"CSS", type:"css"}
        ],
        function(res){
            window.sourceModel.templateSelectorExampleCodePages = res;
        });
</script>

<?php
$smarty = \Common::getSmarty();
$smarty->display("footer.tpl");
?>
</body>
</html>