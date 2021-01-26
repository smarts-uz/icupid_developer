(function($) {

    $.fn.cslide = function() {
        this.each(function() {

            var slidesContainerId = "#"+($(this).attr("id"));
            
            var len = $(slidesContainerId+" .cslide-slide").size();     // get number of slides
            var slidesContainerWidth = len*100+"%";                     // get width of the slide container
            var slideWidth = (100/len)+"%";                             // get width of the slides
            
            // set slide container width
            $(slidesContainerId+" .cslide-slides-container").css({
                width : slidesContainerWidth,
                visibility : "visible"
            });

            // set slide width
            $(".cslide-slide").css({
                width : slideWidth
            });

            // add correct classes to first and last slide
            $(slidesContainerId+" .cslide-slides-container .cslide-slide").last().addClass("cslide-last");
            $(slidesContainerId+" .cslide-slides-container .cslide-slide").first().addClass("cslide-first cslide-active");

            // initially disable the previous arrow cuz we start on the first slide
            $(slidesContainerId+" .cslide-prev").addClass("cslide-disabled");

            // if first slide is last slide, hide the prev-next navigation
            if (!$(slidesContainerId+" .cslide-slide.cslide-active.cslide-first").hasClass("cslide-last")) {           
                $(slidesContainerId+" .cslide-prev-next").css({
                    display : "block"
                });
            }

            // handle the next clicking functionality
            $(slidesContainerId+" .cslide-next").click(function(){


                var i = $(slidesContainerId+" .cslide-slide.cslide-active").index();
                var n = i+1;

                if (!$(slidesContainerId+" .cslide-slide.cslide-active").hasClass("cslide-last")) {
                    
                    $("#reg-pagination .active").addClass('visited').removeClass('active');
                    $("#reg-pagination .step").each(function(){
                        if(!$(this).hasClass('visited')){
                            $(this).addClass('active');
                            return false;
                        }
                    });

                }

                var slideLeft = "-"+n*100+"%";
                if (!$(slidesContainerId+" .cslide-slide.cslide-active").hasClass("cslide-last")) {
                    $(slidesContainerId+" .cslide-slide.cslide-active").removeClass("cslide-active").next(".cslide-slide").addClass("cslide-active");
                    $(slidesContainerId+" .cslide-slides-container").animate({
                        marginLeft : slideLeft
                    },250);
                    if ($(slidesContainerId+" .cslide-slide.cslide-active").hasClass("cslide-last")) {
                        $(slidesContainerId+" .cslide-next").addClass("cslide-disabled");
                    }
                }
                if ((!$(slidesContainerId+" .cslide-slide.cslide-active").hasClass("cslide-first")) && $(".cslide-prev").hasClass("cslide-disabled")) {
                    $(slidesContainerId+" .cslide-prev").removeClass("cslide-disabled");
                }
                
                $('html, body').animate({
                    scrollTop: $("#reg-pagination").offset().top
                }, 1000);

            });

            // handle the prev clicking functionality
            $(slidesContainerId+" .cslide-prev").click(function(){
                var i = $(slidesContainerId+" .cslide-slide.cslide-active").index();
                var n = i-1;

                var prev = "";

                if (!$(slidesContainerId+" .cslide-slide.cslide-active").hasClass("cslide-first")) {
                $("#reg-pagination .step").each(function(){
                    
                    
                    if($(this).hasClass('active')){
                        $(this).removeClass('active');
                        //$(this).parent().before().closest('.step').addClass('active');
                        $(prev).addClass('active').removeClass('visited');
                        return false;
                    }
                    else{
                        prev = this;
                    }
                });

                }

                var slideRight = "-"+n*100+"%";
                if (!$(slidesContainerId+" .cslide-slide.cslide-active").hasClass("cslide-first")) {
                    $(slidesContainerId+" .cslide-slide.cslide-active").removeClass("cslide-active").prev(".cslide-slide").addClass("cslide-active");
                    $(slidesContainerId+" .cslide-slides-container").animate({
                        marginLeft : slideRight
                    },250);
                    if ($(slidesContainerId+" .cslide-slide.cslide-active").hasClass("cslide-first")) {
                        $(slidesContainerId+" .cslide-prev").addClass("cslide-disabled");
                    }
                }
                if ((!$(slidesContainerId+" .cslide-slide.cslide-active").hasClass("cslide-last")) && $(".cslide-next").hasClass("cslide-disabled")) {
                    $(slidesContainerId+" .cslide-next").removeClass("cslide-disabled");
                }
    
                $('html, body').animate({
                    scrollTop: $("#reg-pagination").offset().top
                }, 1000);
                
        
            });


        });

        // return this for chainability
        return this;

    }

}(jQuery));