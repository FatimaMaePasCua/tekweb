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
		res.redirect('/classes');
	});
});

app.get('/grades',function(req, res){
	var userID = 8;
	var sql = "Select * from classes where userID = ? AND status = 'active'";

  	connection.query(sql,[userID], function (err, result) {
		if (err) throw err;
		res.render('grades',{classes: result});
	});
});

app.get('/announcements',function(req, res){
	var userID = 8;
	var sql = "Select * from classes where userID = ? AND status = 'active'";

  	connection.query(sql,[userID], function (err, result) {
		if (err) throw err;
		res.render('announcements',{classes: result});
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

app.get('/assignments/:classID',function(req, res){
	var classID = req.params.classID;
	var userID = 8;
	var sql = "Select * from assignments where classID =?";

  	connection.query(sql,[classID], function (err, result) {
		if (err) throw err;
		res.render('assignments',{assignments: result,classID: classID,moment:moment});
	});
});

app.listen(3000, () => console.log('Listening on port 3000!'))