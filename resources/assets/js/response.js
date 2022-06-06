$(document).ready(function () {
  //console.log(document.querySelectorAll("[data-cb]"));
  $("#respond-btn").on("click", function (e) {
    e.preventDefault();
    const form = document.querySelector("#survey-form");
    const formData = new FormData(form);
    const url = window.location.href.split("/").pop();
    const object = { surveyId: url, answers: [] };
    let checkbox = [];
    let ck = "";

    formData.forEach((value, key) => {
      if (key.includes("-C")) {
        if (key.split("-C").pop() !== ck) {
          ck = key.split("-C").pop();
          if (checkbox.length !== 0) object.answers.push(checkbox);
          checkbox = [];
        }
        checkbox.push(value);
      } else {
        if (checkbox.length !== 0) {
          object.answers.push(checkbox);
          checkbox = [];
        }
        object.answers.push(value);
      }
    });
    if (checkbox.length !== 0) object.answers.push(checkbox);
    console.log(object);

    $.ajax({
      url: "http://localhost/checkmarksurveys/public/surveys/send/response",
      type: "POST",
      data: { data: JSON.stringify(object) },
      success: function (res) {
        console.log(res);
      },
      error: function () {
        console.log("failed");
      },
    });
  });
});
