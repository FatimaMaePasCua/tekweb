const express = require('express');
const app = express();
const bodyParser = require('body-parser');
const fileUpload = require('express-fileupload');
const moment = require('moment');
const session = require('express-session')
const fs = require('fs');
const path = require('path');

var mysql = require('mysql');

var connection = mysql.createConnection({
  host     : '127.0.0.1',
  user     : 'root',
  password : '',
  database: 'tekweb'
});
 

app.use(fileUpload());

app.set('trust proxy', 1) // trust first proxy
app.use(session({
  secret: 'keyboard cat',
  resave: false,
  saveUninitialized: true,
  cookie: { secure: false }
}))


app.use(bodyParser.json()); // support json encoded bodies
app.use(bodyParser.urlencoded({ extended: true })); // support encoded bodies

app.set('view engine','ejs');
app.use(express.static('public'));
app.use(express.static('uploads'));

connection.connect(function(err) {
  		if (err) throw err;
  		console.log("Connected!");
});

app.get('/', (req, res) => res.redirect('/classes'));

app.get('/index/:uid',function(req, res){
	var userID = req.params.uid;
	var sql = "Select * from users where userID = ?";
  	connection.query(sql,[userID], function (err, result) {	
  		if (err) throw err;
  		req.session.userID = result[0].userID;
  		req.session.userData = result[0];
		res.redirect('/classes');
	});
});

app.get('/classes',function(req, res){
	var userID = req.session.userID;

	if(userID){
		var sql = "Select * from classes where userID = ? AND status = 'active'";

  		connection.query(sql,[userID], function (err, result) {	
			if (err) throw err;
			res.render('classes',{classes: result});
		});
	}else{
		res.redirect('/logout')
	}
	
});
app.get('/logout',function(req,res){
	req.session.destroy(function(err){  
        if(err){  
            console.log(err);  
        }  
        else  
        {
        	req.session = null;
         	let ip_details = req.socket.address().address.split(':');
    		if(ip_details[3]){
				res.redirect('http://'+ip_details[3]+'/tekweb/logout.php');
    		}else{
				res.redirect('http://localhost/tekweb/logout.php');
    		}         
        }  
    });  
	
})



app.post('/createClass',function(req, res){
	var classCode = req.body.classCode;
	var subject = req.body.subject;
	var genCode = req.body.genCode;
	var userID = req.session.userID;
	var sql = "INSERT INTO classes (classCode, subject, genCode, userID) VALUES (?,?,?,?)";

  	connection.query(sql,[classCode,subject,genCode,userID], function (err, result) {
		if (err) throw err;
		var sql = "INSERT INTO transactions (action,userID) VALUES ('Class "+classCode+" has been created.',?)";
  		connection.query(sql,[userID],function (err, result) {
			if (err) throw err;
				res.redirect('/classes');
			});
		});
	});

app.get('/grades/:classID',function(req, res){
	var userID = req.session.userID;
	var classID = req.params.classID;
	if(userID){
		var sql = `SELECT grades.*,classCode,firstname,lastname,idnumber FROM grades 
					inner join users on users.userID = studentID
					inner join classes on classes.classID = grades.classID
					where classes.classID = ?`;

  		connection.query(sql,[classID], function (err, result) {
		if (err) throw err;
		console.log(result);
			res.render('grades',{grades: result});
		});
	}else{
		res.redirect('/logout')
	}
});
app.get('/announcements',function(req, res){
	var userID = 8;
	if(userID){
		var sql = `SELECT announcements.*,classCode FROM announcements
		INNER JOIN classes on classes.classID = announcements.classID
		WHERE classes.userID = ?`;

  		connection.query(sql,[userID], function (err, result) {
			if (err) throw err;
				res.render('announcements',{announcement: result});
		});
	}else{
		res.redirect('/logout')
	}
});

