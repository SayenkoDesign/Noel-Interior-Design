jQuery(document).ready(function(){
    jQuery(document).foundation();

    jQuery('.img-slider').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true
    });

    jQuery('.service-text').hide();
    jQuery('.service').click(function(){
        jQuery(this).next().slideToggle();
    });

    jQuery('.contact').fancybox({
        tpl: {
            closeBtn: '<a title="Close" class="fancybox-item fancybox-close my-contact-close" href="javascript:;"></a>'
        }
    });
    jQuery('.fancybox').fancybox({
        helpers: {
            title: {
                type: 'outside',
                position: 'top',
            },
            overlay: {
                css: {
                    'background-color' : 'rgba(229, 229, 229, 0.2)'
                }
            }
        },
        tpl: {
            closeBtn: '<a title="Close" class="fancybox-item fancybox-close my-close" href="javascript:;"></a>',
            next: '<a title="Next" class="fancybox-nav fancybox-next my-next" href="javascript:;"><span></span></a>',
            prev: '<a title="Previous" class="fancybox-nav fancybox-prev my-prev" href="javascript:;"><span></span></a>'
        },
        padding: 0,
    });
});
