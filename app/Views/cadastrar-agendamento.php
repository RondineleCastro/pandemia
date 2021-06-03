			<div class="row">
        <div class="col-12">
          <!-- Solicitar Imunizante -->
          <h3 style="margin-bottom: .8em">Solicitar Imunizante</h3>
          <form action="" method="post">
            <?= csrf_field() ?>
            <div class="row">
              <div class="col-12 col-md-6 my-1">
                <button type='button' id="btn-vacina" class="btn btn-primary btn-lg btn-block">Vacina</button>
              </div>
              <div class="col-12 col-md-6 my-1">
                <button type="button" id="btn-medicamento" class="btn btn-secondary btn-lg btn-block">Medicamento</button>
              </div>
              <div class="form-check-inline d-none">
                  <input type="radio" class="form-check-input" name="tipo">Vacina
                  <input type="radio" class="form-check-input" name="tipo">Medicamento
              </div>
            </div>
            <div id="div-input-check" class="form-row mt-4" style="display:none">
              <div class="form-group col-12">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="gridCheck">
                  <label class="form-check-label" for="gridCheck">
                    Estou solicitando para outra pessoa.
                  </label>
                </div>
              </div>
              <div id="div-input-dt_contaminacao" class="form-group col-md-6" style="display:none">
                <label for="dt_contaminacao">Data de Contaminação</label>
                <input type="date" class="form-control form-control-lg" id="dt_contaminacao" name="dt_contaminacao" required>
              </div>
              <div id="div-input-dt_recuperacao" class="form-group col-md-6" style="display:none">
                <label for="dt_retorno_movimentos">Data de Recuperação dos Movimentos</label>
                <input type="date" class="form-control form-control-lg" id="dt_retorno_movimentos" name="dt_retorno_movimentos">
              </div>
            </div>
            <hr>
            <div class="text-right">
              <button type="submit" class="btn btn-primary">Solicitar</button>
            </div>
          </form>
        </div> <!-- / Solicitar Imunizante -->
      </div>