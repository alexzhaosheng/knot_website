/*
   tagEditor put the editor HTML and relevant CBS options in tagEditor.pkg.cbs, which is marked as private.
   The HTML in private CBS is referenced as a template
   TagEditor creates the UI and adds it to it's owner, then bind the UI to it self. It works like a "proxy"
   It receives the tags string, parse it into separated tags so that UI can present them correctly.
   And when user changes the tags, TagEditor notify system and generate the new tags string
* */
(function (global) {
    "use strict";

    //register the factory method to knot.js
    global.Knot.Advanced.registerComponent("TagEditor", function(node, componentName){
        return new TagEditor(node);
    });

    var TagEditor = function(owner){
        //tagColor is bound to the style.backgroundColor of the tag by CBS
        this.tagColor = "";
        //tags in array. will be bound to UI to generate the tags elements
        this.tags = [];
        //create the HTML element of the tag editing UI from template.
        this.editorElement = global.Knot.Advanced.createFromTemplate("knot-example-tagEditor", this, owner);
        //bind the component object it-self to the UI. When any change happens from the Access Point of the component
        //it just need to update the relevant values, then knot.js will update UI.
        global.Knot.Advanced.setDataContext(this.editorElement, this, true);

        //add the UI element to the owner.
        $(owner).append(this.editorElement);
    };

    var p =TagEditor.prototype;
    //component interface
    p.setValue = function(apDescription, value, options) {
        if(apDescription === "tags") {
            if(!value){
                this.tags = [];
            }
            else{
                var that = this;
                this.tags = value.split(",").map(function(t){return that.createTagObj(t);});
            }
        }
        else if(apDescription === "tagColor"){
            this.tagColor = value;
            this.tags.forEach(function(t){t.tagColor=value;})
        }
    };
    //component interface
    p.getValue = function(apDescription, options) {
        return this.tags.map(function(t){return t.name;}).join(",");
    };
    //component interface
    p.doesSupportMonitoring = function (apDescription) {
        //only Access Point "tags" support monitoring.
        return apDescription === "tags";
    };
    //component interface
    p.monitor = function(apDescription, callback, options){
        //store the changed callbacks, call these callbacks when the tag is changed.
        if(!this.changedCallback){
            this.changedCallback = [];
        }
        this.changedCallback.push(callback);
    };
    //component interface
    p.stopMonitoring = function (apDescription, callback, options) {
        this.changedCallback.splice( this.changedCallback.indexOf(callback), 1);
    };
    //component interface
    p.dispose = function(){
        //clear knot binding for the editor UI element
        Knot.clear(this.editorElement);
        //remove the editor UI element from it's owner.
        $(this.editorElement).remove();
    }

    p.raiseChangedEvent = function(){
        if(this.changedCallback){
            for(var i=0; i<this.changedCallback.length; i++){
                this.changedCallback[i]();
            }
        }
    };

    p.deleteTag = function (tag) {
        if(this.tags.indexOf(tag) >= 0) {
            this.tags.splice(this.tags.indexOf(tag), 1);
            this.raiseChangedEvent();
        }
    };
    p.onAdd = function (arg, node) {
        var input  = $(node).closest(".knot-example-tagEditor").find("input");
        var that = this;
        this.tags = this.tags.concat(input.val().split(",").map(function(t){return that.createTagObj(t);}));
        input.val("");
        this.raiseChangedEvent();
    };

    p.createTagObj = function(tag){
        return {name:tag, tagColor: this.tagColor};
    }

    //register this function to knot global scope. It can be accessed with prefix "__knot_global."
    //in CBS. It's attached to the @click event of the "close" button on tag.
    global.Knot.Advanced.registerNamedGlobalSymbol("onDeleteTag", function (evt, node) {
        var editor = $(node).closest(".knot-example-tagEditor");
        if(editor.length>0) {
            Knot.getDataContext(editor[0]).deleteTag(this);
        }
    });

})(window);