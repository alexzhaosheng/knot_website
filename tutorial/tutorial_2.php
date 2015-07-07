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
    $smarty->assign("page", 2);
    $smarty->display("tutorialMenu.tpl");
    ?>

    <div class="tutorialContent">
        <h2>Pipe</h2>

        <p>
            <i>Pipe</i> is a function that used to convert or validate data. In CBS, it follows the <i>Access Point</i> with a prefix "<b>&gt;</b>". It works exactly as it's name hints,data flows in, is changed/validated, then flows out.
        </p>
        <p>Note there's only "output pipe", no "input pipe". What if you want an input pipe? just put the pipe to the other side.</p>
        <p>Let's learn more details by examples.</p>

        <h3>Converter</h3>
        <p>Here comes the "Greeting" example again, now it is evolved into V3!</p>
        <p>You must have noticed that in the "Greeting" V2, there's a weird "Hello" even when no name is inputted. We want it disappear!</p>
        <p>We also want to say a "formal" greeting by adding a title "Mr", and we only say the family name if there's family name inputted. Sorry ladies, but we have to do it step by step. We'll add "Ms" very soon.</p>

        </p>
        <script type="text/cbs" id="converterCBS">
            body{
                dataContext: /greetingModelV3;
            }

            .greetingExampleV3{
                -> input{
                    value[immediately:1]: name;
                };

                -> .helloString{
                    /*
                        Bind display status to name, online show when there's name inputted
                        This is done by the embedded function quoted by "{" and "}"
                    */
                    style.display: name> @{return value? "inline-block":"none";};

                    -> b{
                        /*
                           Add title and get the surname.
                           @getFormalTitle is a function that defined in Javascript
                        */
                        text: name > @getFormalTitle;
                    };
                }
            }
        </script>
        <script type="text/javascript" id="converterJS">
            window.greetingModelV3 = {
                name:"",

                //always return the last name plus the title
                //this function will be called from CBS
                getFormalTitle: function(value){
                    var names =  value.split(" ").filter(function(t){return t});
                    return "Mr. "+ names[names.length-1];
                }
            };
        </script>
        <div class="knot_example greetingExampleV3" id="converterExampleHTML">
            <h3>Greeting from knot.js (V3)</h3>
            <p>
                <label>Input your name here: </label>
                <input type="text">
            </p>
            <p class="helloString">
                Hello <b ></b>
            </p>
        </div>

        <div id="converterCodePages" knot-debugger-ignore  knot-component="SourceTabPage"></div>

        <ul>
            <li><span>Functions in knot.js always start with "@"</span></li>
            <li><span>Functions can be embedded in CBS, and you are also able to reference the functions created in Javascript.</span></li>
            <li><span>For the functions embedded in CBS, it is actually parsed a function that with a "value" argument, which is the value you input into the pipe.</span></li>
            <li><span>For the functions that referenced from javascript, knot.js gets the function with the given path of value from current <i> Context Object</i>. In this case, it get the pipe
                    function from "window.greetingModelV3" by the path of value "getFormalTitle". If you want to get a function in global scope, just use absolute path of value (The path starts with "/").</span></li>
            <li><span>In the pipe function, "this" pointer is set to the current Data Context.  For instance, we can rewrite the CBS in the example into this form:</span>
                <div class="codeSegment">
                    <pre><code class="css">.greetingExampleV3 .helloString{
    /* this is identical with "style.display: name> @{return value? "inline-block":"none";};"*/
    style.display: name> @{return this.name? "inline-block":"none";};
}</code></pre>
                </div>
                <span>You would find that this is very convenient in many cases.</span>
            </li>
        </ul>


        <h3 id="validator">Validator And Binding to Error Status</h3>
        <p>Knot.js tries to keep things as simple as possible. Therefore you just need to simply throw an exception (Error) from the pipe when you find the input value is invalid, then you get your <i>Validator</i>! </p>
        <p>The exception thrown from pipe is set to the Error status of the <i>Access Point</i>, and can be bound with anything by the <b>Error Status Access Point</b>.</p>
        <p><b>Error Status Access Point</b> of an <i>Access Point</i> can be accessed with a prefix "<b>!</b>" and the name of the Access Point. It stores the latest error status of the Access Point(the exception object), if there's no error, it's NULL.</p>
        <p>Here's an Example:</p>

        <script type="text/cbs"  id="validatorExampleCBS">
    .validatorExampleForm{
        dataContext: /validatorExampleModel;

        /*
            This bind the style of the input to the error status of it's value for all of the
            inputs in the form.
            the input will get red glow (from CSS class "errorInput") when it's value is invalid
         */
        -> input[type=text]{
            class: !*LEFT.value>@{return value?"+errorInput":"-errorInput";}
        }
    }


    #nameSection{
        /*add empty check and length check to the "name" text box*/
        -> input{
            value> @/validator.notEmpty> {
                    /* you can use either  */
                    if(value.length < 3)
                        throw new Error("Name must be more than 3 characters");
                    if(value.length > 10)
                        throw new Error("Name must be no more than 10 characters");
                    return value;
                }: user.name;
        };

        /* bind the text to the "message" of error status of the value on the "name" input box.  */
        -> .errMessage{
            text:!#(#nameSection input).value>{return value?value.message:"";}
        };
    }

    #ageSection{
        /*add empty check, number format check and number range check to the "age" text box*/
        ->input{
            value> @/validator.notEmpty> @/validator.checkAndConvertToNumber> @/validator.checkAgeRange : user.age;
        };

        -> .errMessage{
            text:!#(#ageSection input).value>{return value?value.message:"";}
        }
     }

    #emailSection{
        /*add empty check, email format check to the "email" text box*/
         ->input{
            value> @/validator.notEmpty> @{
                if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value))
                    throw new Error("Invalid email!");
                return value;
            }: user.email;
        };

        ->.errMessage{
            text:!#(#emailSection input).value>{return value?value.message:"";}
        }
    }
    </script>
        <style type="text/css" id="validatorExampleCSS">
            .section{
                margin: 5px;
            }
            .errMessage{
                color:red;
            }
            .errorInput {
                box-shadow: 0px 0px 5px red;
            }
        </style>
        <script id="validatorExampleJS">
            window.validatorExampleModel = {user: {}};

            //these functions will be called by knot.js system.
            window.validator ={
                notEmpty: function (v) {
                    if(v.trim() == "")
                        throw new Error("Can't be null.")
                    return v;
                },
                checkAndConvertToNumber: function (v) {
                    v = parseInt(v);
                    if(isNaN(v))
                        throw new Error("Age must be a number!");
                    return v;
                },
                checkAgeRange: function (v) {
                    if(v<0 || v>150) {
                        throw new Error("Age must be in the range of 0~150")
                    }
                    return v;
                }
            };

            //validate the whole page, show the error messages if there's error
            function validate() {
                //get the error status of the whole page
                //it returns a list of the information about error status and the relevant HTML node
                //and Access Point
                var err = Knot.getErrorStatusInformation();
                if(err.length > 0) {
                    var msg = "Error detected:";
                    for(var i=0; i< err.length; i++) {
                        msg += "\n - " + err[i].node.placeholder  + ": " + err[i].error.message + " (Access Point: " + err[i].accessPointName + ")";
                    }
                    alert(msg);
                    //set the focus to the first element in error status
                    err[0].node.focus();
                    return false;
                }
                return true;
            }
        </script>

        <div class="knot_example" id="validatorExample">
            <h2>Knot.js example - Input validating</h2>
            <form class="validatorExampleForm" action="" onsubmit="return validate();">
                <div class="section" id="nameSection">
                    <input type="text" placeholder="Name">  <span class="errMessage"></span>
                </div>
                <div class="section" id="ageSection">
                    <input type="text" placeholder="Age">  <span class="errMessage"></span>
                </div>
                <div class="section" id="emailSection">
                    <input type="text" placeholder="Email">  <span class="errMessage"></span>
                </div>

                <input type="submit">
            </form>
        </div>

        <div id="validatorCodePages" knot-debugger-ignore  knot-component="SourceTabPage"></div>

        <ul>
            <li><span>"*LEFT" and "#(#nameSection input)" is <a target="gitHubWiki" href="https://github.com/woodheadz/knot.js/wiki/Target-Modifier"><i>Target Modifier</i></a>.</span>
                <ul>
                    <li><span>"*LEFT" is used to reference the target on the left side of binding option.</span></li>
                    <li><span>"#(#nameSection input)" is used to access the HTML with CSS selector. </span></span></li>
                </ul>
                <span>For more information about <i>Target Modifier</i>, please follow <a target="gitHubWiki" href="https://github.com/woodheadz/knot.js/wiki/Target-Modifier">this link</a>.</span>
            </li>
            <li><span>As you see, pipes can be connected with each other.</span></li>
            <li><span>Call Knot.getErrorStatusInformation without argument to validate data immediately and return the error status of the whole page. If you just want to get the
                Error Status for apart of the HTML elements, just call Knot.getErrorStatusInformation with their common ancestor as parameter.</span></li>
        </ul>
        <p class="specialHint">DO NOT forget return value in validator. It's is a pipe, a pipe always has output. And yes, you can use
        one pipe for both validating and data converting purpose, it's up to you!</p>
        <p class="specialHint">You can also see the Error Status from the Debugger!</p>

        <h3 id="multi">Multi-Binding</h3>
        <p><i>Multi-Binding</i> can bind multiple Access Points/targets to one Access Point.<br>
           You can do <i>Multi-Binding</i> by a special type of pipe named "<i>N to 1 Pipe</i>", which accepts multiple inputs and generate one output.
            The input sources are connected with "&" and enclosed with "(" and ")".</p>
        <p>Let's learn more from example. We said we would say "Ms." to the ladies in "Greeting" example before, let do it now.</p>
        <p>This time, we need a gender select to get the gender information, then change the .helloString. Note .helloString should be changed when any of gender and name is changed,
        this is the typical case that we need <i>Multi-Binding</i>.</p>
        <script type="text/cbs" id="greetingExampleV4CBS">

            #greetingExampleV4{
                dataContext: /greetingModelV4;

                -> input{
                    value[immediately:1]: name;
                };

                -> .generSelect{
                    value: gender
                };

                -> .helloString{
                    style.display: name> @{return value? "inline-block":"none";};

                    -> b{
                        /*
                            Here we bind text to both name and gender at the same time, and use
                            getFormalTitle to get a proper title
                        */
                        text: (name & gender) > @getFormalTitle;
                    };
                }
            }
        </script>
        <script type="text/javascript" id="greetingExampleV4JS">
            window.greetingModelV4 = {
                name:"", gender:"m",

                //the difference between "N to 1 Pipe" and normal Pipe is the argument "value"
                //In "N to 1 Pipe", it's an array that holds the input values in the same order
                // as the Access Points list before the pipe.
                getFormalTitle: function(value){
                    var names =  value[0].split(" ").filter(function(t){return t});
                    var gender = value[1];
                    return (gender == "m"? "Mr. ": "Ms. ")+ names[names.length-1];
                }
            };
        </script>
        <div class="knot_example" id="greetingExampleV4">
            <h3>Greeting from knot.js (V4)</h3>
            <p>
                <label>Your gender please: </label>
                <select class="generSelect">
                    <option value="m">Male</option>
                    <option value="f">Female</option>
                </select>
            </p>
            <p>
                <label>Your name please: </label>
                <input type="text">
            </p>
            <p class="helloString">
                Hello <b ></b>
            </p>
        </div>

        <div id="greetingExampleV4CodePages" knot-debugger-ignore  knot-component="SourceTabPage"></div>

        <ul>
            <li><span></span></li>
        </ul>
    </div>
