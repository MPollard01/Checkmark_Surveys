$(".delete").on("click", function (e) {
  e.preventDefault();
  const del = e.target.closest(".delete");
  if (!del) return;

  const id = del.firstChild.textContent;

  $.ajax({
    url: `http://localhost/checkmarksurveys/public/surveys/delete/${id}`,
    type: "DELETE",
    success: function () {},
    error: function () {
      console.log("failed");
    },
  });

  $(this).closest(".col").remove();
});
