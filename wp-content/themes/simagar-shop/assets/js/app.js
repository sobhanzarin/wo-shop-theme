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
      //   $(this).next("ul.sub-menu").show(500);
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
});
