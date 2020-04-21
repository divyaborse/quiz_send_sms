<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>js/add_data.js"></script>
    <style>
        a:hover {
            color: #fff;
        }

        .body {
            overflow-x: hidden !important;
            min-width: 200px !important;
            margin-bottom: 35rem !important;
        }

        @media (max-width:500px) {
            .add_quiz {
                font-size: 1.4rem;
                /* padding-left:1.5rem; */
            }
        }
        
        .contact-btn {
            background: #27293D !important;
            color: white !important;
            outline: none;
            transition: 0.2s ease;
            border: 1px solid transparent;
            font-size: 1.2rem;
            font-weight: bold
        }

        .contact-btn:hover {
            background: white !important;
            color: #27293D !important;
            border: 1px solid #27293D;
        }

        .contact-btn2 {
            background: white !important;
            color: #27293D !important;
            outline: none;
            transition: 0.2s ease;
            border: 1px solid #27293D !important;

        }

        .contact-btn2:hover {
            background: #27293D !important;
            color: white !important;
            border: 1px solid transparent;
        }
    </style>
    <script src="https://hinkhoj.com/common/js/keyboard.js"></script>
    <link rel="stylesheet" type="text/css" href="https://hinkhoj.com/common/css/keyboard.css" />
</head>
<body>
<div class="p-3 body">
    <h3 style="width: 100%;height: 50px; background: #27293d !important; position: relative; color: white;" class="add_quiz p-4">
    <a href="#men-toggle" class="menuopener" id="menu-toggle" style="position: absolute!important;right: 0!important;">
        <i class="fa fa-bars"></i>
    </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Add Quiz
</h3>

    <div class="card  p-3 m-2 mb-3  main " style="background: #dbdbdb;border:none">
        <h5 class="p-2" style="font-weight:bold;font-size:1.7rem">Create Quiz</h5>
        
  <form action="quizset" method="POST" class="form-inline p-2">
            <div class="input-group col-md-2 m-2">
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter Quiz Title" aria-describedby="Enter Quiz Title" required>
            </div>
            <div class="input-group col-md-2 m-2">
                <select id="class" name="class[]" required class="form-control">
                    <option selected disabled value="">Select a Class</option>

                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
            </div>
            <div class="input-group col-md-2 m-2">
                <select id="sub" name="sub[]" class="form-control" required name="subject">
                    
                     <option value="English">English</option>
                    <option value="Maths">Maths</option>
                    
                </select>
            </div>

            <div class="input-group col-md-2 m-2">
                <select id="chapter" class="form-control" required name="chapter[]">
                    <option selected disabled value="">Chapter Number</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                </select>
            </div><br>

            <div class="" style=" display:flex;flex-wrap:wrap;">
                <button type="submit" class="btn contact-btn m-2" style="font-weight:bold;color:white;" name="submit">Submit</button>
                 <a href="<?php echo base_url(); ?>teacher/remove_session" class="btn  float-right contact-btn2 m-2" style="color:white;"><b> Back </b></a>

            </div>
        </form>
</div>
<?php
if(isset($query)){
    foreach($query->result() as $row){
        echo '
        <div class="card p-3 m-2" style="background: #D0ECE7;">
                <div class="card-header bg-white mx-2">
                    <div class="p-3 mx-3">Quiz <b class="px-2">#'.$row->q_id.'</b>
                        &nbsp; Class <b class="px-2">#'.$row->class.'</b>

                        &nbsp; Title <b class="px-2">#'.$row->title.'</b>

                        &nbsp; Subject <b class="px-2">#'.$row->subject.'</b>
                        <button class="float-right btn btn-outline-danger" data-toggle="modal" data-target="#customQuestionModal"><b>Add Custom Question</b></button></div>
                </div>';
    }
}

    

  

?>
            
    
 <!-- Custom Modal -->
    <div class="modal fade " id="customQuestionModal" tabindex="-1" role="dialog" aria-labelledby="customQuestionModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-success" id="customQuestionModalTitle">To Add Custom Question</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="ajax-contact" action="<?= base_url('volunteer/Dashboard/display_questions') ?>" method="POST">
                    <div class="modal-body">
                        <label for="quizQuestion"> Question:</label>
                        <textarea class="form-control" id="quizQuestion" name="question" placeholder="Enter your question here!!" required aria-required="Eveter the Question" rows="3"></textarea>
                        
                    </div>
                    <div class="card-footer">
             <button class="btn btn-primary btn-lg" type="submit" name="submit" id="btnsave">Save Question</button>

                        <a type="button" href=" " style="text-decoration: none;" class="btn btn-lg btn-outline-danger float-right" aria-label="Close">
                            <b>Finish Adding</b>

                        </a>
                        
                    </div>
                    
                </form>
            </div>
        </div>
    </div>


</div>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>
</html>