app.get('/students/:classID',function(req, res){
	var classID = req.params.classID;
	var userID = req.session.userID;
	var pending;
	var registered;
	if(userID){

		var sql = `SELECT studentID,classes.classID,classCode,idnumber,CONCAT(firstname,' ',lastname) as name,studentclasses.status  FROM classes
		inner join studentclasses on studentclasses.classID = classes.classID
		inner join users on users.userID = studentclasses.studentID
		where classes.userID = ? AND classes.classID = ? AND studentclasses.status = 'registered'`;

  		connection.query(sql,[userID,classID], function (err, result) {
			if (err) throw err;
				registered = result;
			var sql2 = `SELECT studentID,classes.classID,classCode,idnumber,CONCAT(firstname,' ',lastname) as name,studentclasses.status  FROM classes
			inner join studentclasses on studentclasses.classID = classes.classID
			inner join users on users.userID = studentclasses.studentID
			where classes.userID = ? AND classes.classID = ? AND studentclasses.status = 'pending'`;

  			connection.query(sql2,[userID,classID], function (err, result) {
				if (err) throw err;
					pending = result;
  		
				res.render('students',{pending: pending, registered: registered,classID: classID});
			});
		});
	}else{
		res.redirect('/logout')
	}

	});
	app.get('/inviteStudents/:classID',function(req, res){
		var classID = req.params.classID;
		var userID = req.session.userID;
		if(userID){
			var sql = `Select * from users 
			left join studentclasses on studentID = users.userID
			left join invitations on invitations.studentID = users.userID
			where type='Student' and ((regstdID is null)  
			AND (invtnID is null) OR (studentclasses.classID != ?)) group by users.userID`;

  			connection.query(sql,[classID], function (err, result) {
				if (err) throw err;
				res.render('invitation',{students: result,classID: classID});
			});
  		}else{
			res.redirect('/logout')
  		}
	});

app.get('/accept/:classID/:studentID',function(req, res){
	var classID = req.params.classID;
	var studentID = req.params.studentID;

	var sql = "Update studentclasses set status='registered' where classID = ? AND studentID=?";

  	connection.query(sql,[classID,studentID], function (err, result) {
		if (err) throw err;
		var sql2 = "Update classes set studentCount=studentCount+1 where classID = ?";
		connection.query(sql2,[classID], function (err, result) {
			if (err) throw err;
		var sql2 = "Insert into grades (classID,studentID) values(?,?)";
		connection.query(sql2,[classID,studentID], function (err, result) {
			if (err) throw err;
			res.redirect('/students/'+classID);
		});
	});
	});
});
app.get('/inviteSt/:studentID/:classID',function(req, res){
	var classID = req.params.classID;
	var studentID = req.params.studentID;

	var sql = "Insert into invitations (studentID,classID) values(?,?)";

  	connection.query(sql,[studentID,classID], function (err, result) {
	if (err) throw err;

  	var sql2 = "Select * from classes inner join users on users.userID = classes.userID where classID=?";
		connection.query(sql2,[classID], function (err, result) {
			if (err) throw err;
			var classes = result[0];
				var sql2 = "Select * from users where userID=?";
		connection.query(sql2,[studentID], function (err, result) {
			if (err) throw err;
			var student = result[0];
		var sql2 = "Insert into transactions (action,userID) values('Teacher "+classes.idnumber+" invited student "+student.idnumber+" in class "+classes.classCode+".',?)";
		connection.query(sql2,[classID], function (err, result) {
			if (err) throw err;
			res.redirect('/inviteStudents/'+classID);
		});
		});
	});
	});
});
app.get('/reject/:classID/:studentID',function(req, res){
	var classID = req.params.classID;
	var studentID = req.params.studentID;

	var sql = "Update studentclasses set status='rejected' where classID = ? AND studentID=?";

  	connection.query(sql,[classID,studentID], function (err, result) {
		if (err) throw err;
		var sql2 = "Select * from classes inner join studentclasses on studentclasses.classID = classes.classID inner join users on studentclasses.studentID = users.userID where studentclasses.classID =?";
		connection.query(sql2,[classID], function (err, result) {
			if (err) throw err;
			var classes = result[0];
		var sql2 = "Insert into transactions (action,userID) values('Student "+classes.idnumber+" has been rejected in class "+classes.classCode+".',?)";
		connection.query(sql2,[classID], function (err, result) {
			if (err) throw err;
		res.redirect('/students/'+classID);
	});
	});
	});
});
app.post('/upload', function(req, res) {
	var number;
	var dateOfSubmission = req.body.date;
	var classID = req.body.classID;
	var dir = __dirname+'/uploads/assignments/'+classID+'/';

	var sql = `SELECT count(assignID) as number FROM assignments WHERE classID = ?`;

 	if (!req.files)
   		return res.status(400).send('No files were uploaded.');

  		let assignment = req.files.assignment;
		var extension = path.extname(assignment.name);

	connection.query(sql,[classID], function (err, result) {
			if (err) throw err;
			number = result[0].number+1;
		var filename = 'assignment'+number+extension;

	
	var sql = `Insert INTO assignments (dateUploaded,dateOfSubmission,filename,assignNumber,classID)
	VALUES(Date(NOW()),?,?,?,?)`;

	if (!fs.existsSync(dir)){
    	fs.mkdirSync(dir);
	}
   

  	assignment.mv(dir+filename, function(err) {
			if (err)
    	  		return res.status(500).send(err);
	});
  	connection.query(sql,[dateOfSubmission,filename,(number),classID], function (err, result) {
		if (err) throw err;
				var sql2 = "Select * from assignments INNER JOIN classes on classes.classID = assignments.classID inner join users on users.userID = classes.userID  where assignments.classID =?";
		connection.query(sql2,[classID], function (err, result) {
			if (err) throw err;
			var classes = result[0];
		var sql2 = "Insert into transactions (action,userID) values('Teacher "+classes.idnumber+" uploaded an assignment in class "+classes.classCode+".',?)";
		connection.query(sql2,[classID], function (err, result) {
			if (err) throw err;

			res.redirect('/assignments/'+classID);
		});
		});
		});
	});
});

