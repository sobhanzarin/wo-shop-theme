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
  // carosel related in single post

  var carosel = $(".owl-carousel");
  var slider_items = carosel.data("items");
  var navigation = carosel.data("navigation");
  var pagination = carosel.data("pagination");
  var loop = carosel.data("loop");
  carosel.owlCarousel({
    loop: loop,
    margin: 10,
    nav: navigation,
    dots: pagination,
    rtl: true,
    responsive: {
      0: {
        items: 1,
      },
      400: {
        items: 1,
      },
      600: {
        items: 3,
      },
      1000: {
        items: slider_items,
      },
    },
  });

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
});
