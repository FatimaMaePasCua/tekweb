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

app.listen(3000, () => console.log('Listening on port 3000!'))