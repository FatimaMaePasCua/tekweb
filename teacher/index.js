const express = require('express');
const app = express();
const connection = require('../connection');
const bodyParser = require('body-parser');
const fileUpload = require('express-fileupload');
const moment = require('moment');
var fs = require('fs');
var path = require('path');

app.use(fileUpload());


app.use(bodyParser.json()); // support json encoded bodies
app.use(bodyParser.urlencoded({ extended: true })); // support encoded bodies

app.set('view engine','ejs');
app.use(express.static('public'));
app.use(express.static('uploads'));

connection.connect(function(err) {
  		if (err) throw err;
  		console.log("Connected!");
 		
});

app.get('/', (req, res) => res.send(''));

app.get('/classes',function(req, res){
	var userID = 8;
	var sql = "Select * from classes where userID = ? AND status = 'active'";

  	connection.query(sql,[userID], function (err, result) {
		if (err) throw err;
		res.render('classes',{classes: result});
	});
});



app.post('/createClass',function(req, res){
	var classCode = req.body.classCode;
	var subject = req.body.subject;
	var genCode = req.body.genCode;
	var userID = 8;
	var sql = "INSERT INTO classes (classCode, subject, genCode, userID) VALUES (?,?,?,?)";

  	connection.query(sql,[classCode,subject,genCode,userID], function (err, result) {
		if (err) throw err;
		var sql = "INSERT INTO grades (classID) VALUES (?)";
  		connection.query(sql,[result.insertId], function (err, result) {
			if (err) throw err;
				res.redirect('/classes');
		});
	});
});

app.get('/grades',function(req, res){
	var userID = 8;
	var sql = `Select grades.*,grades.classID,classCode from grades 
	inner join classes on grades.classID = classes.classID 
	where userID = ? AND status = 'active'`;

  	connection.query(sql,[userID], function (err, result) {
		if (err) throw err;
		res.render('grades',{classes: result});
	});
});

app.get('/announcements',function(req, res){
	var userID = 8;
	var sql = `SELECT announcements.*,classCode FROM announcements
	INNER JOIN classes on classes.classID = announcements.classID
	WHERE classes.userID = ?`;

  	connection.query(sql,[userID], function (err, result) {
		if (err) throw err;
		res.render('announcements',{announcement: result});
	});
});

app.get('/students/:classID',function(req, res){
	var classID = req.params.classID;
	var userID = 8;
	var pending;
	var registered;

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
  		
		res.render('students',{pending: pending, registered: registered});

	});
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
			res.redirect('/students/'+classID);
		});
	});
});

app.get('/reject/:classID/:studentID',function(req, res){
	var classID = req.params.classID;
	var studentID = req.params.studentID;

	var sql = "Update studentclasses set status='rejected' where classID = ? AND studentID=?";

  	connection.query(sql,[classID,studentID], function (err, result) {
		if (err) throw err;
		res.redirect('/students/'+classID);
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
			res.redirect('/assignments/'+classID);
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
			res.redirect('/grades');
		});
	});


app.get('/assignments/:classID',function(req, res){
	var classID = req.params.classID;
	var userID = 8;
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
});
app.get('/submissions/:assignID/:classID',function(req, res){
	var assignID = req.params.assignID;
	var classID = req.params.classID;
	var userID = 8;
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
});


app.post('/createAnnouncement', function(req, res) {
	var dateOfValidity = req.body.date;
	var subj = req.body.subj;
	var announcement = req.body.announcement;
	var classID = req.body.classID;
	var sql = `Insert into announcements (subj,announcement,dateOfValidity,classID) VALUES(?,?,?,?)`;

	connection.query(sql,[subj,announcement,dateOfValidity,classID], function (err, result) {
		if(err) console.log(err);
		res.redirect('/classes');
	});
});


app.listen(3000, () => console.log('Listening on port 3000!'))