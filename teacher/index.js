const express = require('express');
const app = express();
const connection = require('../connection');

app.set('view engine','ejs');
app.use(express.static('public'))

app.get('/', (req, res) => res.send('Hello World!'));


app.get('/classes',(req, res) => res.render('classes'));

app.listen(3000, () => console.log('Listening on port 3000!'))