jQuery(window).on("load",function(){(cssua.ua.mobile||cssua.ua.tablet_pc)&&jQuery(".fusion-popover, .fusion-tooltip").each(function(){jQuery(this).attr("data-trigger","click"),jQuery(this).data("trigger","click")}),jQuery('[data-toggle~="popover"]').popover({container:"body",content:function(){return jQuery.parseHTML("<div>"+(void 0!==jQuery(this).attr("data-html-content")?jQuery(this).attr("data-html-content"):"")+"</div>")},html:!0})}),jQuery(window).on("fusion-element-render-fusion_text fusion-element-render-fusion_popover",function(t,e){jQuery('div[data-cid="'+e+'"]').find('[data-toggle~="popover"]').popover({container:"body",content:function(){return jQuery.parseHTML("<div>"+(void 0!==jQuery(this).attr("data-html-content")?jQuery(this).attr("data-html-content"):"")+"</div>")},html:!0})});;