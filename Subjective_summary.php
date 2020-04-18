<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
    <div class="container p-3">
        <div class="card shadow-lg m-3 p-4">
            <?php
            if (isset($summary)) {
            ?>
            <?php
                
                        foreach ($summary->result() as $row) { ?>
                           
                
                <?php } }?>
                <div class="alert text-center alert-success" role="alert">
                    <u>
                        <h3>Quiz Summary!!</h3>
                    </u>
                    <div class="d-flex justify-content-between">
                        <h3>
                          Quiz Id: <?= $row->ques_id ?>
                        </h3>
                        <h3>
             <!--   User Id: <?= $this->session->userdata('Other_logged')['id']; ?>-->
                        </h3>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Question </th>
                            <th>Response</th>
                           
                        </tr>
                        
                 <tr>
                                <td><?= $row->question ?></td>
                                <td><?= $row->answer ?></td>
                               
                            </tr>
                        
                    </table>

                </div>
            
            <h1 class="p-2 m-2 text-center"><span class="badge badge-info p-2">Your Score: <?= $row->score; ?></span></h1>
           
            
            <h4> <a href="<?= base_url('Subjective_quiz_summary') ?>" class="btn btn-outline-success btn-lg">Go to Dashboard</a></h4>
        </div>
    </div>
</body>

</html>