</section>

<script type="text/cbs">
    #converterCodePages{
        sourceInfo:/sourceModel.converterCodes
    }
    #validatorCodePages{
        sourceInfo:/sourceModel.validatorCodes
    }
    #greetingExampleV4CodePages{
        sourceInfo:/sourceModel.greetingExampleV4Codes
    }
</script>
<script>
    window.sourceModel = {};
    window.SourceCodeHelper.collectSourceCodes(
        [
            {selector:"#converterCBS",title:"CBS", type:"cbs"},
            {selector:"#converterExampleHTML",title:"HTML", type:"html"},
            {selector:"#converterJS",title:"Javascript", type:"javascript"}
        ],
        function(res){
            window.sourceModel.converterCodes = res;
        });
    window.SourceCodeHelper.collectSourceCodes(
        [
            {selector:"#validatorExampleCBS",title:"CBS", type:"cbs"},
            {selector:"#validatorExampleJS",title:"Javascript", type:"javascript"},
            {selector:"#validatorExample",title:"HTML", type:"html"},
            {selector:"#validatorExampleCSS",title:"CSS", type:"css"}
        ],
        function(res){
            window.sourceModel.validatorCodes = res;
        });

    window.SourceCodeHelper.collectSourceCodes(
        [
            {selector:"#greetingExampleV4CBS",title:"CBS", type:"cbs"},
            {selector:"#greetingExampleV4",title:"HTML", type:"html"},
            {selector:"#greetingExampleV4JS",title:"Javascript", type:"javascript"}
        ],
        function(res){
            window.sourceModel.greetingExampleV4Codes = res;
        });
</script>

<?php
$smarty = \Common::getSmarty();
$smarty->display("footer.tpl");
?>
</body>
</html>