app.post('/uploadGrade', function(req, res) {
	var classID = req.body.classID;
	var term = req.body.term;
	var dir = __dirname+'/uploads/grades/'+classID+'/';


 	if (!req.files)
   		return res.status(400).send('No files were uploaded.');

  		let grades = req.files.grade;
		var extension = path.extname(grades.name);
		var filename = term+extension;

	

	if (!fs.existsSync(dir)){
    	fs.mkdirSync(dir);
	}
   

  	grades.mv(dir+filename, function(err) {
			if (err)
    	  		return res.status(500).send(err);
	});
	var sql = `Update grades set `+term+`= ? where classID = ?`;
		connection.query(sql,[filename,classID], function (err, result) {
		if (err) throw err;
		var sql2 = "Select * from grades INNER JOIN classes on classes.classID = grades.classID inner join users on users.userID = classes.userID  where classes.classID =?";
		connection.query(sql2,[classID], function (err, result) {
			if (err) throw err;
			var classes = result[0];
		var sql2 = "Insert into transactions (action,userID) values('Teacher "+classes.idnumber+" uploaded "+term+" grade in class "+classes.classCode+".',?)";
		connection.query(sql2,[classID], function (err, result) {
			if (err) throw err;
			res.redirect('/grades');
		});
		});
		});
	});


app.get('/assignments/:classID',function(req, res){
	var classID = req.params.classID;
	var userID = req.session.userID;
	if(userID){
		var sql = "Select * from assignments where classID =?";

  		connection.query(sql,[classID], function (err, result) {
			if (err) throw err;
			var assignments =  result;

			var sql = "Select * from classes where classID =?";
			connection.query(sql,[classID], function (err, result) {
				if (err) throw err;
				var classes = result[0];
				res.render('assignments',{assignments: assignments,classes: classes,moment:moment});
			});
		});
	}else{
		res.redirect('/logout')
	}
});
app.get('/submissions/:assignID/:classID',function(req, res){
	var assignID = req.params.assignID;
	var classID = req.params.classID;
	var userID = req.session.userID;
	if(userID){
		var sql = `Select *,submissions.filename as flnm from submissions 
		inner join assignments on assignments.assignID = submissions.assignID
		inner join classes on classes.classID = assignments.classID
		inner join users on users.userID = submissions.studentID
		where assignments.assignID =?`;

  		connection.query(sql,[assignID], function (err, result) {
			if (err) throw err;
			var submissions =  result;

			var sql = "Select * from classes inner join assignments on assignments.classID = classes.classID where classes.classID =?";
			connection.query(sql,[classID], function (err, result) {
				if (err) throw err;
				var classes = result[0];
				res.render('submissions',{submissions: submissions,classes: classes,moment:moment});
			});
		});
	}else{
		res.redirect('/logout')
	}
});


app.post('/createAnnouncement', function(req, res) {
	var dateOfValidity = req.body.date;
	var subj = req.body.subj;
	var announcement = req.body.announcement;
	var classID = req.body.classID;
	var sql = `Insert into announcements (subj,announcement,dateOfValidity,classID) VALUES(?,?,?,?)`;

	connection.query(sql,[subj,announcement,dateOfValidity,classID], function (err, result) {
		if(err) console.log(err);
	var sql2 = "Select * from announcements INNER JOIN classes on classes.classID = announcements.classID inner join users on users.userID = classes.userID  where classes.classID =?";
		connection.query(sql2,[classID], function (err, result) {
			if (err) throw err;
			var classes = result[0];
		var sql2 = "Insert into transactions (action,userID) values('Teacher "+classes.idnumber+" created an announcement.',?)";
		connection.query(sql2,[classID], function (err, result) {
			if (err) throw err;

		res.redirect('/classes');
	});
	});
	});
});


app.listen(3000, () => console.log('Listening on port 3000!'))