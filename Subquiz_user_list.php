
	<h3 style="width: 100%;height: 50px; background: #27293d !important; position: relative; color: white;" class="p-4">
    <a href="#menu-toggle" class="menuopener" id="menu-toggle" style="position: absolute!important;right: 0!important;">
        <i class="fa fa-bars"></i>
    </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Student List
</h3>

<div class="container p-2">
	   <?php if (isset($query)) : ?>
	   <table class="table text-center ">
            <thead>
                <tr class="bg-secondary">
                    <td scope="col">#</td>
                    <td scope="col">Id</td>
                    <td scope="col">Score</td>
                    <td scope="col">Attemped At</td>
                </tr>
            </thead>
            <tbody>
                <?php $count = 0;

                foreach ($query as $row) : ?>
                    <tr>
                        <td scope="row"><?= ++$count; ?></td>
                        <td><?= $row['ques_id']; ?></td>
                        <td>0</td>
                        <td><?= $row['date']; ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        
    <?php else : ?>
        <div class="jumbotron mt-4">
            <h3 class="display-4">Quiz yet to attempt!!</h3>
            <p class="lead">Go back to dashboard and share more...</p>
            <a class="btn btn-primary btn-lg" href="<?= base_url('Teacher_subquiz/dashboard') ?>" role="button">Dashboard</a>
        </div>
    <?php endif ?>
</div>
