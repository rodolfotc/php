<?php
require_once ("Controller/UsuarioController.php");
require_once ("Model/Usuario.php");
$usuarioController = new UsuarioController();
$usuario = new Usuario();

    
$id = 0;
$nome = "";
$email = "";
$senha = "";
$status = "";

$resultado = "";
$spResultadoBusca = "";
$listaUsuariosBusca = [];
$opcao = "";

    
if (filter_input(INPUT_POST, "btnGravar", FILTER_SANITIZE_STRING)) {
    
    
    $usuario->setLogin(filter_input(INPUT_POST, "txtLogin", FILTER_SANITIZE_STRING));
    $usuario->setPassword(filter_input(INPUT_POST, "txtSenha", FILTER_SANITIZE_STRING));  
    $usuario->setStatus(filter_input(INPUT_POST, "slStatus", FILTER_SANITIZE_STRING));
    $usuario->setPermissao(filter_input(INPUT_POST, "slPermissao", FILTER_SANITIZE_STRING));
    
    if (!filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT)) {
        //Cadastrar
        if ($usuarioController->Cadastrar($usuario)) {             
   
            ?>
            <script>
                document.cookie = "msg=1";
                document.location.href = "?pagina=usuario&form=s";
            </script>
            <?php
        } else {
            $resultado = "<div class=\"alert alert-danger\" role=\"alert\">Houve um erro ao tentar cadastrar o usuário.</div>";
        }
    } else {
        //Editar
        $usuario->setId(filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING));
         
        if ($usuarioController->Editar($usuario)) {
           $paramScript =  "<script>document.cookie = 'msg=2';document.location.href = '?pagina=usuario&form=s&id=".$usuario->getId()."';</script>";
           
           ?>
           <?= $paramScript; ?>         
            <?php
        } else {
            $resultado = "<div class=\"alert alert-danger\" role=\"alert\">Houve um erro ao tentar alterar o usuário.</div>";
        }
    }
}
        //Buscar usuários

if (filter_input(INPUT_POST, "btnBuscar", FILTER_SANITIZE_STRING)) {

    $termo = filter_input(INPUT_POST, "txtTermo", FILTER_SANITIZE_STRING);
    $tipo = filter_input(INPUT_POST, "slTipoBusca", FILTER_SANITIZE_NUMBER_INT);
    
    //$listaUsuariosBusca = array();
    //$listaUsuariosBusca = $usuarioController->RetornarUsuarios($termo, $tipo);

        if ($listaUsuariosBusca != null) {
            $spResultadoBusca = "Exibindo dados";
        } else {
            $spResultadoBusca = "Dados não encontrado";
        }
} else {
            //consulta
            //carrega array com todos   
            $termoAll = "";
            $tipoAll = 0;
          
            //$listaUsuariosBusca = array();
            //$listaUsuariosBusca = $usuarioController->RetornarUsuarios($termoAll, $tipoAll);

                if ($listaUsuariosBusca != null) {
                    $spResultadoBusca = "Exibindo dados";
                } else {
                    $spResultadoBusca = "Dados não encontrado";
                }
}


if (filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT)) {
    $opcao = "Editar";
    
    //$retornoUsuario = array();
    //$retornoUsuario = $usuarioController->RetornaCod(filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT));

    $usuarioEdt = $retornoUsuario[0][0];
    
    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
    $nome = $pessoafisicaEdt->getNome();
    $email = $pessoafisicaEdt->getEmail();
    $senha = "sim";
    $status = $usuarioEdt->getStatus();

} else {
    $opcao = "Cadastrar";
}


?>

