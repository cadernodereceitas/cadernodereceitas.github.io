/*
Instalações realizadas
npm install
npm init
npm install express --save
npm install path --save
npm install bcryptjs --save
npm install jsonwebtoken --save
npm install mongoose --save
npm install nodemailer --save
npm install nodemailer-express-handlebars --save

*/

const express = require('express');
const app = express();
const rotas = require('./api/rotas.js');
const path = require('path');

app.use(express.json());
app.use(express.urlencoded({ extended: true}));

app.use('/css', express.static(path.join(__dirname, '..', '..', 'frontend', 'css')));
app.use('/img', express.static(path.join(__dirname, '..', '..', 'frontend', 'img')));
app.use('/js', express.static(path.join(__dirname, '..', '..', 'frontend', 'js')));
//app.use('/api', require('./api/index.js').router); // Atualmente, necessário comentar essa linha para rodar

rotas.forEach(route =>
    {
        app.get(route.route, (req, res) => res.sendFile(path.join(__dirname, '..', '..', 'frontend', route.fileName)));
        app.get(route.route + '.html', (req, res) => res.redirect(route.route));
    });


app.listen(3000 || process.env.PORT);