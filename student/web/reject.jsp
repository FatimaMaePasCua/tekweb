<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ page import ="java.sql.*" %>
<%
   int id = Integer.parseInt(request.getParameter("rid"));
   
    Class.forName("com.mysql.jdbc.Driver");
    Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/tekweb",
            "root", "");
    
     String queryString = "UPDATE invitations SET status = 'rejected' WHERE invtnID = '" + id + " '";
    
     
     PreparedStatement ps = null;
     ps = con.prepareStatement(queryString);
     ps.executeUpdate();
     
     
     out.println("<script type=\"text/javascript\">");
     out.println("alert('Rejected!');");
     out.println("location='classes.jsp';");
     out.println("</script>");
   
    
        
    
    
%>