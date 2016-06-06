//staging
(function(jQuery) {

    var hasLooped = false;

    var link = window.location.pathname;

    var windowH = jQuery(window).height();
    var windowW = jQuery(window).width();

    var pages = jQuery('#page-wrap .next').length,
        nextPage = pages + 1,
        max = jQuery('#max').text(),
        maxNum = parseInt(max,10),
        nextPageContent = link + 'page/' + nextPage + ' ' + '#page-wrap>div.next>section',  
        scrollCounter=0;

    function hideLoader() {
      jQuery('.loader').fadeOut("slow");
      jQuery('.menu').animate({"opacity":"1"});
    };

    function hidePlaceholder() {
        jQuery('.post > .placeholder').fadeOut();
        console.log('ran hidePlaceholder - its the one over each post');
    }


    function hideArticlePlaceholder() {
        jQuery('.scroll-loader').fadeOut(200);
        jQuery('body').css({"padding-bottom":"0"});
        console.log('ran hideArticlePlaceholder - its the last one');
    }

    

    function setupLayout() {
        windowH = jQuery(window).height();
        windowW = jQuery(window).width();

        pages = jQuery('#page-wrap .next').length;
        max = jQuery('#max').text();
        maxNum = parseInt(max,10);
        console.log('inside setupLayout, pages is '+pages+'and maxNum is '+ maxNum);


        if(jQuery('article img').length) {
          var allArticleWidth = 0;
          if(windowW >= 751) {
            jQuery('article img').height(windowH -210); 
            jQuery('#page-wrap').css({"max-height":jQuery('article').height(),"overflow-y":"hidden"}).height(jQuery('article').height());
            jQuery('article img').css('width', 'auto');
            var articleCounter = 0;
            jQuery('#page-wrap article').each(function() {
                articleCounter++;
                allArticleWidth += jQuery(this).width()+10; 
            });
            console.log('articleCounter was '+articleCounter);
            if(pages < maxNum) {
                var notlast = allArticleWidth+15;
                jQuery('#page-wrap').width(allArticleWidth+15);
                //console.log('made #page-wrap width '+ notlast); 
            } else {
                var yeslast = allArticleWidth+2;
                jQuery('#page-wrap').width(allArticleWidth+2);
                // console.log('pages > max: made #page-wrap width '+ yeslast);
                jQuery('section > .placeholder').hide();
            }   
            
          } else {                                      //vertical
              jQuery('#page-wrap').width(windowW).css({"max-height":"none","overflow-y":"visible","height":"auto"});
              jQuery('article img').css('height', 'auto');
              jQuery('article img').width(windowW - 20);
              console.log('adjusted width of images'); 
              if (pages === maxNum) {
                jQuery('section > .placeholder').hide();
              }
          }
        }


        if (jQuery('article iframe').length) {
          var allArticleWidth = 0;
            if (windowW > windowH) {
                if (windowH / windowW > 0.66) {
                    console.log('inside the ratio H/W>0.66');
                    jQuery('iframe').width(windowW - 20);
                    jQuery('iframe').height((windowW - 20) * 0.462);
                } else {
                    console.log('inside the else for that ratio');
                    jQuery('iframe').height(windowH * .7);
                    jQuery('iframe').width(windowH * .7 * 1.78);
                }   
                jQuery('article').each(function() {
                    allArticleWidth += jQuery(this).width() + 20; //20 is margin of post
                });
                jQuery('#page-wrap').width(allArticleWidth);

            } else { //vertical
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
                    hidePlaceholder();
            })

    console.log('end of setuplayout inside setuplayout');
    } //end of setuplayout

    function imageLoad() {
        jQuery('article img').each(function(index) {
            jQuery(this).hide().delay(5000*index).show();
        })
    }

    function infiniteScroll() {

        pages = jQuery('#page-wrap .next').length;
        nextPage = pages + 1;
        max = jQuery('#max').text();
        maxNum = parseInt(max,10);
        nextPageContent = link + 'page/' + nextPage + ' ' + '#page-wrap>div.next>section';  

        function pageLoad() {
            if(pages < maxNum ) {
                var newPage = jQuery('#page-wrap').append('<div style="opacity:0" class="next group' + ' ' + pages +'">').find('.'+pages);
                console.log('created a newpage');

                var reSetup =  function() {
                    console.log('inside reSetup');
                    jQuery('#page-wrap').imagesLoaded()
                        .always(
                            function(){
                                console.log('all images are loaded in newpage');
                                setTimeout(function(){
                                        jQuery('#page-wrap .'+pages).imagesLoaded()
                                            .always(function(){
                                             console.log('newPage in wrap is '+ jQuery('#page-wrap .next').last().attr('class') +', images loaded');
                                             console.log('(#page-wrap article.length) before calling setuplayout is' + jQuery('#page-wrap article').length);
                                             console.log('the last div is '+ jQuery('#page-wrap .next').last().attr('class'));
                                             setupLayout();
                                             jQuery('#page-wrap').find('.next').last().animate({"opacity":"1"},200);   
                                            });
                                        setTimeout(function(){
                                            hideArticlePlaceholder();
                                            hidePlaceholder(); 
                                            setupLayout();
                                            scrollCounter=0;
                                            console.log('just reset scrollcounter');
                                        },200);
                                }, 400);
                            }
                            );}  


                //newPage.load(nextPageContent, reSetup());
                newPage.load(nextPageContent, function(){reSetup();});
                console.log('just called a load for '+nextPageContent);  
                

            }  else if(pages===maxNum){
                jQuery('.scroll-loader').remove();
                
            }

        } //end of pageload

        if(windowW>751) {
            
            // jQuery('#page-wrap').css('transform', 'translateX( + -1 )');

            if(jQuery(document).width() === (jQuery(window).scrollLeft() + jQuery(window).width())) {
                scrollCounter++;
                console.log('scrollcounter is '+scrollCounter);
                if (scrollCounter===1){
                    console.log('calling pageLoad horizontal for the ' +pages+' time');
                    jQuery('#page-wrap').width(jQuery('#page-wrap').width()+40); //add space for scroll-loader
                    jQuery('.scroll-loader').fadeIn(100);
                    pageLoad();
                }
            } 

        } else {
            if(jQuery(window).scrollTop() + jQuery(window).height() > jQuery(document).height()-jQuery('article').last().height() ) { 
                scrollCounter++;
                console.log(scrollCounter);
                if (scrollCounter===1){
                    console.log('calling pageLoad vertical for the ' +pages+' time');
                    jQuery('body').css({"padding-bottom":"30px"}); //add space for scroll-loader
                    jQuery('.scroll-loader').fadeIn(100);
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
        setupLayout();
        
        jQuery(window).resize(function(){
            setupLayout();
        })

        jQuery(window).scroll(function(){
            infiniteScroll();
        })
        jQuery('html, body').resize(function() {
            hideArticlePlaceholder();
            setupLayout();
        })
    }); //onload ends 

})(jQuery); //full function ends
