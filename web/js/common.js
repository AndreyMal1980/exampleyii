$(document).ready(function () {

    $('.catalog').dcAccordion();
    $('.slides').slick({
        infinite: true,
        autoplay: true,
        arrows: true,
        slidesToShow: 4,
        slidesToScroll: 4,
        prevArrow: '<img style="position:absolute; top:50%;left:-55px"  src="img/slider-next.png">',
        nextArrow: '<img style="position:absolute; right:-55px; top:50%" src="img/slider-prev.png">',
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                }
            },
            {
                breakpoint: 1366,
                settings: {
                    dots: false,
                    arrows: false
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    dots: false,
                    arrows: false
                }
            },
            {
                breakpoint: 580,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false,
                    arrows: false
                }
            }
        ],
    });


    $('.slides-portfolio-master').slick({
        infinite: true,
        autoplay: true,
        arrows: true,
        dots: true,
        slidesToShow: 5,
        slidesToScroll: 5,
        prevArrow: '<img  src="/img/slider-next-master-portfolio.png">',
        nextArrow: '<img  src="img/slider-prev.png">',
    });


    $('.scrolling').click(function () {
        var idscroll = $(this).attr('href');//получаем значение атрибута href
        $.scrollTo(idscroll, 1000);// перематываем до блока(1000 - это длительность 1 сек.)
        return false;
    });



    $('.call-master').on('click', function () {
      
        $('#modal-callback').arcticmodal({
        });
    });

    /*Прокрутка до нужного мечта при клике по элементу*/
    /*  $('a').click(function () {
     var idscroll = $(this).attr('href');//получаем значение атрибута href
     $.scrollTo(idscroll, 1000);// перематываем до блока(1000 - это длительность 1 сек.)
     return false;
     });//end click*/
    //если нужно перематывать скролл какого-то элемента то просто укажите его
    //$('div').scrollTo(idscroll, 1000);



});



   