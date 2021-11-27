
$(function () {
    //返回顶部
    $(window).scroll(function () {
        if ($(window).scrollTop() >= 200) {
            $(".backTop").fadeIn(200);
        } else {
            $(".backTop").fadeOut(100);
        }
    });
    $(".backTop").click(function () {
        $("html,body").animate({ scrollTop: 0 }, 500);
    });
    // 首页banner
    var swiper1 = new Swiper('.banner .swiper-container', {
        loop: true, // 循环模式选项
        speed: 300,
        autoplay: {
            delay: 2000
        },
        // 如果需要分页器
        pagination: {
            el: '.swiper-pagination',
        },
    });  
    // 导航栏  
    $('.down_box').click(function () {
        $(".lag_list").slideToggle();
    })
    var search_flag = true;
    $('.search_box .search_icon').click(function () {
        if (search_flag) {
            $(".search_box .search").show();
            search_flag = false
        } else {
            $(".search_box .search").hide();
            search_flag = true
        }

    })
   
});




