<!DOCTYPE html>
<html>
<head>
    <title>Lista da disciplina</title>

    <!-- bootstrap Lib -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- datatable lib -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style type="text/css">
        .tabela{
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
<div class="tabela">
     <h1>Lista da disciplina</h1>

               <table id="disciplina_tabela" class="mesa listrada">
                    <thead bgcolor="#008080">
                        <tr class="tabela_primaria">
                           <th width="20%">Codigo</th>
                           <th width="40%">Disciplina</th>
                           <th width="30%">Professor</th>
                           <th width="30%">Aluno(s)</th>
                           <th scope="col" width="5%">Editar</th>
                           <th scope="col" width="5%">Deletar</th>
                        </tr>
                    </thead>
                </table>
                <br>
                <div align="right">
                <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-success">Inserir</button>
                </div>
</div>
</body>
</html>

<div id="userModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="form_disciplina" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Inserir</h4>
                </div>
                <div class="modal-body">
                    <label>Insire uma disciplina:</label>
                    <input type="text" name="nome" id="nome" class="form-control"/><br>
                     <label>Nome do Professor:</label>
                    <input type="text" name="professor_id" id="professor_id" class="form-control"/><br>
                    <label>Nome do aluno:</label>
                    <input type="text" name="aluno_id" id="aluno_id" class="form-control"/><br> 
                </div> 
                <div class="modal-footer">
                    <input type="hidden" name="disciplina_id" id="disciplina_id"/>
                    <input type="hidden" name="operacao" id="operacao"/>
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
            $('#form_disciplina')[0].reset();
            $('.modal-title').text("Inserindo uma disciplina");
            $('#action').val("Adicionar");
            $('#operacao').val("Adicionar")
        });

     var dataTable = $('#disciplina_tabela').DataTable({
        "paging":true,
        "processing":true,
        "serverSide":true,
        "order": [],
        "info":true,
        "ajax":{
            url:"buscardi.php",
            type:"POST"
        },
        "columnDefs":[
           {
            "target":[0,3,4],
            "orderable":false,
           },
        ],
     });

     $(document).on('submit', '#form_disciplina', function(event){
        event.preventDefault();
        var id = $('#id').val();
        var nome = $('#nome').val();
        var nome = $('#professor_id').val();
        var nome = $('#aluno_id').val();

        if(nome != '' && professor_id != '' && aluno_id != '')
        {
            $.ajax({
                url:"inserirdi.php",
                method:'POST',
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    $('#form_disciplina')[0].reset();
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
        var disciplina_id = $(this).attr("id");
        $.ajax({
            url:"buscar_simplesdi.php",
            method:"POST",
            data:{disciplina_id:disciplina_id},
            dataType:"json",
            success:function(data)
            {
                $('#userModal').modal('show');
                $('#id').val(data.id);
                $('#nome').val(data.nome);
                $('#professor_id').val(data.professor_id);
                $('#aluno_id').val(data.aluno_id);
                $('.modal-title').text("Inserindo Disciplina");
                $('#disciplina_id').val(disciplina_id);
                $('#action').val("Salvar");
                $('#operacao').val("Editar");
            }
        });
     });

    $(document).on('click','.delete', function(){

        var disciplina_id = $(this).attr("id");
        if(confirm("Quer mesmo deletar essa disciplina?"))
        {
            $.ajax({
                url:"deletedi.php",
                method:"POST",
                data:{disciplina_id:disciplina_id},
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
      