/* =================================
TOOLTIP       
=================================== */
$(window).load(function() {
	// tooltip demo
    $("[data-toggle=tooltip]").tooltip();
    
    // popover
    $("[data-toggle=popover]").popover();
});


/* =================================
===  GMAP                       ====
=================================== */

(function($, window, document){

    // -------------------------
    // Map Style definition
    // -------------------------

    // Custom core styles
    // Get more styles from http://snazzymaps.com/style/29/light-monochrome
    // - Just replace and assign to "MapStyles" the new style array
    var MapStyles = [{featureType:"water",stylers:[{visibility:"on"},{color:"#bdd1f9"}]},{featureType:"all",elementType:"labels.text.fill",stylers:[{color:"#334165"}]},{featureType:"landscape",stylers:[{color:"#e9ebf1"}]},{featureType:"road.highway",elementType:"geometry",stylers:[{color:"#c5c6c6"}]},{featureType:"road.arterial",elementType:"geometry",stylers:[{color:"#fff"}]},{featureType:"road.local",elementType:"geometry",stylers:[{color:"#fff"}]},{featureType:"transit",elementType:"geometry",stylers:[{color:"#d8dbe0"}]},{featureType:"poi",elementType:"geometry",stylers:[{color:"#cfd5e0"}]},{featureType:"administrative",stylers:[{visibility:"on"},{lightness:33}]},{featureType:"poi.park",elementType:"labels",stylers:[{visibility:"on"},{lightness:20}]},{featureType:"road",stylers:[{color:"#d8dbe0",lightness:20}]}];


    // -------------------------
    // Custom Script
    // -------------------------

    var mapSelector = '[data-toggle="gmap"]';

    if($.fn.gMap) {
        var gMapRefs = [];
        
        $(mapSelector).each(function(){
            
            var $this   = $(this),
                addresses = $this.data('address') && $this.data('address').split(';'),
                titles    = $this.data('title') && $this.data('title').split(';'),
                zoom      = $this.data('zoom') || 14,
                maptype   = $this.data('maptype') || 'ROADMAP', // or 'TERRAIN'
                markers   = [];

            if(addresses) {
              for(var a in addresses)  {
                  if(typeof addresses[a] == 'string') {
                      markers.push({
                          address:  addresses[a],
                          html:     (titles && titles[a]) || '',
                          popup:    true   /* Always popup */
                        });
                  }
              }

              var options = {
                  controls: {
                         panControl:         true,
                         zoomControl:        true,
                         mapTypeControl:     true,
                         scaleControl:       true,
                         streetViewControl:  true,
                         overviewMapControl: true
                     },
                  scrollwheel: false,
                  maptype: maptype,
                  markers: markers,
                  zoom: zoom
                  // More options https://github.com/marioestrada/jQuery-gMap
              };

              var gMap = $this.gMap(options);

              var ref = gMap.data('gMap.reference');
              // save in the map references list
              gMapRefs.push(ref);

              // set the styles
              if($this.data('styled') !== undefined) {
                
                ref.setOptions({
                  styles: MapStyles
                });

              }
            }

        }); //each
    }
    
    // Center Map marker on resolution change
    $(window).resize(function() {

        if(gMapRefs && gMapRefs.length) {
            for( var r in gMapRefs) {
              var mapRef = gMapRefs[r];
              var currMapCenter = mapRef.getCenter();
              if(mapRef && currMapCenter) {
                  google.maps.event.trigger(mapRef, "resize");
                  mapRef.setCenter(currMapCenter);
              }
            }
        }
    });


}(jQuery, window, document));






/* =================================
===  UTILITIES                  ====
=================================== */

