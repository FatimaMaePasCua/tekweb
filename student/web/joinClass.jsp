<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ page import ="java.sql.*" %>
<%
   String code = request.getParameter("code");
   
    Class.forName("com.mysql.jdbc.Driver");
    Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/tekweb",
            "root", "");
     String queryString = "SELECT * FROM classes WHERE genCode = '" + code + "'";
     
     
     Statement st = con.createStatement();
     ResultSet rs = st.executeQuery(queryString);
            
     
     session = request.getSession();
     Integer id =(Integer) session.getAttribute("ayd");
     
     
     
     if(rs.next() == false){
         out.println("<script type=\"text/javascript\">");
         out.println("alert('Class Not Found!');");
         out.println("location='classes.jsp';");
         out.println("</script>");
     }else{
         String sql = "INSERT INTO studentclasses(classID,status,studentID) VALUES(?,?,?)";
         PreparedStatement ps = null;
         ps = con.prepareStatement(sql);
         ps.setInt(1, rs.getInt("classID"));
         ps.setString(2, "pending");
         ps.setInt(3, id);
         ps.executeUpdate();
         
        
         out.println("<script type=\"text/javascript\">");
         out.println("location='classes.jsp';");
         out.println("</script>");
     }
     
     
%>