ko.bindingHandlers.datepicker = {
    init: function(element, valueAccessor, allBindingsAccessor) {
        //initialize datepicker with some optional options
        var options = allBindingsAccessor().datepickerOptions || {};
        $(element).datepicker(options);

        //handle the field changing
        ko.utils.registerEventHandler(element, "change", function () {
            var observable = valueAccessor();
            observable($(element).datepicker("getDate"));
        });

        //handle disposal (if KO removes by the template binding)
        ko.utils.domNodeDisposal.addDisposeCallback(element, function() {
            $(element).datepicker("destroy");
        });

    },
    update: function(element, valueAccessor) {
        var value = ko.utils.unwrapObservable(valueAccessor());

        //handle date data coming via json from Microsoft
        if (String(value).indexOf('/Date(') == 0) {
            value = new Date(parseInt(value.replace(/\/Date\((.*?)\)\//gi, "$1")));
        }

        current = $(element).datepicker("getDate");

        if (value - current !== 0) {
            $(element).datepicker("setDate", value);
        }
    }
};

ko.bindingHandlers.initializeValue = {
    init: function (element, valueAccessor) {
        var value = valueAccessor();
        if (ko.isObservable(value)) {
             value(element.value);   
        }
    }
};

ko.bindingHandlers.nicedit = {
    init: function(element, valueAccessor) {
        var value = valueAccessor();
        var area = new nicEditor({fullPanel : true}).panelInstance(element.id, {hasPanel : true});
        $(element).text(ko.utils.unwrapObservable(value)); 

        // function for updating the right element whenever something changes
        var textAreaContentElement = $($(element).prev()[0].childNodes[0]);
        var areachangefc = function() {
            value(textAreaContentElement.html());
        };

        // Make sure we update on both a text change, and when some HTML has been added/removed
        // (like for example a text being set to "bold")
        $(element).prev().keyup(areachangefc);
        $(element).prev().bind('DOMNodeInserted DOMNodeRemoved', areachangefc);
    },
    update: function(element, valueAccessor) {
        var value = valueAccessor();
        var textAreaContentElement = $($(element).prev()[0].childNodes[0]);
        //textAreaContentElement.html(value());
    }
};

ko.bindingHandlers['class'] = {
	init: function(element, valueAccessor) {
        var currentValue = ko.utils.unwrapObservable(valueAccessor()),
            prevValue = element['__ko__previousClassValue__'],
            
            // Handles updating adding/removing classes
            addOrRemoveClasses = function (singleValueOrArray, shouldHaveClass) {
                if (Object.prototype.toString.call(singleValueOrArray) === '[object Array]') {          
                    ko.utils.arrayForEach(singleValueOrArray, function (cssClass) {
                      var value = ko.utils.unwrapObservable(cssClass);
                      ko.utils.toggleDomNodeCssClass(element, value, shouldHaveClass);
                    });
                } else if (singleValueOrArray) {
                    ko.utils.toggleDomNodeCssClass(element, singleValueOrArray, shouldHaveClass);
                }
            };
        
        // Remove old value(s) (preserves any existing CSS classes)
        addOrRemoveClasses(prevValue, false);
        
        // Set new value(s)
        addOrRemoveClasses(currentValue, true);
        
        // Store a copy of the current value
        element['__ko__previousClassValue__'] = currentValue.concat();		
	},
    update: function (element, valueAccessor) {
        var currentValue = ko.utils.unwrapObservable(valueAccessor()),
            prevValue = element['__ko__previousClassValue__'],
            
            // Handles updating adding/removing classes
            addOrRemoveClasses = function (singleValueOrArray, shouldHaveClass) {
                if (Object.prototype.toString.call(singleValueOrArray) === '[object Array]') {          
                    ko.utils.arrayForEach(singleValueOrArray, function (cssClass) {
                      var value = ko.utils.unwrapObservable(cssClass);
                      ko.utils.toggleDomNodeCssClass(element, value, shouldHaveClass);
                    });
                } else if (singleValueOrArray) {
                    ko.utils.toggleDomNodeCssClass(element, singleValueOrArray, shouldHaveClass);
                }
            };
        
        // Remove old value(s) (preserves any existing CSS classes)
        addOrRemoveClasses(prevValue, false);
        
        // Set new value(s)
        addOrRemoveClasses(currentValue, true);
        
        // Store a copy of the current value
        element['__ko__previousClassValue__'] = currentValue.concat();
    }
};

/*
ko.bindingHandlers.masked = {
    init: function(element, valueAccessor, allBindingsAccessor) {
        var mask = allBindingsAccessor().mask || {};
        $(element).mask(mask);
        ko.utils.registerEventHandler(element, 'focusout', function() {
            var observable = valueAccessor();
            observable($(element).val());
        });
    }, 
    update: function (element, valueAccessor) {
        var value = ko.utils.unwrapObservable(valueAccessor());
        $(element).val(value);
    }
};
*/
ko.bindingHandlers.masked = {

    update: function (element, valueAccessor, allBindingsAccessor) {
		var mask = allBindingsAccessor().mask || {};
        $(element).mask(mask);
        ko.utils.registerEventHandler(element, 'focusout', function() {
            var observable = valueAccessor();
            observable($(element).val());
        });
		
        var value = ko.utils.unwrapObservable(valueAccessor());
        $(element).val(value);
    }
};

ko.bindingHandlers.scroll = {

  updating: true,

  init: function(element, valueAccessor, allBindingsAccessor) {
      var self = this
      self.updating = true;
      ko.utils.domNodeDisposal.addDisposeCallback(element, function() {
            $(window).off("scroll.ko.scrollHandler")
            self.updating = false
      });
  },

  update: function(element, valueAccessor, allBindingsAccessor){
    var props = allBindingsAccessor().scrollOptions
    var offset = props.offset ? props.offset : "0"
    var loadFunc = props.loadFunc
    var load = ko.utils.unwrapObservable(valueAccessor());
    var self = this;

    if(load){
      element.style.display = "";
      $(window).on("scroll.ko.scrollHandler", function(){
        if(($(document).height() - offset <= $(window).height() + $(window).scrollTop())){
          if(self.updating){
            loadFunc()
            self.updating = false;
          }
        }
        else{
          self.updating = true;
        }
      });
    }
    else{
        element.style.display = "none";
        $(window).off("scroll.ko.scrollHandler")
        self.updating = false
    }
  }
 }

ko.bindingHandlers.bootstrapPopover = {
    init: function(element, valueAccessor, allBindingsAccessor, viewModel) {
        var options = ko.utils.unwrapObservable(valueAccessor());
        var defaultOptions = {"trigger": "hover"};        
        options = $.extend(true, {}, defaultOptions, options);
        $(element).popover(options);
    }
};