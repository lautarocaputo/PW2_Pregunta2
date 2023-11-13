

$(document).ready(function () {

  $.ajax({
    url: "/editor/list",
    type: "POST",
    dataType: "json",
    data: {},
    success: function (data) {
      var template = `
      <thead class="thead-dark">
      <tr>
          <th>Pregunta reportada</th>
          <th>Actions</th>
      </tr>
  </thead>
  <tbody>
      {{#reportedQuestions}}
      <tr>
          <td>{{Pregunta_texto}}</td>
          <td>
              <button data-id="{{id_pregunta_reportada}}" class="btn btn-light btn-outline-secondary ">Corregir</button>
          </td>
      </tr>
      {{/reportedQuestions}}
  </tbody>`;

      var preguntasReportadasRender = Mustache.render(template, data);

      $("#tabla_preguntas_reportadas").html(preguntasReportadasRender);

      $("#tabla_preguntas_reportadas button").click(function() {
        var id = $(this).data('id');
        updateQuestion(id);
    });
    },
  });
});
