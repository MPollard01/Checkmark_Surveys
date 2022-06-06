$(document).ready(function () {
  $("body").tooltip({ selector: "[data-bs-toggle=tooltip]" });

  const inputContainer = $(".input-wrap").prop("outerHTML");
  const questionType = $(".question-type").prop("outerHTML");
  const btnHtml =
    '<button type="button" class="remove btn btn-sm btn-outline-secondary"' +
    'data-bs-toggle="tooltip" data-bs-placement="right" title="Remove option">' +
    '<i class="fa fa-times"></i></button>';

  $("#addQuestion").click(function (e) {
    e.preventDefault();

    if ($(".input-wrap") > 0) $(inputContainer).insertAfter(".input-wrap:last");
    else $(inputContainer).appendTo("form");
  });

  $("form").on("click", ".question-type", function (e) {
    e.preventDefault();
    const btn = e.target.closest(".add");
    if (!btn) return;

    const container = $(this).prop("outerHTML");

    $(container).insertAfter(this);

    $(this).next().find(".add:last").replaceWith(btnHtml);
  });

  $("form").on("click", ".question-type", function (e) {
    e.preventDefault();
    const remove = e.target.closest(".remove");
    if (!remove) return;

    $(this).remove();
  });

  $("form").on("change", ".input-wrap", function (e) {
    const choice = e.target.closest(".choices");
    if (!choice) return;

    const option = $(choice).val();
    //const inputs = $(this).find(".question-type > .qtype > :input");
    const question = $(this).find(".question-type");

    switch (option) {
      case "radio":
        $(question).replaceWith(questionType);
        $(this)
          .find(".question-type")
          .find(".add")
          .not(".add:first")
          .replaceWith(btnHtml);
        break;
      case "checkbox":
        $(question).empty().append($(questionType).html());
        $(question).find(":input:first").attr({ type: "checkbox" });
        $(this)
          .find(".question-type")
          .find(".add")
          .not(".add:first")
          .replaceWith(btnHtml);
        break;
      case "text":
        question.not(".question-type:first").remove();
        question.empty().append("<span px-3>Answer text</span>");
        break;
    }
  });

  $("form").on("click", ".input-wrap", function (e) {
    e.preventDefault();
    const remove = e.target.closest(".remove-question");
    if (!remove) return;

    $(this).remove();
  });

  $("#surveybtn").on("click", function (e) {
    e.preventDefault();
    const formData = document.querySelector("#survey-form");
    const dataArr = new FormData(formData);
    const object = { title: "", questions: [] };
    let i = -1;

    dataArr.forEach((value, key) => {
      if (key === "title") object.title = value;
      if (key.startsWith("question")) {
        i++;
        object.questions.push({
          text: value,
          type: "",
          options: [],
        });
      }

      if (key.startsWith("Question-type")) {
        object.questions[i].type = value;
      }

      if (key.startsWith("options")) {
        object.questions[i].options.push(value);
      }
    });

    const toastEl = document.querySelector("#liveToast");
    const toast = new bootstrap.Toast(toastEl);

    const url = window.location.href;
    let sendTo = "http://localhost/checkmarksurveys/public/sendsurvey";

    if (url.includes("edit")) {
      sendTo =
        "http://localhost/checkmarksurveys/public/edit/" + url.split("/").pop();
    }

    $.ajax({
      url: sendTo,
      type: "POST",
      data: { data: JSON.stringify(object) },
      success: function (res) {
        toast.show();
        if (!url.includes("edit")) {
          window.history.pushState({}, null, res);
        }
      },
      error: function () {
        console.log("failed");
      },
    });

    console.log(JSON.stringify(object));
  });

  $("#emailModalbtn").on("click", function (e) {
    e.preventDefault();

    const url = window.location.href;

    if (!url.includes("edit")) {
      $("#warningModal").modal("show");
      return;
    }

    $("#emailModal").modal("show");
  });

  $("#email-btn").on("click", function (e) {
    e.preventDefault();

    const formData = document.querySelector("#email-form");
    const data = Object.fromEntries(new FormData(formData));
    console.log(data);

    const id = window.location.href.split("/").pop();

    data.body += `<br><br>Click the link to take fill in the survey <a href="http://localhost/checkmarksurveys/public/surveys/respond/${id}">Take Survey</a>`;
    data.recipients = data.recipients.split(" ");

    $.ajax({
      url: "http://localhost/checkmarksurveys/public/surveys/email",
      type: "POST",
      data: { data: JSON.stringify(data) },
      success: function (res) {
        console.log(res);
        $("#emailModal").modal("hide");
      },
      error: function () {
        console.log("failed");
      },
    });
  });
});
