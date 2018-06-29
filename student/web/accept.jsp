<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ page import ="java.sql.*" %>
<%
   int id = Integer.parseInt(request.getParameter("rid"));
   int vid = Integer.parseInt(request.getParameter("vID"));
   session = request.getSession();
     Integer ayd =(Integer) session.getAttribute("ayd");
   
    Class.forName("com.mysql.jdbc.Driver");
    Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/tekweb",
            "root", "");
    
     String queryString = "UPDATE invitations SET status = 'accepted' WHERE invtnID = '" + id + " '";
    
     
     PreparedStatement ps = null;
     ps = con.prepareStatement(queryString);
     ps.executeUpdate();
     
     String qu = "SELECT * FROM classes WHERE classID = '" + vid +"'";
     Statement st = con.createStatement();
     ResultSet rs = st.executeQuery(qu);
     
     rs.first();
     int count = rs.getInt("studentCount") + 1;
     
     String que = "UPDATE classes SET studentCount = '" + count +"' WHERE classID = '" + vid + "'";
    
     ps = con.prepareStatement(que);
     ps.executeUpdate();
     
     
     
     String sql = "INSERT INTO studentclasses(classID,status,studentID) VALUES(?,?,?)";
         
         ps = con.prepareStatement(sql);
         ps.setInt(1, vid);
         ps.setString(2, "registered");
         ps.setInt(3, ayd);
         ps.executeUpdate();
         
         
     
     out.println("<script type=\"text/javascript\">");
     out.println("alert('Accepted!!');");
     out.println("location='classes.jsp';");
     out.println("</script>");
   
    
        
    
    
%>