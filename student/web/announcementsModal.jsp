<%@ page import="java.sql.*" %>

<%
         Class.forName("com.mysql.jdbc.Driver");  
%> 

<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<div class="modal-body">
            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class=" text-primary">
                                        <th>Subject</th>
                                        <th>Announcement</th>
                                        <th>Date</th>
                                        </thead>
                                        <tbody>
                                           
                                       
                                        
                                        </tbody>
                                    </table>
                                    <hr>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    Add Subject</button>
                                </div>
                            </div>
        </div>