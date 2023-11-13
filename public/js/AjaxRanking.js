$(document).ready(function () {
  $.ajax({
    url: "/home/list",
    type: "POST",
    dataType: "json",
    data: {},
    success: function (data) {
      var userSectionTemplate = `
			{{#user}}
            <div class=" text-white bg-tertiary mb-3 w-auto">
                <div class="card-body text-center text-secondary">
                    <h2>¡Bienvenido <strong>{{nombre_completo}}</strong>!</h2> 
                    <h4>Su puntuación más alta es: <span class="text-success">{{puntuacion_masalta}}</span></h4>
                </div>
            </div>
            {{/user}}`;

      var userSectionRendered = Mustache.render(userSectionTemplate, data);

      $("#user_section").html(userSectionRendered);

      data.rankingScore = data.rankingScore.map(function (item) {
        return {
          position: item.position,
          nombre_completo: item.nombre_completo,
          puntuacion_masAlta: item.puntuacion_masAlta,
        };
      });

      var template = `<thead class="thead-dark">
								<tr>
									<th>Posición</th>
									<th>Usuario</th>
									<th>Puntos más altos</th>
								</tr>
							</thead>
								<tbody>
									{{#rankingScore}}
									<tr>
										<td class="position">
											{{position}}
										</td>
										<td>
											<a href="javascript:void(0);" style="text-decoration:none;"class="profile-link text-primary" data-nombre="{{nombre_completo}}" onclick="submitProfile(this)">
												{{nombre_completo}}
											</a>
										</td>
										<td>
											{{puntuacion_masAlta}}
										</td>
									</tr>
									{{/rankingScore}}
								</tbody>`;

      var rendered = Mustache.render(template, data);

      $("#tabla_ranking").html(rendered);

      var positionColumns = document.querySelectorAll(".position");

      positionColumns.forEach(function (positionColumn) {
        var positionValue = positionColumn.innerText;

        switch (positionValue) {
          case "1":
            positionColumn.innerHTML =
              '<img src="../public/assets/primerPuesto.png" alt="1">';
            break;
          case "2":
            positionColumn.innerHTML =
              '<img src="../public/assets/segundoPuesto.png" alt="2">';
            break;
          case "3":
            positionColumn.innerHTML =
              '<img src="../public/assets/tercerPuesto.png" alt="3">';
            break;
        }
      });
    },
  });
});
