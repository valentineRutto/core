// Arrows module. Loaded in window.onload()
var Arrows = (function() {
    // Private
    var lastSelected = '';
    var tree = null;
    var span = null;
    var max = 0;
    var i = 0;
    var init = false;

    // Public
    return {
        init : function() {
            tree = document.querySelector("#tree");
            if(tree === null)
                return false;
            span = tree.querySelectorAll("span");
            if(span === null || span.length === 0)
                return false;
            max = span.length-1;
            i = 0;
            lastSelected = '';
            init = true;
        },

        up : function(ctrl) {
            if(!init)
                return false;
            if(Selection.Files.length === 0 && Selection.Folders.length === 0 && lastSelected === '')
                i = max; // last element
            else if(i <= 0)
                i = max;
            else
                i--;
            lastSelected = span[i].id;

            if(ctrl === undefined) // remove previous selected element(s)
                Selection.remove();
            Selection.add(lastSelected);
        },

        down : function(ctrl) {
            if(!init)
                return false;
            if(Selection.Files.length === 0 && Selection.Folders.length === 0 && lastSelected === '')
                i = 0; // first element
            else if(i >= max)
                i = 0;
            else
                i++;
            lastSelected = span[i].id;

            if(ctrl === undefined) // remove previous selected element(s)
                Selection.remove();
            Selection.add(lastSelected);
        }
    }
});
