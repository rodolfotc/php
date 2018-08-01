<div id="dvVisualizarView">
    <h1>Visualizar usuário</h1>
    <br />
    <!--DIV CADASTRO -->
    <div class="panel panel-default maxPanelWidth">
        <div class="panel-heading"><h3>Dados pessoais</h3></div>
        <div class="panel-body">
            <div id="userInput">
                    <div class="row">
                       
                            <div class="col-lg-6 col-xs-12">
                                <div class="detalheExibir">
                                    <h4 class="h4detalhe">Nome</h4>                               
                                    <div id="nomeJquery"></div>
                                </div>
                            </div>
                        

                        <div class="col-lg-6 col-xs-12">
                            <div class="detalheExibir">
                                <h4 class="h4detalhe">E-mail</h4>                               
                                <div id="emailJquery"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-xs-12">
                            <div class="detalheExibir">
                                <h4 class="h4detalhe">Status</h4>                               
                                <div id="statusJquery"></div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12">
                            <div class="detalheExibir">
                                <h4 class="h4detalhe">Password Criptografado</h4>                               
                                <div id="passwordJquery"></div>
                            </div>
                        </div>

    
                    </div>
        </div>
    </div>
    </div>
    <br />

</div>
<style>
    .detalheExibir
{
   background-color:#FFF;
   border: 1px dotted #000000;
   border-radius:1px;
}

     .h4detalhe
     {
         color: #1b6d85;
         margin-left: 10px;
     }
     
     .spanDetalhe
     {
         margin-left: 30px;
         font-size: larger;
         font-style: initial;
         font-weight: bold;
     }
     
     .aExit
     {
         margin-top: 10px;
         margin-left: 10px;
     }
</style>
<?php
   $idGet = $_GET["id"];
?>
<script> var idUser = "<?php echo $idGet ?>"; </script>
<script>

$(document).ready(function () {       
            $.ajax({
                url: "user/read_one.php",
            type: "GET",
                dataType: "json",   
                data: {
                    id: idUser
                },
                success: function( data ) {

                $("#nomeJquery").html( '' );
                        $("#nomeJquery").append('<span class="spanDetalhe bold">'+data.nome+'</span>');
                        $("#emailJquery").append('<span class="spanDetalhe bold">'+data.email+'</span>');
                        $("#statusJquery").append('<span class="spanDetalhe bold">'+data.status+'</span>');
                        $("#passwordJquery").append('<span class="spanDetalhe bold">'+data.password+'</span>');
           }

    });



});
</script>