(function($, window, doc){

    "use strict";
    
    var $html = $("html"), $win = $(window);

    $.support.transition = (function() {

        var transitionEnd = (function() {

            var element = doc.body || doc.documentElement,
                transEndEventNames = {
                    WebkitTransition: 'webkitTransitionEnd',
                    MozTransition: 'transitionend',
                    OTransition: 'oTransitionEnd otransitionend',
                    transition: 'transitionend'
                }, name;

            for (name in transEndEventNames) {
                if (element.style[name] !== undefined) return transEndEventNames[name];
            }
        }());

        return transitionEnd && { end: transitionEnd };
    })();

    $.support.animation = (function() {

        var animationEnd = (function() {

            var element = doc.body || doc.documentElement,
                animEndEventNames = {
                    WebkitAnimation: 'webkitAnimationEnd',
                    MozAnimation: 'animationend',
                    OAnimation: 'oAnimationEnd oanimationend',
                    animation: 'animationend'
                }, name;

            for (name in animEndEventNames) {
                if (element.style[name] !== undefined) return animEndEventNames[name];
            }
        }());

        return animationEnd && { end: animationEnd };
    })();

    $.support.requestAnimationFrame = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.msRequestAnimationFrame || window.oRequestAnimationFrame || function(callback){ window.setTimeout(callback, 1000/60); };
    $.support.touch                 = (
        ('ontouchstart' in window && navigator.userAgent.toLowerCase().match(/mobile|tablet/)) ||
        (window.DocumentTouch && document instanceof window.DocumentTouch)  ||
        (window.navigator['msPointerEnabled'] && window.navigator['msMaxTouchPoints'] > 0) || //IE 10
        (window.navigator['pointerEnabled'] && window.navigator['maxTouchPoints'] > 0) || //IE >=11
        false
    );
    $.support.mutationobserver      = (window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver || null);

    $.Utils = {};

    $.Utils.debounce = function(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    };

    $.Utils.removeCssRules = function(selectorRegEx) {
        var idx, idxs, stylesheet, _i, _j, _k, _len, _len1, _len2, _ref;

        if(!selectorRegEx) return;

        setTimeout(function(){
            try {
              _ref = document.styleSheets;
              for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                stylesheet = _ref[_i];
                idxs = [];
                stylesheet.cssRules = stylesheet.cssRules;
                for (idx = _j = 0, _len1 = stylesheet.cssRules.length; _j < _len1; idx = ++_j) {
                  if (stylesheet.cssRules[idx].type === CSSRule.STYLE_RULE && selectorRegEx.test(stylesheet.cssRules[idx].selectorText)) {
                    idxs.unshift(idx);
                  }
                }
                for (_k = 0, _len2 = idxs.length; _k < _len2; _k++) {
                  stylesheet.deleteRule(idxs[_k]);
                }
              }
            } catch (_error) {}
        }, 0);
    };

    $.Utils.isInView = function(element, options) {

        var $element = $(element);

        if (!$element.is(':visible')) {
            return false;
        }

        var window_left = $win.scrollLeft(),
            window_top  = $win.scrollTop(),
            offset      = $element.offset(),
            left        = offset.left,
            top         = offset.top;

        options = $.extend({topoffset:0, leftoffset:0}, options);

        if (top + $element.height() >= window_top && top - options.topoffset <= window_top + $win.height() &&
            left + $element.width() >= window_left && left - options.leftoffset <= window_left + $win.width()) {
          return true;
        } else {
          return false;
        }
    };

    $.Utils.options = function(string) {

        if ($.isPlainObject(string)) return string;

        var start = (string ? string.indexOf("{") : -1), options = {};

        if (start != -1) {
            try {
                options = (new Function("", "var json = " + string.substr(start) + "; return JSON.parse(JSON.stringify(json));"))();
            } catch (e) {}
        }

        return options;
    };

    $.Utils.events       = {};
    $.Utils.events.click = $.support.touch ? 'tap' : 'click';

    $.langdirection = $html.attr("dir") == "rtl" ? "right" : "left";

    $(function(){

        // Check for dom modifications
        if(!$.support.mutationobserver) return;

        // Install an observer for custom needs of dom changes
        var observer = new $.support.mutationobserver($.Utils.debounce(function(mutations) {
            $(doc).trigger("domready");
        }, 300));

        // pass in the target node, as well as the observer options
        observer.observe(document.body, { childList: true, subtree: true });

    });

    // add touch identifier class
    $html.addClass($.support.touch ? "touch" : "no-touch");

}(jQuery, window, document));


