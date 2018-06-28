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
                <li class="nav-item">
                    <a class="nav-link" href="classes.jsp">
                        <i class="material-icons">content_paste</i>
                        <p>My Classes</p>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="notifications.jsp">
                        <i class="material-icons">content_paste</i>
                        <p>Notifications</p>
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
                                <h4 class="card-title text-center">Announcements</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class=" text-primary">
                                        <th>Subject</th>
                                        <th>Class Code</th>
                                        <th>Instructor</th>
                                        <th>Announcement</th>
                                        </thead>
                                        <tbody>
                                            <%
                                                Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/tekweb","root","");
                                                Statement st = con.createStatement();
                                                Integer id =(Integer) session.getAttribute("ayd");
                                                ResultSet rs = st.executeQuery("SELECT * FROM announcements inner join studentclasses on studentclasses.classID = announcements.classID JOIN classes on announcements.classID = classes.classID JOIN users ON classes.userID = users.userID WHERE studentclasses.studentID ='" + id + "' AND dateOfValidity <= date(now())");
                                                if(!rs.next()){
                                                    out.print("No Announcements");
                                                }else{
                                                    rs.beforeFirst();
                                                    while(rs.next()){
                                                        out.println("<tr><td>" + rs.getString("subject"));
                                                        out.println("</td><td>" + rs.getString("classCode"));
                                                        out.println("</td><td>" + rs.getString("firstname"));
                                                        out.println("</td><td>" + rs.getString("announcement"));
                                                        out.println("</td></tr>");
                                                        
                                                    }
                                                }
                                            %>
                                       
                                        
                                        </tbody>
                                    </table>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                                            
                                            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title text-center">Assignments</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class=" text-primary">
                                        <th>Subject</th>
                                        <th>Class Code</th>
                                        <th>Instructor</th>
                                        <th>Assignment</th>
                                        <th>Deadline</th>
                                        <th>Submit</th>
                                        </thead>
                                        <tbody>
                                            <%
                                                
                                                rs = st.executeQuery("SELECT * FROM assignments inner join studentclasses on studentclasses.classID = assignments.classID JOIN classes on assignments.classID = classes.classID JOIN users ON classes.userID = users.userID WHERE studentclasses.studentID ='" + id +"' AND dateOfSubmission <= date(now())");
                                                if(!rs.next()){
                                                    out.print("No Assignments");
                                                }else{
                                                    rs.beforeFirst();
                                                    while(rs.next()){
                                                        out.println("<tr><td>" + rs.getString("subject"));
                                                        out.println("</td><td>" + rs.getString("classCode"));
                                                        out.println("</td><td>" + rs.getString("firstname"));
                                                        out.println("</td><td>" + "<a download href=http://localhost/tekweb/teacher/uploads/assignments/"+ rs.getInt("assignments.classID") + "/" + rs.getString("filename") + ">" + rs.getString("filename") + "</a>");
                                                        out.println("</td><td>" + rs.getString("dateOfSubmission"));
                                                        out.println("</td><td>" + "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#upload'>Upload Assignment</button>");
                                                        out.println("</td></tr>");
                                                        
                                                    }
                                                }
                                            %>
                                       
                                        
                                        </tbody>
                                    </table>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
            
            
</div>
                                            
                                            <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="joinClass.jsp" method="post">
        <div class="modal-body">
            <input type="text" class="form-control" name="code" placeholder="Subject Code">
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" value="Add">
        </div>
        </form>
    </div>
  </div>
</div>
                                            
<div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action = "uploadFile.jsp" method = "post" enctype = "multipart/form-data">
        <div class="modal-body">
            <input type = "file" name = "file" size = "50" />
        </div>
        <div class="modal-footer">
          <input type = "submit" value = "Upload File" />
        </div>
        </form>
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