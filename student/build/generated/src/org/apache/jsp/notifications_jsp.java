package org.apache.jsp;

import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.jsp.*;
import java.sql.*;

public final class notifications_jsp extends org.apache.jasper.runtime.HttpJspBase
    implements org.apache.jasper.runtime.JspSourceDependent {

  private static final JspFactory _jspxFactory = JspFactory.getDefaultFactory();

  private static java.util.List<String> _jspx_dependants;

  private org.glassfish.jsp.api.ResourceInjector _jspx_resourceInjector;

  public java.util.List<String> getDependants() {
    return _jspx_dependants;
  }

  public void _jspService(HttpServletRequest request, HttpServletResponse response)
        throws java.io.IOException, ServletException {

    PageContext pageContext = null;
    HttpSession session = null;
    ServletContext application = null;
    ServletConfig config = null;
    JspWriter out = null;
    Object page = this;
    JspWriter _jspx_out = null;
    PageContext _jspx_page_context = null;

    try {
      response.setContentType("text/html");
      pageContext = _jspxFactory.getPageContext(this, request, response,
      			null, true, 8192, true);
      _jspx_page_context = pageContext;
      application = pageContext.getServletContext();
      config = pageContext.getServletConfig();
      session = pageContext.getSession();
      out = pageContext.getOut();
      _jspx_out = out;
      _jspx_resourceInjector = (org.glassfish.jsp.api.ResourceInjector) application.getAttribute("com.sun.appserv.jsp.resource.injector");

      out.write('\n');
      out.write('\n');

         Class.forName("com.mysql.jdbc.Driver");  

      out.write(" \n");
      out.write("\n");

    
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
    

      out.write("\n");
      out.write("\n");
      out.write("<!DOCTYPE html>\n");
      out.write("<html lang=\"en\">\n");
      out.write("\n");
      out.write("<head>\n");
      out.write("    <meta charset=\"utf-8\"/>\n");
      out.write("    <link rel=\"apple-touch-icon\" sizes=\"76x76\" href=\"assets/img/apple-icon.png\">\n");
      out.write("    <link rel=\"icon\" type=\"image/png\" href=\"assets/img/favicon.png\">\n");
      out.write("    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\"/>\n");
      out.write("    <title>\n");
      out.write("        Material Dashboard by Creative Tim\n");
      out.write("    </title>\n");
      out.write("    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'\n");
      out.write("          name='viewport'/>\n");
      out.write("    <!--     Fonts and icons     -->\n");
      out.write("    <link rel=\"stylesheet\" type=\"text/css\"\n");
      out.write("          href=\"https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons\"/>\n");
      out.write("    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css\">\n");
      out.write("    <!-- CSS Files -->\n");
      out.write("    <link href=\"assets/css/material-dashboard.css?v=2.1.0\" rel=\"stylesheet\"/>\n");
      out.write("    <!-- CSS Just for demo purpose, don't include it in your project -->\n");
      out.write("    <link href=\"assets/demo/demo.css\" rel=\"stylesheet\"/>\n");
      out.write("</head>\n");
      out.write("\n");
      out.write("<body class=\"\">\n");
      out.write("<div class=\"wrapper \">\n");
      out.write("    <div class=\"sidebar\" data-color=\"purple\" data-background-color=\"white\" data-image=\"../assets/img/sidebar-1.jpg\">\n");
      out.write("        <!--\n");
      out.write("          Tip 1: You can change the color of the sidebar using: data-color=\"purple | azure | green | orange | danger\"\n");
      out.write("\n");
      out.write("          Tip 2: you can also add an image using data-image tag\n");
      out.write("      -->\n");
      out.write("        <div class=\"logo\">\n");
      out.write("            <a href=\"#\" class=\"simple-text logo-normal\">\n");
      out.write("                ");
      out.print( session.getAttribute("firstname") );
      out.write("\n");
      out.write("            </a>\n");
      out.write("        </div>\n");
      out.write("        <div class=\"sidebar-wrapper\">\n");
      out.write("            <ul class=\"nav\">\n");
      out.write("                <li class=\"nav-item\">\n");
      out.write("                    <a class=\"nav-link\" href=\"classes.jsp\">\n");
      out.write("                        <i class=\"material-icons\">content_paste</i>\n");
      out.write("                        <p>My Classes</p>\n");
      out.write("                    </a>\n");
      out.write("                </li>\n");
      out.write("                <li class=\"nav-item active\">\n");
      out.write("                    <a class=\"nav-link\" href=\"notifications.jsp\">\n");
      out.write("                        <i class=\"material-icons\">content_paste</i>\n");
      out.write("                        <p>Notifications</p>\n");
      out.write("                    </a>\n");
      out.write("                </li>\n");
      out.write("                <li>\n");
      out.write("                    <a class=\"nav-link\" href=\"logout.jsp\">\n");
      out.write("                        <i class=\"material-icons\">notifications</i>\n");
      out.write("                        <p>Logout</p>\n");
      out.write("                    </a>\n");
      out.write("                </li>\n");
      out.write("            </ul>\n");
      out.write("        </div>\n");
      out.write("    </div>\n");
      out.write("            \n");
      out.write("   \n");
      out.write("    <div class=\"main-panel\">\n");
      out.write("        <!-- Navbar -->\n");
      out.write("\n");
      out.write("        <!-- End Navbar -->\n");
      out.write("        <div class=\"content\">\n");
      out.write("            <div class=\"container-fluid\">\n");
      out.write("                <div class=\"row\">\n");
      out.write("                    <div class=\"col-md-12\">\n");
      out.write("                        <div class=\"card\">\n");
      out.write("                            <div class=\"card-header card-header-primary\">\n");
      out.write("                                <h4 class=\"card-title text-center\">Announcements</h4>\n");
      out.write("                            </div>\n");
      out.write("                            <div class=\"card-body\">\n");
      out.write("                                <div class=\"table-responsive\">\n");
      out.write("                                    <table class=\"table\">\n");
      out.write("                                        <thead class=\" text-primary\">\n");
      out.write("                                        <th>Subject</th>\n");
      out.write("                                        <th>Class Code</th>\n");
      out.write("                                        <th>Instructor</th>\n");
      out.write("                                        <th>Announcement</th>\n");
      out.write("                                        </thead>\n");
      out.write("                                        <tbody>\n");
      out.write("                                            ");

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
                                            
      out.write("\n");
      out.write("                                       \n");
      out.write("                                        \n");
      out.write("                                        </tbody>\n");
      out.write("                                    </table>\n");
      out.write("                                    <hr>\n");
      out.write("                                </div>\n");
      out.write("                            </div>\n");
      out.write("                        </div>\n");
      out.write("                    </div>\n");
      out.write("                </div>\n");
      out.write("            </div>\n");
      out.write("                                            \n");
      out.write("                                            <div class=\"container-fluid\">\n");
      out.write("                <div class=\"row\">\n");
      out.write("                    <div class=\"col-md-12\">\n");
      out.write("                        <div class=\"card\">\n");
      out.write("                            <div class=\"card-header card-header-primary\">\n");
      out.write("                                <h4 class=\"card-title text-center\">Assignments</h4>\n");
      out.write("                            </div>\n");
      out.write("                            <div class=\"card-body\">\n");
      out.write("                                <div class=\"table-responsive\">\n");
      out.write("                                    <table class=\"table\">\n");
      out.write("                                        <thead class=\" text-primary\">\n");
      out.write("                                        <th>Subject</th>\n");
      out.write("                                        <th>Class Code</th>\n");
      out.write("                                        <th>Instructor</th>\n");
      out.write("                                        <th>Assignment</th>\n");
      out.write("                                        <th>Deadline</th>\n");
      out.write("                                        <th>Submit</th>\n");
      out.write("                                        </thead>\n");
      out.write("                                        <tbody>\n");
      out.write("                                            ");

                                                
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
                                                        out.println("<form action = 'uploadFile.jsp' method = 'post'");
                                                        out.println("enctype = 'multipart/form-data'>");
                                                        out.println("<input type = 'file' name = 'file' size = '50'/>");
                                                        out.println("<input type = 'submit' value = 'Upload File'/>");
                                                        out.println("</form>");
                                                        out.println("</td></tr>");
                                                        
                                                    }
                                                }
                                            
      out.write("\n");
      out.write("                                       \n");
      out.write("                                        \n");
      out.write("                                        </tbody>\n");
      out.write("                                    </table>\n");
      out.write("                                    <hr>\n");
      out.write("                                </div>\n");
      out.write("                            </div>\n");
      out.write("                        </div>\n");
      out.write("                    </div>\n");
      out.write("                </div>\n");
      out.write("            </div>\n");
      out.write("        </div>\n");
      out.write("        \n");
      out.write("            \n");
      out.write("            \n");
      out.write("</div>\n");
      out.write("                                            \n");
      out.write("                                            <!-- Modal -->\n");
      out.write("<div class=\"modal fade\" id=\"exampleModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">\n");
      out.write("  <div class=\"modal-dialog\" role=\"document\">\n");
      out.write("    <div class=\"modal-content\">\n");
      out.write("      <div class=\"modal-header\">\n");
      out.write("        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n");
      out.write("          <span aria-hidden=\"true\">&times;</span>\n");
      out.write("        </button>\n");
      out.write("      </div>\n");
      out.write("        <form action=\"joinClass.jsp\" method=\"post\">\n");
      out.write("        <div class=\"modal-body\">\n");
      out.write("            <input type=\"text\" class=\"form-control\" name=\"code\" placeholder=\"Subject Code\">\n");
      out.write("        </div>\n");
      out.write("        <div class=\"modal-footer\">\n");
      out.write("          <input type=\"submit\" class=\"btn btn-primary\" value=\"Add\">\n");
      out.write("        </div>\n");
      out.write("        </form>\n");
      out.write("    </div>\n");
      out.write("  </div>\n");
      out.write("</div>\n");
      out.write("  \n");
      out.write("<!--   Core JS Files   -->\n");
      out.write("<script src=\"assets/js/core/jquery.min.js\" type=\"text/javascript\"></script>\n");
      out.write("<script src=\"assets/js/core/popper.min.js\" type=\"text/javascript\"></script>\n");
      out.write("<script src=\"assets/js/core/bootstrap-material-design.min.js\" type=\"text/javascript\"></script>\n");
      out.write("<script src=\"assets/js/plugins/perfect-scrollbar.jquery.min.js\"></script>\n");
      out.write("<!--  Google Maps Plugin    -->\n");
      out.write("<script src=\"https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE\"></script>\n");
      out.write("<!-- Chartist JS -->\n");
      out.write("<script src=\"assets/js/plugins/chartist.min.js\"></script>\n");
      out.write("<!--  Notifications Plugin    -->\n");
      out.write("<script src=\"assets/js/plugins/bootstrap-notify.js\"></script>\n");
      out.write("<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->\n");
      out.write("<script src=\"assets/js/material-dashboard.min.js?v=2.1.0\" type=\"text/javascript\"></script>\n");
      out.write("<!-- Material Dashboard DEMO methods, don't include it in your project! -->\n");
      out.write("<script src=\"assets/demo/demo.js\"></script>\n");
      out.write("</body>\n");
      out.write("\n");
      out.write("</html>");
    } catch (Throwable t) {
      if (!(t instanceof SkipPageException)){
        out = _jspx_out;
        if (out != null && out.getBufferSize() != 0)
          out.clearBuffer();
        if (_jspx_page_context != null) _jspx_page_context.handlePageException(t);
        else throw new ServletException(t);
      }
    } finally {
      _jspxFactory.releasePageContext(_jspx_page_context);
    }
  }
}
