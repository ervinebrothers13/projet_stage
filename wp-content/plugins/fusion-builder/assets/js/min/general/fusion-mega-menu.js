var fusionNavMegamenuPosition=function(e){var n=jQuery(e),o=n.parents("nav"),u=o.hasClass("direction-column")?"column":"row";o.hasClass("submenu-mode-flyout")||(o.hasClass("collapse-enabled")?n.find(".fusion-megamenu-wrapper").each(function(e,n){jQuery(n).css("left",0)}):n.find(".fusion-megamenu-wrapper")&&n.parents(".fusion-menu-element-wrapper").length&&(n.find(".fusion-megamenu-wrapper").each(function(e,n){var i,s,a,t,r,f,l,d,m=jQuery(n),w=jQuery(n).closest("li.fusion-megamenu-menu"),c=jQuery(n).find(".fusion-megamenu-holder"),h=jQuery(n).closest(".fusion-row"),g=jQuery("body").hasClass("rtl");"row"===u?m.hasClass("fusion-megamenu-fullwidth")?(g&&m.css("right","auto"),window.avadaScrollBarWidth=window.avadaGetScrollBarWidth(),window.avadaScrollBarWidth&&m.css("width","calc("+c.width()+" - "+window.avadaGetScrollBarWidth()+"px)"),m.offset({left:(jQuery(window).width()-window.avadaGetScrollBarWidth()-m.outerWidth())/2})):h.length&&(r=h.width(),d=(l=void 0!==(f=h.offset())?f.left:0)+r,i=w.offset(),t=m.outerWidth(),s=i.left+w.outerWidth(),a=0,!g&&i.left+t>d?(a=t===jQuery(window).width()?-1*i.left:t>r?l-i.left+(r-t)/2:-1*(i.left-(d-t)),m.css("left",a)):g&&s-t<l&&(a=t===jQuery(window).width()?s-t:t>r?s-d+(r-t)/2:-1*(t-(s-l)),m.css("right",a))):(m.css("top",0),m.css(o.hasClass("expand-left")?"right":"left","100%"))}),setTimeout(function(){o.removeClass("mega-menu-loaded")},50)))},fusionMegaMenuNavRunAll=function(){var e=jQuery(".fusion-menu-element-wrapper.expand-method-hover:not(.submenu-mode-flyout) .fusion-megamenu-menu");e.each(function(){fusionNavSubmenuDirection(this)}),e.on("mouseenter focusin",function(){fusionNavMegamenuPosition(this)}),jQuery(window).trigger("fusion-position-menus")},fusionMegaMenuLoad=function(){jQuery(this).removeClass("mega-menu-loading").addClass("mega-menu-loaded").off("mouseenter focusin",fusionMegaMenuLoad),fusionMegaMenuNavRunAll()};jQuery(".fusion-menu-element-wrapper").on("mouseenter focusin",fusionMegaMenuLoad),jQuery(window).on("fusion-element-render-fusion_menu",function(){jQuery(".fusion-menu-element-wrapper").on("mouseenter focusin",fusionMegaMenuLoad)}),jQuery(window).on("fusion-resize-horizontal fusion-position-menus",function(){jQuery("nav.fusion-menu-element-wrapper .fusion-megamenu-wrapper").each(function(e,n){fusionNavMegamenuPosition(jQuery(n).parent())})});;