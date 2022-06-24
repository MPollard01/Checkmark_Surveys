$(document).ready(function () {
  //console.log(document.querySelectorAll("[data-cb]"));
  $("#respond-btn").on("click", function (e) {
    e.preventDefault();
    const form = document.querySelector("#survey-form");
    const formData = new FormData(form);
    const url = window.location.href.split("/")[7];
    const object = { surveyId: url, answers: [] };
    let checkbox = [];
    let ck = "";
    let isEmpty = false;

    const warn = document.querySelector("#warningToast");
    const warning = new bootstrap.Toast(warn);

    const successEl = document.querySelector("#successToast");
    const success = new bootstrap.Toast(successEl);

    formData.forEach((value, key) => {
      if (value.length === 0) {
        isEmpty = true;
        warning.show();
        return;
      }

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

    if (isEmpty) return;

    $.ajax({
      url: "http://localhost/checkmarksurveys/public/surveys/send/response",
      type: "POST",
      data: { data: JSON.stringify(object) },
      success: function (res) {
        document.querySelector(".btn").disabled = true;
        success.show();
      },
      error: function () {
        console.log("failed");
      },
    });
  });
});
