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
  $(document).on("click", ".plus, .minus", function () {
    var input = $(this).closest(".quantity").find(".qty"),
      value = parseFloat(input.val()),
      max = parseFloat(input.attr("max")),
      min = parseFloat(input.attr("min")),
      step = input.attr("step");
    (value && "" !== value && "NaN" !== value) || (value = 0),
      ("" === max || "NaN" === max) && (max = ""),
      ("" === min || "NaN" === min) && (min = 0),
      ("any" === step ||
        "" === step ||
        void 0 === step ||
        "NaN" === parseFloat(step)) &&
        (step = 1),
      $(this).is(".plus")
        ? input.val(
            max && (max == value || value > max)
              ? max
              : value + parseFloat(step)
          )
        : min && (min == value || min > value)
        ? input.val(min)
        : value > 0 && input.val(value - parseFloat(step)),
      input.trigger("change");
  });

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
