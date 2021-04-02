<!DOCTYPE html>
<html>
<head>
    <title>CRUD Professor</title>

    <!-- bootstrap Lib -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- datatable lib -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style type="text/css">
        .tabelaprof{
            max-width: 800px;
            margin: auto;
        }

        h1{
            text-align: center;
            padding-bottom: 60px;
        }
    </style>

</head>
<body>
<div class="tabelaprof">
     <h1>CRUD Professor</h1>

               <table id="tabela_professor" class="table table-striped">
                    <thead bgcolor="#006400">
                        <tr class="table-primary">
                           <th width="20%">Codigo</th>
                           <th width="40%">Nome professor</th>
                           <th width="30%">cpf</th>
                           <th width="30%">Data de Nascimento</th>
                           <th width="30%">Disciplina</th>
                           <th scope="col" width="5%">Editar</th>
                           <th scope="col" width="5%">Deletar</th>
                        </tr>
                    </thead>
                </table>
                <br>
                <div align="right">
                <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-success">Cadastrar</button>
                </div>
</div>
</body>
</html>

<div id="userModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="professor_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Cadatrar</h4>
                </div>
                <div class="modal-body">
                    <label>Digite seu nome:</label>
                    <input type="text" name="nome" id="nome" class="form-control"/><br>
                    <label>Digite seu Cpf:</label>
                    <input type="text" name="cpf" id="cpf" class="form-control"/><br>
                    <label>Digite sua data de nascimento:</label>
                    <input type="text" name="datanas" id="datanas" class="form-control"/><br>
                    <label>Digite o nome da disciplina:</label>
                    <input type="text" name="disciplina_id" id="disciplina_id" class="form-control"/><br>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="professor_id" id="professor_id"/>
                    <input type="hidden" name="operation" id="operation"/>
                    <input type="submit" name="action" id="action" class="btn btn-primary" value="Adicionar" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#add_button').click(function(){
            $('#professor_form')[0].reset();
            $('.modal-title').text("Cadastro do Professor");
            $('#action').val("Adicionar");
            $('#operation').val("Adicionar")
        });

     var dataTable = $('#tabela_professor').DataTable({
        "paging":true,
        "processing":true,
        "serverSide":true,
        "order": [],
        "info":true,
        "ajax":{
            url:"buscar.php",
            type:"POST"
        },
        "columnDefs":[
           {
            "target":[0,3,4],
            "orderable":false,
           },
        ],
     });

     $(document).on('submit', '#professor_form', function(event){
        event.preventDefault();
        var id = $('#id').val();
        var nome = $('#nome').val();
        var cpf = $('#cpf').val();
        var datanas = $('#datanas').val();
        var disciplina_id = $('#disciplina_id').val();

        if(nome != '' && cpf != '' && datanas != '' && disciplina_id != '')
        {
            $.ajax({
                url:"inserir.php",
                method:'POST',
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    $('#professor_form')[0].reset();
                    $('#userModal').modal('hide');
                    dataTable.ajax.reload();
                }
            });
        }
        else
        {
            alert("Campo obrigatorio");
        }
    });

    $(document).on('click', '.update', function(){
        var professor_id = $(this).attr("id");
        $.ajax({
            url:"busca_simples.php",
            method:"POST",
            data:{professor_id:professor_id},
            dataType:"json",
            success:function(data)
            {
                $('#userModal').modal('show');
                $('#id').val(data.id);
                $('#nome').val(data.nome);
                $('#cpf').val(data.cpf);
                $('#datanas').val(data.datanas);
                $('#disciplina_id').val(data.disciplina_id);
                $('.modal-title').text("Cadastro do Professor");
                $('#professor_id').val(professor_id);
                $('#action').val("Salvar");
                $('#operation').val("Editar");
            }
        });
     });

    $(document).on('click','.delete', function(){

        var professor_id = $(this).attr("id");
        if(confirm("Quer mesmo deletar esse cadastro de professor?"))
        {
            $.ajax({
                url:"delete.php",
                method:"POST",
                data:{professor_id:professor_id},
                success:function(data)
                {
                    dataTable.ajax.reload();
                }
            });
        }
        else
        {
            return false;
        }
     });

    });
</script>
      