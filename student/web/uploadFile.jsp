<%@ page import = "java.io.*,java.util.*, javax.servlet.*" %>
<%@ page import = "javax.servlet.http.*" %>
<%@ page import = "org.apache.commons.fileupload.*" %>
<%@ page import = "org.apache.commons.fileupload.disk.*" %>
<%@ page import = "org.apache.commons.fileupload.servlet.*" %>
<%@ page import = "org.apache.commons.io.output.*" %>
<%@page import="java.io.File"%>
<%@ page import ="java.sql.*" %>

<%
   File file ;
   int maxFileSize = 5000 * 1024;
   int maxMemSize = 5000 * 1024;
   ServletContext context = pageContext.getServletContext();
   String a = request.getParameter("d");
   Integer ayd =(Integer) session.getAttribute("ayd");
   
   
   String classID = request.getParameter("id");
   String assignID = request.getParameter("assignID");
   
   String filePath = "C:\\wamp64\\www\\tekweb\\teacher\\uploads\\submissions\\" + classID + "\\" + assignID + "\\";
    // if the directory does not exist, create it
   File dir = new File(filePath);
   
    if(!dir.exists()){
        dir.mkdirs();
    }
    

   // Verify the content type
   String contentType = request.getContentType();
   
   if ((contentType.indexOf("multipart/form-data") >= 0)) {
      DiskFileItemFactory factory = new DiskFileItemFactory();
      // maximum size that will be stored in memory
      factory.setSizeThreshold(maxMemSize);
      
      // Location to save data that is larger than maxMemSize.
      factory.setRepository(new File("c:\\temp"));

      // Create a new file upload handler
      ServletFileUpload upload = new ServletFileUpload(factory);
      
      // maximum file size to be uploaded.
      upload.setSizeMax( maxFileSize );
      
      try { 
         // Parse the request to get file items.
         List fileItems = upload.parseRequest(request);

         // Process the uploaded file items
         Iterator i = fileItems.iterator();

         out.println("<html>");
         out.println("<head>");
         out.println("<title>JSP File upload</title>");  
         out.println("</head>");
         out.println("<body>");
         
         while ( i.hasNext () ) {
            FileItem fi = (FileItem)i.next();
            if ( !fi.isFormField () ) {
               // Get the uploaded file parameters
               String fieldName = fi.getFieldName();
               String fileName = fi.getName();
               String ext = "";
               int index = fileName.lastIndexOf(".");
                if(index > 0){
                               ext = fileName.substring(index+1);
                               ext = ext.toLowerCase();
                               
                               fileName = ayd + "." + ext;
                }
               boolean isInMemory = fi.isInMemory();
               long sizeInBytes = fi.getSize();
            
               // Write the file
               if( fileName.lastIndexOf("\\") >= 0 ) {
                  file = new File( filePath + 
                  fileName.substring( fileName.lastIndexOf("\\"))) ;
               } else {
                  file = new File( filePath + 
                  fileName.substring(fileName.lastIndexOf("\\")+1)) ;
               }
               fi.write( file ) ;
               
               Class.forName("com.mysql.jdbc.Driver");
                Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/tekweb",
                        "root", "");
                 session = request.getSession();
                Integer id =(Integer) session.getAttribute("ayd");
<<<<<<< HEAD

                String sql = "INSERT INTO submissions(assignID,studentID,filename) VALUES(?,?,?)";
                PreparedStatement ps = null;
                ps = con.prepareStatement(sql);
                ps.setInt(1, Integer.parseInt(assignID));
                ps.setInt(2, id);
                ps.setString(3, fileName);
                ps.executeUpdate();
=======
                
>>>>>>> 3278babb10ffff50a411fb089528096584c43085
                
                String qo = "SELECT * FROM submissions WHERE studentID = '" + id +"' AND assignID = '" + assignID +"'";
                Statement stt = con.createStatement();
                ResultSet rss = stt.executeQuery(qo);
                
                if(rss.next() == false){
                    String sql = "INSERT INTO submissions(assignID,studentID,filename) VALUES(?,?,?)";
                    PreparedStatement ps = null;
                    ps = con.prepareStatement(sql);
                    ps.setInt(1, Integer.parseInt(assignID));
                    ps.setInt(2, id);
                    ps.setString(3, fileName);
                    ps.executeUpdate();

                    String queryString = "SELECT * FROM classes WHERE classID = '" + classID + "'";


                    Statement st = con.createStatement();
                    ResultSet rs = st.executeQuery(queryString);
                    rs.first();

                    int cid = Integer.parseInt(classID);

                    String tr = "INSERT INTO transactions(action,userID,classID) VALUES(?,?,?)";
                    ps = null;
                    String act = "Submitted Assignment for class " + rs.getString("subject");
                    ps = con.prepareStatement(tr);
                    ps.setString(1, act);
                    ps.setInt(2, ayd);
                    ps.setInt(3, cid);
                    ps.executeUpdate();
                }else{
                    String sqz = "UPDATE submissions SET filename = '" + fileName + "' WHERE subID = '" + rss.getInt("subID") + "'";
                    PreparedStatement ps = null;
                        ps = con.prepareStatement(sqz);
                        ps.executeUpdate();
                }

                

                     
               out.println("<script type=\"text/javascript\">");
                out.println("alert('Successfuly Uploaded!');");
                out.println("location='notifications.jsp';");
                out.println("</script>");
            }
         }
         out.println("</body>");
         out.println("</html>");
      } catch(Exception ex) {
         System.out.println(ex);
      }
   } else {
      out.println("<script type=\"text/javascript\">");
      out.println("alert('No File Uploaded!');");
      out.println("location='notifications.jsp';");
      out.println("</script>");
   }
%>