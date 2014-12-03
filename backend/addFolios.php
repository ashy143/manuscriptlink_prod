<?php
    include_once '../includes/dbconnect.php';
    include_once '../includes/functions.php';

    session_start();
    if(login_check() == false){
        header("location: ../index.php");
    }

    $edit = false;
    if(isset($_GET['id'])){
      $edit = true;
    }

?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>manuscriptlink</title>

        <!-- Bootstrap -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/mslink.css" rel="stylesheet">
        <link href="../css/backendforms.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet' type='text/css'>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="../js/jquery-ui.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/gen_validatorv31.js" type="text/javascript"></script>
        <style>
            .form-horizontal .control-label{
                padding-top: 7px;
                text-align: right;;
            }

            .table{
                width: 300px;
                height: 500px;
                overflow-y: auto;
                border: 1px solid black;
            }

            thead th {
                background-color: black;
                height: 30px;
                color: red;
            }

            tbody td, thead th {
                width: 100%;
                /*float: left;*/
            }
        </style>
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-3" id="logo"><a href="../index.php"><img src="../img/logo.png" /></div>
                <div class="col-md-9" style=" height: 55px;">
                    <ul class="link-nav pull-right">
                        <li ><a href="manuscripts.php">manuscripts</a></li>
                        <li class="active" ><a href="#">folios</a></li>
                        <li ><a href="#">Admin Panel (Scott Gwara)</a></li>
                    </ul>
                </div>
            </div>

            <?php if(login_check()) {?>
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb pull-right">
                        <li ><a href="../index.php">home</a></li>
                        <li><a href="../utils/process_logout.php">logout</a></li>
                    </ol>
                    <ol class="breadcrumb pull-right">
                        <li ><a href="./folios.php">view</a></li>
                        <?php if($edit) { ?>
                            <li class="active">edit</li>
                            <li ><a href="./addFolios.php">add</a></li>
                        <?php } else { ?>
                            <li><a>edit</a></li>
                            <li class="active">add</li>
                        <?php } ?>
                        <li ><a href="./publishFolios.php">unpublished</a></li>
                    </ol>
                </div>
            </div>
            <?php } ?>

        </div>


        <div id="matchbox">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-md-offset-0">
                        <div id="form-box">
                            <?php include './folio_form.php' ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function(){

                
                function getTableRow(data){
                    var row = '';
                    row += "<tr>" ;
                    row += "<td>" + data.mlink_part + "</td>" ;
                    row += "<td data-id=" + data.mscript_id + "> <input type='button' class = 'btn-success edit_btn' value = 'Edit'></td>" ;
                    row += "</tr>" ;

                    return row;
                };

                $.ajax({
                    url: 'searchManuscripts.php',
                    type: 'GET',
                    dataType: 'json',
                    url: 'searchManuscripts.php',
                    data: { search_text : '' },
                    success: function(data){
                        $.map( data, function(item) {
                            $("table tbody").append(getTableRow(item));
                        });
                    }
                });

                $(".table").delegate('.edit_btn', 'click', function(){
                    window.location.href = 'manuscripts.php?id=' + $(this).parent().data('id');
                });
            
                $("#mlinkno").on("keyup paste", function() {
                    var value = $(this).val().toUpperCase();
                    var $rows = $("table tr");

                    if(value === ''){
                        $rows.show();
                        return false;
                    }

                    $rows.each(function(index) {
                        if (index !== 0) {

                            $row = $(this);

                            var column1 = $row.find("td:first").html().toUpperCase();

                            if ((column1.indexOf(value) > -1) ) {
                                $row.show();
                            }
                            else {
                                $row.hide();
                            }
                        }
                    });

                });

            });    
        </script>
            
        
    </body>
</html>

