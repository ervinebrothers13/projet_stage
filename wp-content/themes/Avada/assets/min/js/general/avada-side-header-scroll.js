function moveSideHeaderStylingDivs(){var e=jQuery(window).scrollTop(),r=jQuery("#main").offset().top+jQuery("#main").outerHeight(),d=jQuery(".fusion-footer").offset().top+jQuery(".fusion-footer").outerHeight(),i=d,a=fusion.getAdminbarHeight(),o=jQuery(window).height()-a,s=e+o-d,h=jQuery("body").outerHeight(!0)-jQuery("body").height()-jQuery("body").offset().top;"footer_parallax_effect"===avadaSideHeaderVars.footer_special_effects&&(i=r,s=e+o-r),e+o>=i?s<=h?jQuery(".side-header-background-image, .side-header-background-color, .side-header-border").height("calc(100vh - "+a+"px - "+s+"px)"):s>h&&jQuery(".side-header-background-image, .side-header-background-color, .side-header-border").height("calc(100vh - "+a+"px - "+h+"px)"):jQuery(".side-header-background-image, .side-header-background-color, .side-header-border").height("100vh")}function fusionSideHeaderScroll(){var e,r,d=Modernizr.mq("only screen and (min-device-width: 768px) and (max-device-width: 1366px) and (orientation: portrait)")||Modernizr.mq("only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: landscape)"),i=Modernizr.mq("only screen and (max-width:"+avadaSideHeaderVars.side_header_break_point+"px)"),a=avadaSideHeaderVars.footer_special_effects,o="body",s=jQuery("#wrapper").height(),h=jQuery(".side-header-background-image, .side-header-background-color, .side-header-border"),t=jQuery(".fusion-top-frame").is(":visible")?jQuery(window).height()-jQuery(".fusion-top-frame").height()-jQuery(".fusion-bottom-frame").height():jQuery(window).height();!jQuery("body").hasClass("layout-boxed-mode")||jQuery("body").hasClass("fusion-top-header")||jQuery(".fusion-top-frame").is(":visible")?jQuery(".fusion-top-frame").is(":visible")&&(i?(jQuery(".side-header-wrapper").css("paddingTop",""),jQuery(".side-header-wrapper").css("paddingBottom",""),jQuery("#side-header").css("marginTop","")):(jQuery(".side-header-wrapper").css("paddingTop",jQuery(".fusion-top-frame").height()),jQuery(".side-header-wrapper").css("paddingBottom",jQuery(".fusion-bottom-frame").height()+20),jQuery("#side-header").css("marginTop",-jQuery(".fusion-top-frame").height()))):o="#boxed-wrapper",d||"footer_sticky"===a?(jQuery("#side-header").trigger("sticky_kit:detach"),jQuery(".side-header-wrapper").trigger("sticky_kit:detach"),d&&(jQuery(".side-header-background-image, .side-header-background-color, .side-header-border").height(s+"px"),setTimeout(function(){jQuery(".side-header-background-image, .side-header-background-color, .side-header-border").height(jQuery("#wrapper").height()+"px")},1e3))):i?jQuery("#side-header").hasClass("fusion-side-header-sticky")&&(jQuery(".side-header-wrapper, .side-header-background-image, .side-header-background-color, .side-header-border").trigger("sticky_kit:detach"),jQuery("#side-header").removeClass("fusion-side-header-sticky")):(r=!1,jQuery(window).height()<jQuery(".side-header-wrapper").height()&&(r=!0),e=jQuery(".side-header-wrapper").outerHeight(),t>s&&t>e?(e=s>e?s:e,jQuery(".side-header-background-image, .side-header-background-color, .side-header-border").height(e)):(jQuery(".side-header-background-image, .side-header-background-color, .side-header-border").height("100vh"),jQuery(window).height()>jQuery(".side-header-wrapper").height()&&jQuery(window).on("scroll",function(){window.requestAnimationFrame(moveSideHeaderStylingDivs)})),jQuery("#side-header").hasClass("fusion-side-header-sticky")||(jQuery(".side-header-wrapper, .side-header-background-image, .side-header-background-color, .side-header-border").trigger("sticky_kit:detach"),jQuery(".side-header-wrapper, .side-header-background-image, .side-header-background-color, .side-header-border").stick_in_parent({parent:o,sticky_class:"fusion-side-header-stuck",bottoming:r,offset_top:fusion.getAdminbarHeight()}),jQuery("#side-header").addClass("fusion-side-header-sticky"))),"footer_sticky"===a&&(i||(jQuery(".side-header-wrapper").height()>t||jQuery("body").hasClass("layout-boxed-mode")&&jQuery("body").hasClass("side-header-right")?(jQuery("#side-header").css("position","absolute"),h.css("position","fixed")):(jQuery("#side-header").css("position","fixed"),h.css("position","absolute"))))}jQuery(document).ready(function(){fusionSideHeaderScroll(),jQuery(window).on("resize",function(){fusionSideHeaderScroll()})});;