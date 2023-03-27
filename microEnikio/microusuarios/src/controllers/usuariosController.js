const { Router } = require('express');
const router = Router();
const usuariosModel = require('../models/usuariosModel');
const axios = require('axios');

router.get('/usuarios', async (req, res) => {
    var result;
    result = await usuariosModel.traerUsuarios();
    res.json(result);
}); 

router.get('/usuarios/:cc', async (req, res) => {
    const cc = req.params.cc;
    var result;
    result = await usuariosModel.traerUsuario(cc);
    res.json(result[0]);
}); 


router.get('/usuarios/autofill/:cc', async (req, res) => {
    
    const cc = req.params.cc;    
    var result;
    result = await usuariosModel.crearAutofill(cc);
    res.json(result[0]);
    
});

router.get('/usuarios/:email/:password', async (req, res) => {
    const email = req.params.email;
    const password = req.params.password;
    var result;
    result = await usuariosModel.validarUsuario(email, password);
    res.json(result);
}); // funciona

router.delete('/usuarios/:cc', async (req, res) => {
    const cc = req.params.cc;
    var result = await usuariosModel.borrarUsuario(cc);
    res.send("usuario y sus aptos, borrados");
    }); 

router.post('/usuarios/crearusuario', async (req, res) => {
    const cc = req.body.cc;
    const nombre = req.body.nombre;
    const email = req.body.email;
    const password = req.body.password;
    const celular = req.body.celular;
    var result = await usuariosModel.crearUsuario(cc, nombre, email, password, celular);
    res.send("usuario creado");
}); // funciona

router.post('/usuarios/crearpostulado', async (req, res) => {
    const cc = req.body.cc;
    const nombre = req.body.nombre;
    const email = req.body.email;
    const celular = req.body.celular;
    var result = await usuariosModel.crearPostulado(cc, nombre, email, celular);
    res.json(result);
}); 

module.exports = router;
