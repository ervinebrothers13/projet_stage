!function(n){"use strict";n.fn.awbAnimateProgressBar=function(){n.each(fusion.getObserverSegmentation(n(this)),function(e){var r=fusion.getAnimationIntersectionData(e),t=new IntersectionObserver(function(e,r){n.each(e,function(e,i){fusion.shouldObserverEntryAnimate(i,r)&&(n(i.target).find(".progress").css("width",function(){return n(this).attr("aria-valuenow")+"%"}),t.unobserve(i.target))})},r);n(this).each(function(){t.observe(this)})})}}(jQuery),jQuery(window).on("load fusion-element-render-fusion_progress",function(n,e){(void 0!==e?jQuery('div[data-cid="'+e+'"]').find(".fusion-progressbar"):jQuery(".fusion-progressbar")).awbAnimateProgressBar()});;