<div id="dvUsuarioView">
    <h1>Gerenciar Usuários</h1>
    <br />
    <div class="controlePaginas">
        <a href="?pagina=usuario"><img src="img/icones/buscar.png" alt=""/></a>
        <a href="?pagina=usuario&form=s"><img src="img/icones/editar.png" alt=""/></a>
    </div>

    <br />
    <!--DIV CADASTRO -->
    <?php
    if (filter_input(INPUT_GET, "form", FILTER_SANITIZE_STRING)) {
        ?>
        <div class="panel panel-default maxPanelWidth">
            <div class="panel-heading"><?= $opcao; ?></div>
            <div class="panel-body">
                <form method="post" id="frmGerenciarUsuario" name="frmGerenciarUsuario" novalidate>
                    <div class="row">
                        <div class="col-lg-12">
                            <p id="pResultado"><?= $resultado; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-xs-12">
                            <div class="form-group">
                                <input type="hidden" id="txtIdUsuario" value="<?= $id; ?>" />
                                <label for="txtNome">Nome completo</label>
                                <input type="text" class="form-control" id="txtNome" name="txtNome" placeholder="Nome completo" value="<?= $nome; ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12">
                            <div class="form-group">
                                <label for="txtEmail">E-mail</label>
                                <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="email@dominio.com"  value="<?= $email; ?>">
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-lg-6 col-xs-12">
                            <div class="form-group">
                                <label for="txtSenha">Senha <span class="vlSenha"></span></label>
                                <input type="password" class="form-control" id="txtSenha" name="txtSenha" placeholder="*******" <?= ($senha) == "" ? "" : "disabled='disabled'"; ?> />
                            </div>
                        </div>

                        <div class="col-lg-6 col-xs-12">
                            <div class="form-group">
                                <label for="txtSenha2">Confirmar senha <span class="vlSenha"></span></label>
                                <input type="password" class="form-control" id="txtSenha2" name="txtSenha2" placeholder="*******" <?= ($senha) == "" ? "" : "disabled='disabled'"; ?> />
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
        <?php
    } else {
        ?>
        <br />
        <!--DIV CONSULTA -->
        <div class="panel panel-default maxPanelWidth">
            <div class="panel-heading">Consultar</div>
            <div class="panel-body">
                <form method="post" name="frmBuscarUsuario" id="frmBuscarUsuario">
                    <div class="row">
                        <div class="col-lg-8 col-xs-12">
                            <div class="form-group">
                                <label for="txtTermo">Termo de busca</label>
                                <input type="text" class="form-control" id="txtTermo" name="txtTermo" placeholder="Ex: fulano de tal" />
                            </div>
                        </div>

                        <div class="col-lg-4 col-xs-12">
                            <div class="form-group">
                                <label for="slTipoBusca">Tipo</label>
                                <select class="form-control" id="slTipoBusca" name="slTipoBusca">
                                    <option value="1">Nome</option>
                                    <option value="2">E-mail</option>
                                    <option value="3">CPF </option>
                                    <option value="4">Usuário </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <input class="btn btn-info" type="submit" name="btnBuscar" value="Buscar"> 
                            <span><?= $spResultadoBusca; ?></span>
                        </div>
                    </div>
                </form>

                <hr />
                <br />

                <table class="table table-responsive table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Cpf</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($listaUsuariosBusca != null) {
                            
                            for($i = 0; $i < count($listaUsuariosBusca[0]); ++$i) {
                                $user = $listaUsuariosBusca[0][$i];                              
                                $pessoa = $listaUsuariosBusca[1][$i];
                                
                                ?>
                                <tr>
                                    <td><?= $pessoa->getNome(); ?></td>
                                    <td><?= $pessoa->getCpf(); ?></td>   
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Opções <span class="caret"></span>
                                            </button>
                                            
                                             
                                            <ul class="dropdown-menu">                          
                                                <li><a href="?pagina=visualizarusuario&id=<?= $user->getId(); ?>">Visualizar</a></li>
                                                 <li role="separator" class="divider"></li>
                                                <li><a href="?pagina=alterarsenha&id=<?= $user->getId(); ?>">Alterar Senha</a></li>
                                                <li><a href="?pagina=usuario&form=s&id=<?= $user->getId(); ?>">Editar</a></li>
                                                <li><a href="?pagina=excluirusuario&id=<?= $user->getId(); ?>">Excluir</a></li> 
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

</div>
<?php } ?>




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
            if (!ValidarFormulario()) {
                e.preventDefault();
            }
        });

        var vlSenhas = document.getElementsByClassName("vlSenha");

        $("#txtSenha").keyup(function () {

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
        var senha1 = $("#txtSenha").val();
        var senha2 = $("#txtSenha2").val();

        if (senha1.length >= 4 && senha2.length >= 4) {
            if (senha1 == senha2) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function ValidarFormulario() {
        var erros = 0;
        var ulErros = document.getElementById("ulErros");
        ulErros.style.color = "red";
        ulErros.innerHTML = "";


        //Javascript nativo
        if (document.getElementById("txtNome").value.length < 5) {
            var li = document.createElement("li");
            li.innerHTML = "- Informe um nome válido";
            ulErros.appendChild(li);
            erros++;
        }



        if (document.getElementById("txtEmail").value.indexOf("@") < 0 || document.getElementById("txtEmail").value.indexOf(".") < 0) {
            var li = document.createElement("li");
            li.innerHTML = "- Informe um e-mail válido";
            ulErros.appendChild(li);
            erros++;
        }



        if (!ValidarSenha() && $("#txtIdUsuario").val() == "0") {
            var li = document.createElement("li");
            li.innerHTML = "- Senhas inválidas";
            $("#ulErros").append(li);
            erros++;
        }







        if (erros === 0) {
            return true;
        } else {
            return false;
        }
    }
</script>
