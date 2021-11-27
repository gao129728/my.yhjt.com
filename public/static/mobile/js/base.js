
$(function () {

    // 头部导航栏
    $('#menu').leftMenu({
        "triggerBtn": ".btn"
    }).init();
    $(".close").click(function () {
        $(".leftMenu").removeClass('menu-open');
        $(".menu-dark-backdrop").removeClass('in');
        $("body").css('overflow', 'inherit')
    });
    // 语言选择下拉
    $('.down_box').click(function () {
        $(".lag_list").slideToggle();
    })
    // search下拉
    $('.nav .leftM .search').on('click', function () {
        $('.headerbg').stop().slideUp();
        $('.hserch').fadeIn();
    })
    $('.hserch i').on('click', function () {
        $('.hserch').fadeOut();
    })
    // 首页banner
    var mySwiper = new Swiper('.bannerBox .swiper-container', {
        loop: true, // 循环模式选项  
        autoplay: 1500,
        // 如果需要分页器
        // 如果需要分页器
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
        paginationClickable: true
    })
    // part1
    var swiper2 = new Swiper('.part1 .swiper-container', {
        speed: 300,
        slidesPerView: 2,
        spaceBetween: 10,
    });

    // 产品中心下拉导航
    $(function () {
        $(".proxl").click(function () {
            $(".procla").show()
        })
        $(".back").click(function () {
            $(".procla").hide()
        })

        $(".sideup li").each(function () {
            if ($(".sidedown").find("li").length > 0) {
                $(this).parent("ul").siblings("i").addClass("tun");
            }
        })
        $(".tun").click(function () {
            $(this).parent("li").children("ul").toggle()
        })
    })


});




