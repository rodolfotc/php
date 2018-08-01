<!doctype html>
<html lang="pt-br">
    <head>
        <title>MyTest</title>
        <meta charset="utf-8" />
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="bootstrap/css/dashboard.css" rel="stylesheet" type="text/css"/>
        <link href="css/painel.css" rel="stylesheet" type="text/css"/>
        <link href="css/select2.css" rel="stylesheet" type="text/css"/>     
        <link href="css/bootstrap-datepicker.css" rel="stylesheet">
        <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/bootstrap-datepicker.js"></script>
        
        <link rel="shortcut icon" href="../img/favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <script src="js/script.js" type="text/javascript"></script>
        <script src="js/select2.full.js" type="text/javascript"></script>
    </head>
 <body>

    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="?pagina=home">My test</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">

        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-2 col-md-1 sidebar">


        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-11 col-md-offset-1 main">
<div id="dvUsuarioView">
    <h1>Gerenciar Usuários</h1>
    <br />
    <br />
    <!--DIV CADASTRO -->
        <div class="panel panel-default maxPanelWidth">
            <div class="panel-heading"></div>
            <div class="panel-body">
                <form method="post" id="frmGerenciarUsuario" name="frmGerenciarUsuario" novalidate>
                    <div class="row">
                        <div class="col-lg-12">
                            <p id="pResultado"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-xs-12">
                            <div class="form-group">
                                <input type="hidden" id="txtIdUsuario" value="<?= $id; ?>" />
                                <label for="txtNome">Nome completo</label>
                                <input type="text" class="form-control" id="txtNome" name="txtNome" placeholder="Nome completo" >
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12">
                            <div class="form-group">
                                <label for="txtEmail">E-mail</label>
                                <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="email@dominio.com">
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-lg-6 col-xs-12">
                            <div class="form-group">
                                <label for="txtSenha">Senha <span class="vlSenha"></span></label>
                                <input type="password" class="form-control" id="txtSenha" name="txtSenha" placeholder="*******"/>
                            </div>
                        </div>

                        <div class="col-lg-6 col-xs-12">
                            <div class="form-group">
                                <label for="txtSenha2">Confirmar senha <span class="vlSenha"></span></label>
                                <input type="password" class="form-control" id="txtSenha2" name="txtSenha2" placeholder="*******"  />
                            </div>
                        </div>
                    </div>
                    <input class="btn btn-success" type="submit" name="btnGravar" value="Salvar">
                    <a href="?pagina=usuario" class="btn btn-danger">Cancelar</a>

                    <br />
                    <br />
                    <div class="row">
                        <div class="col-lg-12">
                            <ul id="ulErros"></ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    




