<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>
  <div id="background-login">
    <div>
      <i class="text-login">Olá, seja bem vindo!</i>
      <div id="loremIp">
        <p>Vivamus euismod dui ac metus feugiat placerat. Nam dignissim ante nec odio viverra bibendum. Proin vehicula mauris magna, semper fermentum est eleifend at. Etiam suscipit suscipit semper. Aliquam erat volutpat. Donec sit amet vestibulum orci, at sodales mauris. Sed et interdum mi, nec iaculis sapien. Vivamus lorem purus, aliquam id libero et, hendrerit varius tellus.</p>
      </div>
    </div>

    <?php  
    
    // $usuarios = json_encode($usuarios);
    // echo $usuarios;

    ?>


    <div id="body_login">
      {{-- <form method="GET" action="/"> --}}
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Usuário</label>
            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Usuário" name="nome">
        </div>
        <div class="mb-3">
          <label for="formGroupExampleInput2" class="form-label">Email</label>
          <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Email">
        </div>
        <div class="mb-3">
          <label for="formGroupExampleInput2" class="form-label">Senha</label>
          <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Senha" name="senha">
        </div>
        <input type="submit" value="Entrar" onclick="loginUser()">
      {{-- </form> --}}
      
      <span>Ainda não possui uma conta?</span>
      <a href="/cadastro">Cadastre-se</a>

    </div>
  </div>  

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>