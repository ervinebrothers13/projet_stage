function getVariationsValues(t){var a=0,e=0;return jQuery(t).find(".variations").find("select").each(function(){0<(jQuery(this).val()||"").length&&e++,a++}),{variations:a,chosen:e}}function variationsChange(t,a,e){var i,r,o,n,s,l,c,d,u,g=window.sources,_=getVariationsValues(e);if(i=void 0!==a&&a.image&&a.image.gallery_thumbnail_src&&1<a.image.gallery_thumbnail_src.length?a.image.gallery_thumbnail_src:g[0],_.variations!==_.chosen)return jQuery(e).trigger("update_variation_values"),jQuery(e).trigger("reset_data"),i=g[0],void variationsImageReset(t);void 0!==a&&a.image&&a.image.src&&1<a.image.src.length&&!a.is_composited&&(n=(o=(r=t.closest(".woocommerce-product-gallery")).children(".flex-viewport")).find(".fusion-main-image").length?o.find(".fusion-main-image"):o.find(".woocommerce-product-gallery__image"),s=n.find(".wp-post-image"),l=n.find("a").eq(0),c=n.find("> img"),d=n.find(".avada-product-gallery-lightbox-trigger"),u=r.find(".fusion-main-image-thumb"),t.filter('[data-o_src="'+a.image.gallery_thumbnail_src+'"]').length&&variationsImageReset(t),-1<jQuery.inArray(a.image.gallery_thumbnail_src,g)&&s.attr("src")===a.image.src||t.each(function(){jQuery(this).hasClass("fusion-main-image-thumb")?(jQuery(this).attr("src",i),jQuery(this).parent().trigger("click"),_.variations===_.chosen?(s.wc_set_variation_attr("src",a.image.src),s.wc_set_variation_attr("height",a.image.src_h),s.wc_set_variation_attr("width",a.image.src_w),s.wc_set_variation_attr("srcset",a.image.srcset),s.wc_set_variation_attr("sizes",a.image.sizes),s.wc_set_variation_attr("title",a.image.title),s.wc_set_variation_attr("alt",a.image.alt),s.wc_set_variation_attr("data-src",a.image.full_src),s.wc_set_variation_attr("data-large_image",a.image.full_src),s.wc_set_variation_attr("data-large_image_width",a.image.full_src_w),s.wc_set_variation_attr("data-large_image_height",a.image.full_src_h),l.wc_set_variation_attr("href",a.image.full_src),c.wc_set_variation_attr("src",a.image.full_src),d.wc_set_variation_attr("href",a.image.src),void 0!==a.image.title&&(d.wc_set_variation_attr("data-title",a.image.title),d.data("title",a.image.title)),void 0!==a.image.caption&&(d.wc_set_variation_attr("data-caption",a.image.caption),d.data("caption",a.image.caption)),u.wc_set_variation_attr("src",a.image.gallery_thumbnail_src)):variationsImageReset(t)):jQuery(this).attr("src",g[jQuery(this).data("index")])})),window.avadaLightBox.refresh_lightbox(),setTimeout(function(){window.avadaLightBox.refresh_lightbox()},500),setTimeout(function(){window.avadaLightBox.refresh_lightbox()},1500)}function variationsImageReset(t){var a=t.closest(".woocommerce-product-gallery"),e=a.children(".flex-viewport"),i=e.find(".fusion-main-image").length?e.find(".fusion-main-image"):e.find(".woocommerce-product-gallery__image"),r=i.find(".wp-post-image"),o=i.find("a").eq(0),n=i.find("> img"),s=i.find(".avada-product-gallery-lightbox-trigger"),l=a.find(".fusion-main-image-thumb");r.wc_reset_variation_attr("src"),r.wc_reset_variation_attr("width"),r.wc_reset_variation_attr("height"),r.wc_reset_variation_attr("srcset"),r.wc_reset_variation_attr("sizes"),r.wc_reset_variation_attr("title"),r.wc_reset_variation_attr("alt"),r.wc_reset_variation_attr("data-src"),r.wc_reset_variation_attr("data-large_image"),r.wc_reset_variation_attr("data-large_image_width"),r.wc_reset_variation_attr("data-large_image_height"),o.wc_reset_variation_attr("href"),n.wc_reset_variation_attr("src"),s.wc_reset_variation_attr("href"),s.wc_reset_variation_attr("data-title"),s.wc_reset_variation_attr("data-caption"),void 0!==s.attr("data-o_data-title")&&s.data("title",s.attr("data-o_data-title")),void 0!==s.attr("data-o_data-caption")&&s.data("titcaptionle",s.attr("data-o_data-caption")),l.wc_reset_variation_attr("src"),window.avadaLightBox.refresh_lightbox(),setTimeout(function(){window.avadaLightBox.refresh_lightbox()},500),setTimeout(function(){window.avadaLightBox.refresh_lightbox()},1500)}function initAvadaWoocommerProductGallery(){jQuery(".avada-product-gallery").each(function(){var t,a=jQuery(this),e=a.closest(".avada-single-product-gallery-wrapper"),i=a.find(".flex-control-thumbs"),r=i.find("img").length?i.find("img"):void 0;window.sources=[],void 0!==r?r.each(function(t){jQuery(this).data("index",t),window.sources.push(jQuery(this).attr("src"))}):window.sources.push(a.find(".flex-viewport .flex-active-slide").data("thumb")),e.find(".flex-viewport").append(a.find(".flex-direction-nav")),(e.hasClass("avada-product-images-thumbnails-top")||e.hasClass("avada-product-images-thumbnails-right")||e.hasClass("avada-product-images-thumbnails-left"))&&(e.children(".onsale").length&&e.find(".flex-viewport").prepend(e.children(".onsale")),e.children(".fusion-woo-badges-wrapper").length&&e.find(".flex-viewport").prepend(e.children(".fusion-woo-badges-wrapper"))),(e.hasClass("avada-product-images-thumbnails-top")||e.hasClass("avada-product-images-thumbnails-bottom"))&&(sizeGalleryThumbnails(a),jQuery(window).on("resize",function(){sizeGalleryThumbnails(a)}),a.on("click touchstart",".flex-control-thumbs li",function(){var t=jQuery(this);moveProductImageThumbs(a,t,"next")}),a.find(".flex-direction-nav li a").on("click touchstart",function(){var t=jQuery(this).parents(".avada-product-gallery").find(".flex-control-thumbs img.flex-active");t.offset().left+t.outerWidth()>a.offset().left+a.outerWidth()&&(jQuery(this).hasClass("flex-next")?moveProductImageThumbs(a,t,"next"):moveProductImageThumbs(a,t,"prev"))}),t=Math.max.apply(null,i.find("li").map(function(){return jQuery(this).height()}).get()),jQuery(".woocommerce-product-gallery__image").css("min-height",""),i.animate({opacity:1},500),i.wrap('<div class="avada-product-gallery-thumbs-wrapper"></div>'),i.parent().css("height",t)),jQuery(window).trigger("resize")})}function sizeGalleryThumbnails(t){var a,e=t.width(),i=t.find(".flex-control-thumbs li"),r=t.data("columns"),o=i.length;a=(e-8*(r-1))/r,i.css("width",a),t.find(".flex-control-thumbs").css("width",o*a+8*(o-1)+"px")}function moveProductImageThumbs(t,a,e){var i,r,o=t.find(".flex-control-thumbs"),n=o.find("li"),s=t.data("columns"),l=o.find("li").outerWidth(),c=t.offset().left,d=Math.floor((a.offset().left-c)/l),u=[];n.length>s&&("next"===e?(d<n.length-(d+1)?i=-1*a.position().left:(r=n.length-s,i=-1*jQuery(n.get(r)).position().left),o.stop(!0,!0).animate({left:i},{queue:!1,duration:500,easing:"easeInOutQuad",complete:function(){jQuery(this).find("li").each(function(){u.push(jQuery(this).offset().left)}),jQuery(this).find("li").each(function(t){u[t]<c&&jQuery(this).appendTo(o)}),jQuery(this).css("left","0")}})):(i=-1*(l+8),a.parent().prependTo(o),o.css("left",i),o.stop(!0,!0).animate({left:0},{queue:!1,duration:500,easing:"easeInOutQuad"})))}jQuery(window).on("load fusion-element-render-fusion_tb_woo_product_images fusion-reinit-single-post-slideshow",function(t){var a,e,i;"fusion-element-render-fusion_tb_woo_product_images"!==t.type&&"fusion-reinit-single-post-slideshow"!==t.type||"function"!=typeof jQuery.fn.wc_product_gallery||jQuery(".woocommerce-product-gallery").each(function(){var t=jQuery(this).closest(".fusion-woo-product-images");t.length&&(wc_single_product_params.zoom_enabled=parseInt(t.attr("data-zoom_enabled")),wc_single_product_params.photoswipe_enabled=parseInt(t.attr("data-photoswipe_enabled"))),jQuery(this).trigger("wc-product-gallery-before-init",[this,wc_single_product_params]),jQuery(this).wc_product_gallery(wc_single_product_params),jQuery(this).trigger("wc-product-gallery-after-init",[this,wc_single_product_params])}),jQuery(".avada-product-gallery").length&&(jQuery("body").on("click",".woocommerce-product-gallery__image .zoomImg",function(){if("ontouchstart"in document.documentElement||navigator.msMaxTouchPoints)return(i=jQuery(this).siblings(".avada-product-gallery-lightbox-trigger")).hasClass("hover")?(i.removeClass("hover"),i.trigger("click"),!1):(jQuery(".woocommerce-product-gallery__image").find(".avada-product-gallery-lightbox-trigger").removeClass("hover"),i.addClass("hover"),!0);jQuery(this).siblings(".avada-product-gallery-lightbox-trigger").trigger("click")}),jQuery("body").on("click",function(t){jQuery(t.target).hasClass("woocommerce-product-gallery__image")||jQuery(".avada-product-gallery-lightbox-trigger").removeClass("hover")}),setTimeout(function(){initAvadaWoocommerProductGallery()},100),a=jQuery(".flex-control-nav").find("img").length?jQuery(".flex-control-nav").find("img"):jQuery('<img class="fusion-main-image-thumb">').attr("src",jQuery(".flex-viewport").find(".flex-active-slide").data("thumb")),jQuery(".flex-viewport").find(".flex-active-slide").addClass("fusion-main-image"),jQuery(".flex-control-nav").find("li:eq(0) img").addClass("fusion-main-image-thumb"),"load"===t.type&&"undefined"==typeof wc_additional_variation_images_local&&setTimeout(function(){jQuery("body").find(".variations_form .variations select").trigger("change.wc-variation-form")},100),jQuery("body").on("found_variation.wc-variation-form",".variations_form",function(t,i){e=i,!1===jQuery(this).data("product_variations")&&variationsChange(a,e,jQuery(this))}),!1!==jQuery(".variations_form").data("product_variations")&&jQuery("body").on("change.wc-variation-form",".variations_form .variations select",function(){variationsChange(a,e,jQuery(this).closest(".variations_form"))}))}),jQuery(function(){jQuery(".avada-product-gallery").find(".clone").find(".avada-product-gallery-lightbox-trigger").addClass("fusion-no-lightbox").removeAttr("data-rel"),setTimeout(function(){jQuery(".woocommerce-product-gallery__trigger").empty()},10)});;