function initOwlCarousel() {
  var carosel = jQuery(".owl-carousel");

  carosel.each(function () {
    var owl = jQuery(this);
    var slider_items = owl.data("slider-items");
    var navigation = owl.data("navigation");
    var pagination = owl.data("pagination");
    var loop = owl.data("loop");

    if (!owl.hasClass("owl-loaded")) {
      owl.owlCarousel({
        loop: loop,
        margin: 10,
        nav: navigation,
        dots: pagination,
        rtl: true,
        responsive: {
          0: { items: 1 },
          400: { items: 1 },
          600: { items: 2 },
          1000: { items: slider_items },
        },
      });
    }
  });
}
jQuery(document).ready(function () {
  $("#btn-auth, #close-modal").click(function (e) {
    e.preventDefault();
    $(".login-modal").toggleClass("show");
  });

  $("#phone-nav-toggle").click(function (e) {
    $("body").toggleClass("phone-nav-open");
  });

  $(".phone-overlay").click(function (e) {
    $("body").removeClass("phone-nav-open");
  });

  $(".phone-menu ul.sub-menu").before(
    '<i class="fal fa-angle-left sum-menu-arrow"></i>'
  );

  $(".sum-menu-arrow").click(function (e) {
    e.preventDefault;
    if ($(this).hasClass("fa-angle-left")) {
      $(this).next("ul.sub-menu").animate({ height: "toggle" });
    }
  });

  var sticky_sid = $(".post-sidebar");

  if (sticky_sid.length) {
    var sideTop = sticky_sid.offset().top;

    $(window).scroll(function () {
      var currentScroll = $(window).scrollTop();
      if (currentScroll >= sideTop) {
        sticky_sid.css({
          position: "fixed",
          top: "40px",
        });
      } else {
        sticky_sid.css({
          position: "relative",
          top: "0",
        });
      }
    });
  }
  initOwlCarousel();

  // carosel related in single post
  // var carosel = $(".owl-carousel");

  // carosel.each(function () {
  //   var owl = $(this);
  //   var slider_items = owl.data("slider-items");
  //   var navigation = owl.data("navigation");
  //   var pagination = owl.data("pagination");
  //   var loop = owl.data("loop");

  //   owl.owlCarousel({
  //     loop: loop,
  //     margin: 10,
  //     nav: navigation,
  //     dots: pagination,
  //     rtl: true,
  //     responsive: {
  //       0: {
  //         items: 1,
  //       },
  //       400: {
  //         items: 1,
  //       },
  //       600: {
  //         items: 2,
  //       },
  //       1000: {
  //         items: slider_items,
  //       },
  //     },
  //   });
  // });

  // single-product
  $(".simagar-single-product .slick-carousel").each(function () {
    let e = $(this);

    e.slick({
      arrows: !!e.data("nav"),
      dots: !!e.data("dots"),
      autoplay: !!e.data("autoplay"),
      slidesToShow: e.data("columns"),
      slidesToScroll: 1,
      rtl: true,
      asNavFor: e.data("asnavfor") ? e.data("asnavfor") : "",
      draggable: true,
      infinite: true,
      cssEase: "linear",
    });
  });

  // add to cart btns
  if (!document.body.classList.contains("elementor-editor-active")) {
    $(document).on("click", ".plus, .minus", function () {
      var input = $(this).closest(".quantity").find(".qty"),
        value = parseFloat(input.val()),
        max = parseFloat(input.attr("max")),
        min = parseFloat(input.attr("min")),
        step = input.attr("step");

      if (!value || value === "NaN") value = 0;
      if (!min || min === "NaN") min = 0;
      if (!max || max === "NaN") max = "";
      if (!step || step === "any" || step === "NaN") step = 1;

      if ($(this).is(".plus")) {
        input.val(max && value >= max ? max : value + parseFloat(step));
      } else {
        input.val(min && value <= min ? min : value - parseFloat(step));
      }

      input.trigger("change");
    });
  }

  // AJAX cart mini header
  jQuery(function ($) {
    $(document.body).on("added_to_cart", function () {
      $("#dropdownMenuButton").dropdown("toggle");
    });
  });

  // Ajax سرچ
  $(".header-search-box").on("keydown", function () {
    var data_val = $(this).val();
    if (data_val.length > 2) {
      $.ajax({
        url: SIMAGAR_DATA.ajax_url,
        type: "post",
        data: {
          action: "simagar_search_ajax",
          keyword: data_val,
        },
        success: function (data) {
          $("#search-result-holder").html(data);
          $("#search-result-holder").show();
        },
      });
    } else {
      $("#search-result-holder").hide();
    }
  });

  // selected tab product widget
  $(".category-item").click(function () {
    var item = $(this);
    var category_selected = item.data("product-cate");
    var container = $(".product-item");
    container.fadeTo(150, 0.1);

    $.ajax({
      url: SIMAGAR_DATA.ajax_url,
      type: "post",
      data: {
        action: "simagar_filter_product",
        category: category_selected,
      },
      success: function (data) {
        container.html(data);
        container.fadeTo(200, 1);
        $(".category-item").removeClass("select");
        item.addClass("select");
      },
    });
  });

  var carosel_swiper = $(".simagar-swiper-slider");
  carosel_swiper.each(function () {
    var autoplayDelay = $(this).data("autoplay");
    var loopSlides = $(this).data("loop") === "true";
    var slides = parseInt($(this).data("slidea"), 10) || 1;

    new Swiper(this, {
      loop: loopSlides,
      autoplay: {
        delay: autoplayDelay,
      },
      pagination: {
        el: $(this).find(".swiper-pagination")[0],
        clickable: true,
      },
      navigation: {
        nextEl: $(this).find(".swiper-button-next")[0],
        prevEl: $(this).find(".swiper-button-prev")[0],
      },
      slidesPerView: slides,
      speed: 600,
    });
  });
});

// 2️⃣ المنتور ادیتور
jQuery(window).on("elementor/frontend/init", function () {
  elementorFrontend.hooks.addAction(
    "frontend/element_ready/global",
    function () {
      initOwlCarousel();
    }
  );
});
