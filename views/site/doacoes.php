<section class="container">
	<div class="row">
		<div class="col-12 text-center mt-5">
			<h1>Doações</h1>
		</div>
		<div class="col-6 text-center mb-5 mt-5">
			<h2>Você precisa de ajuda?</h2>
			<p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			<button class="btn btn-success btn-inicio-cadastro" data-type="recebedor" data-toggle="modal" data-target="#exampleModal">Começar Agora</button>
		</div>

		<div class="col-6 text-center mb-5 mt-5">
			<h3>Você deseja ajudar? </h3>
			<p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			<button class="btn btn-success btn-inicio-cadastro" data-type="doador"  data-toggle="modal" data-target="#exampleModal">Começar Agora</button>
		</div>
	</div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
        	<div class="form-group">
        		<label>Nome</label>
        		<input type="text" name="Nome" class="form-control">
        	</div>
        	<div class="form-group">
        		<label>E-mail</label>
        		<input type="text" name="Email" class="form-control">
        	</div>
        	<div class="form-group">
        		<label>Telefone</label>
        		<input type="text" name="Telefone" class="form-control">
        	</div>
        	<div class="form-controu">
        		<label>CPF ou RG</label>
        		<input type="text" name="CPF-RG" class="form-control">
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btn-cadastro">Salvar</button>
      </div>
    </div>
  </div>
</div>