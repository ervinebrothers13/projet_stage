var $youtubeBGVideos={};function _fbRowGetAllElementsWithAttribute(e){var t,i,o=[],a=document.getElementsByTagName("*");for(t=0,i=a.length;t<i;t++)a[t].getAttribute(e)&&!jQuery(a[t]).parents(".tfs-slider").length&&o.push(a[t]);return o}function _fbRowOnPlayerReady(e){var t,i,o=e.target,a=0,n=!0;o.playVideo(),o.isMute&&o.mute(),0!==jQuery("[data-youtube-video-id="+o.getVideoData().video_id+"]").data("loop")&&(t=o.getCurrentTime(),i=+new Date/1e3,o.loopInterval=setInterval(function(){void 0!==o.loopTimeout&&clearTimeout(o.loopTimeout),t===o.getCurrentTime()?a=t+(+new Date/1e3-i):(a=o.getCurrentTime(),i=+new Date/1e3),t=o.getCurrentTime(),a+(n?.45:.21)>=o.getDuration()&&(o.pauseVideo(),o.seekTo(0),o.playVideo(),n=!1)},150))}function _fbRowOnPlayerStateChange(e){e.data===YT.PlayerState.ENDED?(void 0!==e.target.loopTimeout&&clearTimeout(e.target.loopTimeout),0!==jQuery("[data-youtube-video-id="+e.target.getVideoData().video_id+"]").data("loop")&&e.target.seekTo(0)):e.data===YT.PlayerState.PLAYING&&jQuery(e.target.getIframe()).parent().css("opacity","1")}function resizeVideo(e){var t,i,o,a,n,d,r,s,u,f,v,c,m,l,p,y=e.parent();y.find("iframe").hasClass("fusion-hidden")&&y.find("iframe").attr("data-privacy-src")||(null!==y.find("iframe").width()?((t=e).css({width:"auto",height:"auto",left:"auto",top:"auto"}),t.css("position","absolute"),l=y.find("> div").data("display"),a=y.width(),n=y.height(),i=y.outerWidth(),o=y.outerHeight(),s=[16,9],void 0!==e.attr("data-video-aspect-ratio")&&-1!==e.attr("data-video-aspect-ratio").indexOf(":")&&((s=e.attr("data-video-aspect-ratio").split(":"))[0]=parseFloat(s[0]),s[1]=parseFloat(s[1])),r=o,d=s[0]/s[1]*o,"contain"===l?(y.css("paddingTop",y.parent("li").find(".slide-content-container").css("paddingTop")),r>=o&&(u=o,f=s[0]/s[1]*o),f>=i&&(f=i,u=s[1]/s[0]*i)):d>=i&&r>=o?(u=o,f=s[0]/s[1]*o):(f=i,u=s[1]/s[0]*i),v=-(u-n)/2,y.hasClass("fusion-flex-container")?(c="auto",m="auto"):(c=-(f-a)/2,m="0"),1>y.find(".fusion-video-cover").length&&y.find("iframe").parent().prepend('<div class="fusion-video-cover">&nbsp;</div>'),y.is(":visible")&&(y.find(".fusion-video-cover").css({"z-index":0,width:f,height:u,position:"absolute"}),p="iframe",y.hasClass("video-background")&&(p="iframe.fusion-container-video-bg"),jQuery("body").hasClass("rtl")?y.find(p).parent().css({marginRight:c,marginLeft:m,marginTop:v}):y.find(p).parent().css({marginRight:m,marginLeft:c,marginTop:v}),y.find(p).css({width:f,height:u,"z-index":-1}))):setTimeout(function(){resizeVideo(e)},500))}function vimeoReady(e){var t,i=jQuery("#"+e).parents("[data-vimeo-video-id]").first();("function"!=typeof fusionGetConsent||fusionGetConsent("vimeo"))&&(t=new Vimeo.Player(e),"yes"===i.data("mute")&&t.setVolume(0),"no"===i.data("mute")&&t.setVolume(1),t.on("timeupdate",function(e){i.css("opacity","1"),t.off("timeupdate")}),jQuery("#"+e).attr("data-privacy-src")&&resizeVideo(i))}function fusionInitVimeoPlayers(){var e,t,i,o,a;if(("function"!=typeof fusionGetConsent||fusionGetConsent("vimeo"))&&Number(fusionVideoBgVars.status_vimeo)&&0<(e=jQuery("[data-vimeo-video-id]")).length)for(i=(t=e.find('> iframe, iframe[data-privacy-type="vimeo"]')).length,a=0;a<i;a++)o=t[a],"function"==typeof vimeoReady&&vimeoReady(o.getAttribute("id"))}jQuery(document).ready(function(e){e("body").hasClass("vc_editor")||(e(".bg-parallax.video, .fusion-bg-parallax.video").each(function(){e(this).prependTo(e(this).next().addClass("video")),e(this).css({opacity:Math.abs(parseFloat(e(this).attr("data-opacity"))/100)})}),e("[data-youtube-video-id], [data-vimeo-video-id]").parent().css("overflow","hidden"),e("[data-youtube-video-id], [data-vimeo-video-id]").each(function(){var t=e(this);setTimeout(function(){resizeVideo(t)},100)}),e("[data-youtube-video-id], [data-vimeo-video-id]").each(function(){var t=e(this);setTimeout(function(){resizeVideo(t)},1e3)}),e(window).on("resize",function(){e("[data-youtube-video-id], [data-vimeo-video-id]").each(function(){var t=e(this);setTimeout(function(){resizeVideo(t)},2)})}),fusionInitVimeoPlayers())}),jQuery(window).on("load fusion-element-render-fusion_builder_container",function(e,t){var i=void 0!==t?jQuery('div[data-cid="'+t+'"]').find("[data-youtube-video-id], [data-vimeo-video-id]"):jQuery("[data-youtube-video-id], [data-vimeo-video-id]");void 0!==t&&Number(fusionVideoBgVars.status_yt)&&"undefined"!=typeof onYouTubeIframeAPIReady&&onYouTubeIframeAPIReady(),i.each(function(){var e=jQuery(this);setTimeout(function(){resizeVideo(e)},500)})});;