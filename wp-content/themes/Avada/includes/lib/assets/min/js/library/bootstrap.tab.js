!function(t){"use strict";var a=function(a){this.element=t(a)};a.prototype.show=function(){var a=this.element,e=a.closest("ul:not(.dropdown-menu)"),n=a.data("target");if(n||(n=(n=a.attr("href"))&&n.replace(/.*(?=#[^\s]*$)/,"")),!a.parent("li").hasClass("active")){var i=e.find(".active:last a")[0],s=t.Event("show.bs.tab",{relatedTarget:i});if(a.trigger(s),!s.isDefaultPrevented()){var r=t(document).find(n);this.activate(a.parent("li"),e),this.activate(r,r.parent(),function(){a.trigger({type:"shown.bs.tab",relatedTarget:i})})}}},a.prototype.activate=function(a,e,n){var i=e.find("> .active"),s=n&&t.support.transition&&i.hasClass("fade");function r(){i.removeClass("active").find("> .dropdown-menu > .active").removeClass("active"),a.addClass("active"),a.parent(".nav-tabs").length&&a.parents(".fusion-tabs").find(".nav").find('a[href="'+a.find("a").attr("href")+'"]').parent().addClass("active"),s?(a[0].offsetWidth,a.addClass("in")):a.removeClass("fade"),a.parent(".dropdown-menu")&&a.closest("li.dropdown").addClass("active"),a.parents(".fusion-builder-live-editor").length&&void 0!==a.attr("id")&&a.parents(".fusion-tabs").find('.tab-link[href="#'+a.attr("id")+'"]').parents("li").addClass("active"),n&&n()}s?i.one(t.support.transition.end,r).emulateTransitionEnd(150):r(),i.removeClass("in")};var e=t.fn.tab;t.fn.tab=function(e){return this.each(function(){var n=t(this),i=n.data("bs.tab");i||n.data("bs.tab",i=new a(this)),"string"==typeof e&&i[e]()})},t.fn.tab.Constructor=a,t.fn.tab.noConflict=function(){return t.fn.tab=e,this},t(document).on("click.bs.tab.data-api",'[data-toggle="tab"], [data-toggle="pill"]',function(a){a.preventDefault(),t(this).tab("show")})}(jQuery);;