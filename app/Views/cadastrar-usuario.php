			<div class="row">
        <div class="col-12">
          <!-- Cadastrar Usuário -->
          <h3 style="margin-bottom: .8em">Cadastrar Usuário</h3>
          <form action="" method="post">
            <?= csrf_field() ?>
            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="cpf">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" pattern="[0-9]{11}" required>
              </div>
              <div class="form-group col-md-7">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
              </div>
              <div class="form-group col-md-2">
                <label for="perfil">Perfil</label>
                <select id="perfil" name="perfil" class="form-control">
                  <option selected>Usuário</option>
                  <option>Administrador</option>
                </select>
              </div>
            </div>
            <!-- <div class="form-row">
              <div class="form-group col-12">
                <label for="localizacao">Localização</label>
                <input type="text" class="form-control" id="localizacao" name="localizacao" placeholder="Localização ou CEP">
              </div>
            </div> -->
            <div class="form-row d-none">
              <div class="form-group col-md-6">
                <label for="latitude">Latitude</label>
                <input type="text" class="form-control" id="latitude">
              </div>
              <div class="form-group col-md-6">
                <label for="longitude">Longitude</label>
                <input type="text" class="form-control" id="longitude">
              </div>
            </div>
            <hr>
            <div class="text-right">
              <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
          </form>
        </div><!-- / Form Cadastro Usuario -->
      </div>