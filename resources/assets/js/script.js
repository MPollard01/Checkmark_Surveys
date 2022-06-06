$(window).on("load", function () {
  $(".navbar-nav").on("click", "a", function () {
    $(".navbar-nav a.active").removeClass("active");
    $(".navbar-nav").closest("a").addClass("active");
  });
  console.log($(".navbar-nav a.active"));
});
