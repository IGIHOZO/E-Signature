<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>ULK - Students financial derogation</title>

    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-dark p-t-100 p-b-50">
        <div class="wrapper wrapper--w900">
            <div class="card card-6">
                <div class="card-heading">
                    <h2 class="title">ULK - Student-Documents request form <a href="" style="float: right;">Home</a></h2>
                </div>
                <?php
                if (isset($_GET['done'])) {
                    ?>
                <div class="card-body">
                        <div class="form-row">
                        <div class="alert alert-success" role="alert" style="font-weight: bolder;font-size: 20px">
                          Your Derogation has been successfully submited to ULK-DAF office. You have to keep checking for its response on this link.
                          <label style="float: right;text-decoration: underline;"><a href="index">Logout</a></label>
                        </div>
                        </div>
                </div>
                    <?php
                }else{

                ?>
                <div class="card-body">
                    <form method="POST" action="student-request">
                        <div class="form-row">
                            <div class="name">Enter Your Rollnumber</div>
                            <div class="value">
                                <input class="input--style-6" type="number" name="roll" placeholder="Rollnumber" required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <button class="btn btn--radius-2 btn--blue-2" type="submit">Next &nbsp;&nbsp; >></button>
                        </div>
                    </form>
                </div>
                <?php
                }
                ?>
                <div class="card-footer">
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>


    <!-- Main JS-->
    <script src="js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->