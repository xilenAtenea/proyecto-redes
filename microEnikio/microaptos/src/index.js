const express = require('express');
const aptosController = require('./controllers/aptosController');
const morgan = require('morgan');
const app = express();
app.use(morgan('dev'));
app.use(express.json());
app.use(aptosController);
app.listen(3002, () => {
console.log('Microservicio Aptos escuchando en el puerto 3002');
});