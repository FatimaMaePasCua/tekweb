const express = require('express');
const app = express();
const connection = require('../connection');
const bodyParser = require('body-parser');

app.use(bodyParser.json()); // support json encoded bodies
app.use(bodyParser.urlencoded({ extended: true })); // support encoded bodies

app.set('view engine','ejs');
app.use(express.static('public'))

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
		res.redirect('/students/'+classID);
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

app.listen(3000, () => console.log('Listening on port 3000!'))