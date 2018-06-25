<%@ page import="java.sql.*" %>

<%
         Class.forName("com.mysql.jdbc.Driver");  
%> 

<%
    
    if(request.getParameter("ayd") != null){
        if(session.getAttribute("ayd") == null){
            try{
            Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/tekweb","root","");
            Statement st = con.createStatement();
            int id = Integer.parseInt(request.getParameter("ayd"));
            ResultSet rs = st.executeQuery("SELECT * FROM users WHERE userID = '" + id + "' ");
            if(!rs.next()){
                }
                session = request.getSession();
                session.setAttribute("firstname", rs.getString("firstname"));
                session.setAttribute("ayd", id);
            }catch(Exception e){
                System.out.println("Error " + e.toString());
            }
        }
    }else if((session.getAttribute("ayd") != null) && (request.getParameter("ayd") == null)){
        //Do nothing
    }else{
        response.sendRedirect("http://localhost/tekweb/index.php");
    }
    
%>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>
        Material Dashboard by Creative Tim
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet"/>
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/demo/demo.css" rel="stylesheet"/>
</head>

<body class="">
<div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

          Tip 2: you can also add an image using data-image tag
      -->
        <div class="logo">
            <a href="#" class="simple-text logo-normal">
                <%= session.getAttribute("firstname") %>
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.html">
                        <i class="material-icons">content_paste</i>
                        <p>My Classes</p>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="logout.jsp">
                        <i class="material-icons">notifications</i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
            
   
    <div class="main-panel">
        <!-- Navbar -->

        <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title text-center">My Classes</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class=" text-primary">
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Type
                                        </th>
                                        <th>
                                            
                                        </th>
                                        </thead>
                                        <tbody>
                                            
                                       
                                        
                                        </tbody>
                                    </table>
                                    <hr>
                                    <form action="joinClass.jsp" method="post">
                                        <div class="row">
                                            <div class="col-md-2">
                                              <div class="form-group">
                                                <input type="text" name="code" class="form-control" placeholder="Code" style="width: 100px;" />
                                              </div>
                                            </div>
                                            <div class="col-md-2">
                                              <div class="form-group">
                                               <input type="submit" class="btn btn-info" value="Add Class">
                                              </div>
                                            </div>
                                          </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
            
            
</div>
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
<script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Chartist JS -->
<script src="assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="assets/js/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/demo/demo.js"></script>
</body>

</html>