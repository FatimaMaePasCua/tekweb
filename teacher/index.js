const express = require('express');
const app = express();
const connection = require('../connection');
const bodyParser = require('body-parser');

app.use(bodyParser.json()); // support json encoded bodies
app.use(bodyParser.urlencoded({ extended: true })); // support encoded bodies

app.set('view engine','ejs');
app.use(express.static('public'))

app.get('/', (req, res) => res.send('Hello World!'));


app.get('/classes',(req, res) => res.render('classes'));

app.post('/createClass',function(req, res){
	var classCode = req.body.classCode;
	var subject = req.body.subject;
	var genCode = req.body.genCode;
	var userID = 8;
	connection.connect(function(err) {
  		if (err) throw err;
  		console.log("Connected!");
 		var sql = "INSERT INTO classes (classCode, subject, genCode, userID) VALUES (?,?,?,?)";

  		connection.query(sql,[classCode,subject,genCode,userID], function (err, result) {
			if (err) throw err;
		   		res.redirect('/classes');
	  		});
	});
});


app.listen(3000, () => console.log('Listening on port 3000!'))