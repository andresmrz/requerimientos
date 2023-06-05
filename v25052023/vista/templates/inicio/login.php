<div class=" contenedor-login">
  <div class="estilo-contenedor">
    <div class="row">
      <div class="col-sm-12">
        <div class="titulo-login">Inicio de Sesión</div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="login-divider">o</div>
      </div>
    </div>
    <br>

    <div class="row">
      <div class="col-sm-12">
        <form name="loginform" id="loginform" action="javascript: iniciarSesion()">
          
          <div class="row">
            <div class="col-sm-12">
              <div class="alert alert-danger" id="login-alerta" style="display: none;"></div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="user_login">Usuario</label>
                <input type="text" class="form-control input-login" type="text" name="login-usuario" id="login-usuario" autocomplete="off" placeholder="Ingrese su usuario" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="user_pass">Contraseña</label>
                <input type="password" class="form-control input-login" name="login-password" id="login-password" placeholder="Ingres su contraseña" autocomplete="off" required>
              </div>
            </div>
          </div>
          <br>

          <div class="row">
            <div class="col-sm-12">
              <button name="wp-submit" id="wp-submit" class="btn btn-primary input-login" style="width: 100%;"><b>Ingresar</b></button>
            </div>
          </div>

          <br>
          <!--<div class="row">
            <div class="col-sm-6">
              <a href="?olvido_password" class="olvido-login"><b>No sé mi clave</b></a>
            </div>
            <div class="col-sm-6">
              <a href="?registrarse" class="registrarse-login"><b>Crear cuenta</b></a>
            </div>
          </div>-->
        </form>
      </div>
    </div>      
  </div>
</div>