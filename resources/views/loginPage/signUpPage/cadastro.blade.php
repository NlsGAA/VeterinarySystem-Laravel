<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/css/cadastro.css">
  </head>
  <body>
    <div id="header_all"> 
        <div>
          <img src="/img/logo.png" class="logo" >
        </div>
        <div class="cabecalho">
            <h1>Cadastre-se</h1>
        </div>
    </div>
    <div class="offset-lg-4 form-body">
        <form method='POST' action="/signUpPage">
            @csrf
            <div class="header-form-nome-sobrenome">
                <div class="header-form-item">
                    <input class="form-control input-custom" type="text" name="nome" placeholder="Nome">
                </div>
                <div class="header-form-item">
                    <input class="form-control input-custom" type="text" name="sobrenome" placeholder="Sobrenome">
                </div>
            </div>
            <div>
                <div class="header-form-item">
                    <input class="form-control input-custom" type="number" name="cpf" placeholder="CPF">
                </div>
                <div class="header-form-item">
                    <input class="form-control input-custom" type="date" name="dataNascimento" placeholder="Data de Nascimento">
                </div>
                <div class="header-form-item">
                    <input class="form-control input-custom" type="text" name="telefone" placeholder="Telefone">
                </div>
                <div class="header-form-item">
                    <input class="form-control input-custom" type="email" name="email" placeholder="E-mail">
                </div>
                <div class="header-form-item input_password">
                    <input class="form-control input-custom password" type="password" name="senha" placeholder="Senha">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash see_pass" viewBox="0 0 16 16">
                        <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                        <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                        <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
                    </svg>
                </div>
                <div class="header-form-item check_terms" style="padding-left: 10px;">
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            value=""
                            id="flexCheckChecked"
                        >
                        <label class="form-check-label" for="flexCheckChecked">
                            Li e concordo com os termo de uso
                        </label>
                        <div id="page-login">
                            <span>Já possui conta? Faça <a href="/login">login </a></span>
                        </div>
                    </div>
                </div>
                <div class="header-form-item">
                    <button class="btn btn-success btn-custom">CADASTRAR</button>
                </div>
            </div>
        </form>
    </div>


    <script src="/assets/cadastro.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>