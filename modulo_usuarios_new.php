<!doctype html>
<html lang="en" data-bs-theme="auto">
<?php include("head.php"); ?>

<body>
  <?php include("iconos.php"); ?>
  <?php include("header.php"); ?>

  <div class="container-fluid">
    <div class="row">
      <?php include("menu.php"); ?>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Usuarios</h1>
          <a href="modulo_usuarios_list.php" class="btn btn-primary">Volver</a>
        </div>

        <div class="col-4">
          <form action="#" method="post" enctype="multipart/form-data" id="formularioAlex">

            <div class="mb-3">
              <label for="usuario" class="form-label">Usuario</label>
              <span id="usuario_error" class="text-danger"></span>
              <input type="text" class="form-control" id="usuario" name="usuario" placeholder="usuario">
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <span id="password_error" class="text-danger"></span>
              <input type="password" class="form-control" id="password" name="password" placeholder="password">
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <span id="email_error" class="text-danger"></span>
              <input type="text" class="form-control" id="email" name="email" placeholder="email">
            </div>

            <div class="mb-3">
              <label for="id_roles" class="form-label">Role</label>
              <span id="id_roles_error" class="text-danger"></span>
              <select class="form-control" id="id_roles" name="id_roles">
                <option></option>
                <?php echo SelectOptionsId("roles", "role"); ?>
              </select>
            </div>

            <div class="mb-3">
              <input type="button" class="form-control" value="Aceptar" id="btnform1">
            </div>

          </form>
        </div>

      </main>


    </div>
  </div>
  <?php include("scripts.php"); ?>


  <script>
    $(document).ready(function() {

      $("#btnform1").click(function() {
        // Swal.fire("SweetAlert2 is working!");

        //Primero atrapamos lo que escribio el usuario
        let id_roles = $("#id_roles").val();
        let usuario = $("#usuario").val();
        let password = $("#password").val();
        let email = $("#email").val();
        let error = 0;

        //------------------si da error---------------
        if (id_roles == "") {
          error = 1;
          $("#id_roles_error").html("Debe seleccionar un role");
          $("#id_roles").addClass("borderError");
        }

        if (usuario == "") {
          error = 1;
          $("#usuario_error").html("Debe introducir un nombre de usuario");
          $("#usuario").addClass("borderError");
        }

        if (password == "") {
          error = 1;
          $("#password_error").html("Debe introducir una contrasenia");
          $("#password").addClass("borderError");
        }
        if (email == "") {
          error = 1;
          $("#email_error").html("Debe introducir un email");
          $("#email").addClass("borderError");
        }
        //------------------si NO da error---------------
        if (error == 0) {
          //$("#form1").submit();
          $.ajax({
            //usamos serialize para pasar todos los datos(cuando sean muchos)
            data:$("#formularioAlex").serialize() ,
            method: "POST",
            url: "modulo_usuarios_insert.php",
            success: function(result) {
              alert(result);
              if (result > 1) {
                //alert("Datos insertados correctamente!");
                let timerInterval;
                Swal.fire({
                  title: "Datos insertados correctamente!",
                  html: "",
                  timer: 2000,
                  timerProgressBar: true,
                  didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                      timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                  },
                  willClose: () => {
                    clearInterval(timerInterval);
                  }
                }).then((result) => {
                  /* Read more about handling dismissals below */
                  if (result.dismiss === Swal.DismissReason.timer) {
                    location.href = "modulo_usuarios_list.php";
                  }
                });
              } else {
                Swal.fire("No Insertado correctamente!");

              }
            }
          });
        }

      });

    });
  </script>
</body>

</html>