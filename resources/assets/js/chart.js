const id = window.location.href.split("/").pop();
const container = document.querySelector("#res-container");

const getData = async function () {
  try {
    const response = await fetch(
      `http://localhost/checkmarksurveys/public/surveys/get/responses/${id}`
    );

    if (response.ok) {
      return await response.json();
    }
    return null;
  } catch (err) {
    console.log(err);
    const message = `<div class="alert alert-primary d-flex align-items-center" role="alert">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </svg>
    <div>
      There are currently no responses.
    </div>
  </div>`;
    container.insertAdjacentHTML("beforeend", message);
  }
};

getData().then((data) => {
  if (!data) return;
  console.log(data);

  const table = `<table class="table table-success table-striped mx-auto my-4"><tbody></tbody></table>`;

  data.questions.questions.forEach((q, i) => {
    const ques = `<h4 class="my-4">${q.text}</h4>`;
    const sect = `<section class="mb-4 p-3 card shadow-sm border-0 section"></section>`;

    container.insertAdjacentHTML("beforeend", sect);
    const section = document.querySelector(".section:last-child");
    section.insertAdjacentHTML("beforeend", ques);

    if (q.type === "radio") {
      const html = `<div class="mx-auto my-2" style='width: 35%; height: 100px' id='pie-${i}'></div>`;
      section.insertAdjacentHTML("beforeend", html);
      const series = [];

      q.options.forEach((label) => {
        const count = data.answers.filter((x) => x[2][i] === label).length;
        series.push(count);
      });

      const options = {
        chart: {
          type: "donut",
        },
        series: series,
        labels: q.options,
      };

      const chartEl = document.querySelector(`#pie-${i}`);
      const chart = new ApexCharts(chartEl, options);
      chart.render();
    }

    if (q.type === "checkbox") {
      const html = `<div class="mx-auto my-2" style='width: 50%; height: 100px' id='bar-${i}'></div>`;
      section.insertAdjacentHTML("beforeend", html);

      const series = [
        {
          data: [],
        },
      ];

      q.options.forEach((label) => {
        let c = 0;
        data.answers.forEach((x) => {
          c += x[2][i].filter((y) => y === label).length;
        });

        const bar = { x: label, y: c };
        series[0].data.push(bar);
      });

      options = {
        chart: {
          type: "bar",
        },
        plotOptions: {
          bar: {
            horizontal: true,
          },
        },
        series: series,
      };

      const chartEl = document.querySelector(`#bar-${i}`);
      const chart = new ApexCharts(chartEl, options);
      chart.render();
    }

    if (q.type === "text") {
      section.insertAdjacentHTML("beforeend", table);
      const tbody = document.querySelector(".table > tbody");
      let body = ``;
      data.answers.forEach((x) => {
        body += `<tr><td>${x[2][i]}</td></tr>`;
      });
      tbody.insertAdjacentHTML("beforeend", body);
    }
  });
});
