<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard VU library Management System </title>


    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/nprogress.css" rel="stylesheet">
    <link href="css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="viewstudents.php" class="site_title"><i class="fa fa-book"></i> <span>VU Library</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_info">
                        <span>Welcome,</span>

                        <h2><?php $name=$_SESSION['sessionid'];
                        echo $name;
                        ?></h2>
                    </div>
                    <div class="clearfix"></div>
                </div>
                

                <br/>

                
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">

                        <ul class="nav side-menu">

                           

                            <li><a href="dashboard.php">Home</a></li>
                            <li><a href="addcategory.php">Add Category</a></li>
                            <li><a href="viewcategory.php">View Category</a></li>
                            <li><a href="addauthor.php">Add Author</a></li>
                            <li><a href="viewauthor.php">View Author</a></li>
                            <li><a href="addbook.php">Add books</a></li>
                            <li><a href="viewbook.php">View books</a></li>
                            <li><a href="issuebook.php">Issue books</a></li>
                            <li><a href="viewissue.php">View issued books</a></li>
                            <li><a href="viewreserve.php">View reserved books by Student</a></li>
                            <li><a href="viewstudents.php">View Students</a></li>
                            <li><a href="addadmins.php">Add Admin</a></li>

                            
                        </ul>
                    </div>


                </div>

            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="false">
                                <?php $name=$_SESSION['sessionid'];
                        echo $name;
                        ?>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="logout.php">Log Out</a></li>
                            </ul>
                        </li>

                        
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->
