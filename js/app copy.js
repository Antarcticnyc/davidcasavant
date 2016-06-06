//live
//(function(jQuery) {

    var hasLooped = false;

    var link = window.location.pathname;

    var windowH = jQuery(window).height();
    var windowW = jQuery(window).width();

    var pages = jQuery('.next').length,
        nextPage = pages + 1,
        max = jQuery('#max').text(),
        maxNum = parseInt(max,10),
        nextPageContent = link + 'page/' + nextPage + ' ' + '#page-wrap>div.next>section';  
        scrollCounter=0;

    function hideLoader() {
      jQuery('.loader').fadeOut("slow");
      jQuery('.menu').animate({"opacity":"1"});
    };

    function hidePlaceholder() {
        jQuery('.post > .placeholder').fadeOut();
    }


    function hideArticlePlaceholder() {
        jQuery('.next').last().siblings().find('.placeholder').fadeOut();
    }

    // function showImages() {
    //     var postL; 
    //     var windowR;
    //     jQuery('.imgHolder').each(function(index){
    //         postL = jQuery(this).position().left;
    //         viewportR = jQuery(window).scrollLeft() + windowW;
    //         if(postL < viewportR) {
    //             jQuery(this).fadeIn();  
    //         }
    //     });
        
    // }

    

    function setupLayout() {
        windowH = jQuery(window).height();
        windowW = jQuery(window).width();

        pages = jQuery('.next').length;
        nextPage = pages + 1;
        max = jQuery('#max').text();
        maxNum = parseInt(max,10);
        nextPageContent = link + 'page/' + nextPage + ' ' + '#page-wrap>div.next>section';  

        if(jQuery('article img').length) {
          var allArticleWidth = 0;
          if(windowW >= 751) {
            jQuery('article img, section > .placeholder').height(windowH -210); 
            jQuery('section > .placeholder').width(200);
            jQuery('article img').css('width', 'auto');
            jQuery('article').each(function() {
                allArticleWidth += jQuery(this).width()+10; 
            });
            jQuery('#page-wrap').height(jQuery('article').height());
            if(pages < maxNum) {
                var notlast = allArticleWidth+200+2;
                jQuery('#page-wrap').width(allArticleWidth+200+2);
                // console.log('made #page-wrap width '+ notlast); 
            } else {
                var yeslast = allArticleWidth+2;
                jQuery('#page-wrap').width(allArticleWidth+2);
                // console.log('pages > max: made #page-wrap width '+ yeslast);
                jQuery('section > .placeholder').hide();
            }   
            
          } else {                                      //vertical
              jQuery('#page-wrap').width(windowW);
              jQuery('article img').css('height', 'auto');
              jQuery('article img, section > .placeholder').width(windowW - 20); 
              if (pages === maxNum) {
                jQuery('section > .placeholder').hide();
              }
          }
        }

        // if(windowW >=751) {
        //      jQuery("body").on('mousewheel DOMMouseScroll', function(event, delta) {
        //         this.scrollLeft -= (delta);       
        //         event.preventDefault();
        //      });
        // } else {
        //    jQuery("body").unbind('mousewheel DOMMouseScroll');
        // }

        if (jQuery('article iframe').length) {
          var allArticleWidth = 0;
            if (windowW > windowH) {
                if (windowH / windowW > 0.66) {
                    jQuery('iframe').width(windowW - 20);
                    jQuery('iframe').height((windowW - 20) * 0.562);
                } else {
                    jQuery('iframe').height(windowH * .8);
                    jQuery('iframe').width(windowH * .8 * 1.78);
                }   
                jQuery('article').each(function() {
                    allArticleWidth += jQuery(this).width() + 20; //20 is margin of post
                });
                jQuery('#page-wrap').width(allArticleWidth);

            } else {
                jQuery('iframe').width(windowW - 20);
                jQuery('iframe').height((windowW - 20) * 0.562);
                jQuery('article').each(function() {
                    allArticleWidth += jQuery(this).width() + 20; //20 is margin of post
                });
                jQuery('#page-wrap').width(windowW);
            }
        }

        jQuery('#page-wrap').imagesLoaded()
            .always(
                function() {
                    hideLoader();
            })
            .progress(
                function(){
                    hidePlaceholder();
                });

        // setTimeout(function(){
        //     // console.log('inside the setupLayout timeout');
        //           hideloader();
        //           hideArticlePlaceholder();
        //           hidePlaceholder();
        // },2000)

    }

    function imageLoad() {
        jQuery('article img').each(function(index) {
            jQuery(this).hide().delay(5000*index).show();
        })
    }

    function infiniteScroll() {

        var lastestPage = jQuery('#page-wrap .next').last();
        //var lastestPagePosition = lastestPage.position().left + lastestPage.width();
        var scrollPosition = jQuery(window).scrollLeft() + windowW;


        function pageLoad() {
            // console.log ('running pageLoad');
            if(pages < maxNum ) {
                jQuery('#page-wrap').append('<div style="opacity:0" class="next group' + ' ' + pages +'">');
                //var lastestPage = jQuery('#page-wrap .next').last();
                var newPage = jQuery('<div style="opacity:0" class="next group' + ' ' + pages +'">');

                var reSetup =  function() {setTimeout(function(){
                  jQuery(newPage).imagesLoaded()
                      .always(
                            function() {
                                console.log('all images are loaded');
                                newPage=jQuery(newPage).find('section');
                                jQuery('#page-wrap .next').last().html(newPage);
                                //jQuery('#page-wrap').append(newPage);
                                setupLayout();
                                jQuery('#page-wrap').find('.next').last().delay(800).animate({"opacity":"1"});
                                hidePlaceholder(); 
                                hideArticlePlaceholder();
                                setTimeout(function(){
                                    jQuery('#page-wrap .next:empty').remove();
                                    scrollCounter=0;
                                },400);
                            }
                        );
                  //setupLayout();
                  // console.log ('inside reSetup setTimeout');
                  
                  
                },1500);}

                newPage.load(nextPageContent, reSetup());  
                
 

                // setTimeout(function(){
                //   setupLayout();
                //   console.log ('inside pageLoad setTimeout');
                //   hidePlaceholder();
                // },3000)
            }  

        }

        if(windowW>751) {
            
            // jQuery('#page-wrap').css('transform', 'translateX( + -1 )');

            if(jQuery(document).width() - (jQuery(window).scrollLeft() + jQuery(window).width()) === 0 ) {
                scrollCounter++;
                console.log(scrollCounter);
                if (scrollCounter===1){
                    console.log(pages + ' ' + 'pageLoad');
                    pageLoad();
                }
            } 

        } else {
            if(jQuery(document).height() - (jQuery(window).scrollTop() + jQuery(window).height()) === 0 ) { 
                scrollCounter++;
                console.log(scrollCounter);
                if (scrollCounter===1){
                    console.log(pages + ' ' + 'pageLoad');
                    pageLoad();
                }
            }
        }
    }




    jQuery(window).on('load', function() {

        windowH;
        windowW;
        link;
        pages;

        jQuery("#mobile-nav-icon").click(function() {
            jQuery(this).toggleClass('open');
            jQuery('.menu').slideToggle();
        })
        jQuery('.cycle-slideshow').cycle();
        // imageLoad();
        //hidePlaceholder();
        setupLayout();
        
        jQuery(window).resize(function(){
            setupLayout();
        })

        jQuery(window).scroll(function(){
            //setupLayout();
            infiniteScroll();
        })
        jQuery('html, body').resize(function() {
            hideArticlePlaceholder();
            setupLayout();
        })
    }); //onload ends 

//})(jQuery); //full function ends