<script src="js/mask.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {

        if (getCookie("msg") == 1) {
            document.getElementById("pResultado").innerHTML = "<div class=\"alert alert-success\" role=\"alert\">Usuário cadastrado com sucesso.</div>";
            document.cookie = "msg=0";
        } else if (getCookie("msg") == 2) {
            document.getElementById("pResultado").innerHTML = "<div class=\"alert alert-success\" role=\"alert\">Usuário alterado com sucesso.</div>";
            document.cookie = "msg=0";
        }



        $("#frmGerenciarUsuario").submit(function (e) {
            window.erros = 0;



            if (!ValidarFormulario()) {
                e.preventDefault();
            } else {
                            //envia dados para salvar

            var nome =  $("#txtNome").val();
            var email =  $("#txtEmail").val();
            var password = $("#txtSenha").val();

            var dados = {}
            dados['nome'] = nome;
            dados['email'] = email;
            dados['password'] = password;


            var jsonEnvio = JSON.stringify(dados);

            $.ajax({
            url: "user/create.php",
            type: "POST",
                dataType: "html",   
                data: {
                    parametro: "teste",
                    json: jsonEnvio
                },
                success: function( data ) {
           
                }
            });



            }
        });

        var vlSenhas = document.getElementsByClassName("vlSenha");

        $("#txtSenha").keyup(function () {
            ValidarSenha();
            
            if (ValidarSenha()) {
                for (var i = 0; i < vlSenhas.length; i++) {
                    vlSenhas[i].style.color = "green";
                    vlSenhas[i].innerHTML = "válido";
                }
            } else {
                for (var i = 0; i < vlSenhas.length; i++) {
                    vlSenhas[i].style.color = "red";
                    vlSenhas[i].innerHTML = "inválido";
                }
            }
            
        });
        
 
        $("#txtSenha2").keyup(function () {
            ValidarSenha();
           
            if (ValidarSenha()) {
                for (var i = 0; i < vlSenhas.length; i++) {
                    vlSenhas[i].style.color = "green";
                    vlSenhas[i].innerHTML = "válido";
                }
            } else {
                for (var i = 0; i < vlSenhas.length; i++) {
                    vlSenhas[i].style.color = "red";
                    vlSenhas[i].innerHTML = "inválido";
                }
            }
            
        });
        

    });

    function ValidarSenha() {
        var passwordValid1 = $("#txtSenha").val();
        var passwordValid2 = $("#txtSenha2").val();

        //var passwordValid = "A10b20C30fT";
        //var passwordValid = "123456"; 
        //var passwordValid = "abcde"; 

        var upperCase= new RegExp('[^A-Z]');
        var lowerCase= new RegExp('[^a-z]');
        var numbers = new RegExp('[^0-9]');

            
         if (passwordValid1 == passwordValid2 && passwordValid1.length >= 6 && passwordValid2.length >= 6){   

            if(passwordValid1.match(upperCase) && passwordValid1.match(lowerCase) && passwordValid1.match(numbers)){
                
                return true;
            }else{
               
                return false;
            }
         }else{

            return false;
         } 

}





    function ValidarEmailBanco() {

        var emailBanco = $("#txtEmail").val();
        //consulta se existe email no banco.
        var flag = 0;
            $.ajax({
                url: "user/search_email.php",
            type: "GET",
                dataType: "json",   
                data: {
                    email: emailBanco
                },
                success: function( data ) {
                        if (data.email == null | data.email == ""){
                             window.flag = 0; // Globalmente acessível

                        } else {
                            window.flag = 1;
                            var li = document.createElement("li");
                            li.innerHTML = "- E-mail ja foi cadastrado";
                            ulErros.appendChild(li);
                            erros++;
                            window.erros++;

                        }    
                }
        });
            return window.flag;
    }



function ValidarNomeBanco() {

        var nomeBanco = $("#txtNome").val();
        //consulta se existe nome no banco.
        var flag = 0;
            $.ajax({
                url: "user/search_nome.php",
            type: "GET",
                dataType: "json",   
                data: {
                    nome: nomeBanco
                },
                success: function( data ) {
                        if (data.nome == null | data.nome == ""){
                             window.flag = 0; // Globalmente acessível

                        } else {
                            window.flag = 1;
                            var li = document.createElement("li");
                            li.innerHTML = "- Nome ja foi cadastrado";
                            ulErros.appendChild(li);
                            erros++;
                            window.erros++;
                            //alert(window.erros);
                        }    
                }
        });
            return window.flag;
    }


    function ValidarFormulario() {

          var erros = 0;
      
        var ulErros = document.getElementById("ulErros");
        ulErros.style.color = "red";
        ulErros.innerHTML = "";


        //Javascript nativo

        if (document.getElementById("txtNome").value.length < 10) {
            var li = document.createElement("li");
            li.innerHTML = "- Informe um nome válido";
            ulErros.appendChild(li);
            erros++;
            window.erros++;
        }

        

        if (document.getElementById("txtEmail").value.indexOf("@") < 0 || document.getElementById("txtEmail").value.indexOf(".") < 0) {
            var li = document.createElement("li");
            li.innerHTML = "- Informe um e-mail válido";
            ulErros.appendChild(li);
            erros++;
            window.erros++;
        }



        if (!ValidarSenha()){
            var li = document.createElement("li");
            li.innerHTML = "- Senha inválida";
            $("#ulErros").append(li);
            erros++;
            window.erros++;

        }



        ValidarEmailBanco();

        ValidarNomeBanco();
        


        //if (erros === 0) {
        if (window.erros == 0) {
            return true;

        } else {
            return false;

        }

       
    }
</script>

          
          </div>
        </div>
      </div>
    </div>


  </body>
</html>


         





