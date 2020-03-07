<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse All</title>
    <?php include_once("globalCSS.php"); ?>
</head>

<style>
    /* Enforce fixed table width | prevents auto-sizing bug with DataTable */
    table {
        margin: 0 auto;
        width: 100%;
        clear: both;
        border-collapse: collapse;
        table-layout: fixed;
        word-wrap: break-word;
    }
</style>

<body>
    <!-- Page loading indicator -->
    <div class="loader loader-default" data-text="Retrieving..." data-blink></div>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                                <img alt="image" class="img-circle" src="img/a8.jpg" width="35%" />
                            </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Mary
                                            Doe</strong>
                                    </span> <span class="text-muted text-xs block">Customer </span> </span></a>
                        </div>
                        <div class="logo-element">
                            Mer
                        </div>
                    </li>
                    <?php include_once('customerNavbar.php') ?>;
                </ul>
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <a href="logout.php">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="wrapper wrapper-content">
                <div class="row">
                    <!--- All Course Contents---->
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span id="courseContent">
                                    <h5>Past Bookings</h5>
                                </span>
                            </div>
                            <div class="ibox-content">
                                <table id="resultsTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Service Provider(s)</th>
                                            <th>Booking Date</th>
                                            <th>Booking Time</th>
                                            <th>Review</th>
                                        </tr>
                                        <td>1</td>
                                        <td>Agnes</td>
                                        <td>2020-09-01</td>
                                        <td>16:00-17:30</td>
                                        <td>You have yet to leave a review <button>Click here</button></td>
                                    </thead>
                                </table>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="footer">
                <div>
                    <strong>Copyright</strong> &copy; 2020 Paw System Service. All rights reserved.
                </div>
            </div>
        </div>
    </div>

    <!-- Mainly design and utility scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>
    <script src="js/plugins/jasny/jasny-bootstrap.min.js"></script>
    <script src="js/plugins/dropzone/dropzone.js"></script>
    <script src="js/plugins/codemirror/codemirror.js"></script>
    <script src="js/plugins/codemirror/mode/xml/xml.js"></script>
    <script src="js/plugins/dataTables/datatables.min.js"></script>

    <!-- Functionality: Retrieve data using AJAX POST from DataTables
    <script>
        $(document).ready(function() {
            // Display loading indicator
            $(".loader.loader-default").addClass("is-active");

            // Call POST request
            var request;
            request = $.ajax({
                url: "json/dump.php?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6ImFkbWluIiwiZGF0ZXRpbWUiOiIyMDE5LTEwLTI5IDA4OjQ1OjQ2In0.3Udk97YTtixTEXkmpOMXfqlhGy1hmH7osmkxvIZHdcU",
                type: "post",
            });

            // POST Request Success - this is where we receive JSON response results from our back-end
            request.done(function(response, textStatus, jqXHR) {
                // Log response to console (View results in F12 Console tab)
                console.log(response);
                if (response["status"] === "success") initTables(response);
            });

            // POST Request Failure - e.g. no Internet
            request.fail(function(jqXHR, textStatus, errorThrown) {
                console.error("The following error occurred: " + textStatus, errorThrown);
            });

            function initTables(response) {
                $("#resultsTable").DataTable({
                    data: response["course"],
                    searching: false,
                    paging: false,
                    info: false,
                    columns: [{
                            data: 'course'
                        },
                        {
                            data: 'school'
                        },
                        {
                            data: 'title'
                        },
                        {
                            data: 'description'
                        },
                        {
                            data: 'exam date'
                        },
                        {
                            data: 'exam start'
                        },
                        {
                            data: 'exam end'
                        }
                    ]
                });

                $("#sectionTable").DataTable({
                    data: response["section"],
                    searching: false,
                    paging: false,
                    info: false,
                    columns: [{
                            data: 'course'
                        },
                        {
                            data: 'section'
                        },
                        {
                            data: 'day'
                        },
                        {
                            data: 'start'
                        },
                        {
                            data: 'end'
                        },
                        {
                            data: 'instructor'
                        },
                        {
                            data: 'venue'
                        },
                        {
                            data: 'size'
                        }
                    ]
                });

                $("#studentsTable").DataTable({
                    data: response["student"],
                    searching: false,
                    paging: false,
                    info: false,
                    columns: [{
                            data: 'userid'
                        },
                        {
                            data: 'password'
                        },
                        {
                            data: 'name'
                        },
                        {
                            data: 'school'
                        },
                        {
                            data: 'edollar'
                        },
                    ]
                });

                $("#prerequisiteTable").DataTable({
                    data: response["prerequisite"],
                    searching: false,
                    paging: false,
                    info: false,
                    columns: [{
                            data: 'course'
                        },
                        {
                            data: 'prerequisite'
                        }
                    ]
                });

                $("#bidTable").DataTable({
                    data: response["bid"],
                    searching: false,
                    paging: false,
                    info: false,
                    columns: [{
                            data: 'userid'
                        },
                        {
                            data: 'amount'
                        },
                        {
                            data: 'course'
                        },
                        {
                            data: 'section'
                        }
                    ]
                });

                $("#courseTable").DataTable({
                    data: response["completed-course"],
                    searching: false,
                    paging: false,
                    info: false,
                    columns: [{
                            data: 'userid'
                        },
                        {
                            data: 'course'
                        }
                    ]
                });

                // Hide loading indicator
                $(".loader.loader-default").removeClass("is-active");
            }
        })
    </script> -->
</body>

</html>