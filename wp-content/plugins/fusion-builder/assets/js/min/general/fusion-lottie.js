!function(t){"use strict";t(window).on("load fusion-element-render-fusion_lottie",function(n,e){var o=void 0!==e?t('div[data-cid="'+e+'"]').find(".fusion-lottie-animation"):t(".fusion-lottie-animation");void 0!==window.bodymovin&&o.each(function(){var n=t(this),e=Boolean(parseInt(n.attr("data-loop"))),o=Boolean(parseInt(n.attr("data-reverse"))),a=parseFloat(n.attr("data-speed")),i=n.attr("data-path"),r=n.attr("data-trigger"),s=(n.attr("data-offset"),window.bodymovin.loadAnimation({container:t(this)[0],autoplay:!1,renderer:"svg",loop:e,path:i}));n.off(),s.addEventListener("DOMLoaded",function(){1!==a&&s.setSpeed(a),o&&(s.goToAndStop(s.getDuration(!0)-1,!0),s.setDirection(-1)),"none"===r?s.play():"click"===r?n.on("click",function(){s.play()}):"hover"===r?(n.on("mouseenter",function(){s.play()}),n.on("mouseleave",function(){s.pause()})):t.each(fusion.getObserverSegmentation(n),function(n){var e=fusion.getAnimationIntersectionData(n),o=new IntersectionObserver(function(n,e){t.each(n,function(t,n){fusion.shouldObserverEntryAnimate(n,e)&&(s.play(),o.unobserve(n.target))})},e);t(this).each(function(){o.observe(this)})})})})})}(jQuery);;