
<!DOCTYPE html>
<link href="<?= base_url("asset/bootstrap/css/bootstrap.min.css"); ?>" rel="stylesheet">
<link href="<?= base_url("asset/bootstrap/css/bootstrap-responsive.css"); ?>" rel="stylesheet">
<link href="<?= base_url("asset/bakstyle.css"); ?>" rel="stylesheet">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>TFace</title>
    
</head>
<body>  
    <div class="container">
        <div class="offset2 span8 "   id="result"  align="center">
            <table class="table table-bordered">
                <thead>
                    <th>#</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>fontID</th>
                    <th>Score</th>
                </thead>
                <tbody>
                    <?php foreach ($scorereport as $index=>$score): ?>
                    <tr>
                        <td><?=$index+1 ?></td>
                        <td><?=$score->Username?></td>
                        <td><?=$score->Name.' '.$score->Lastname?> </td>
                        <td><?=$score->fontID?> </td>
                        <td><?=$score->score?> </td>
                    </tr>
                <?php endforeach; ?>



            </tbody>


        </table>

    </div>

</div>
</body>
</html>



