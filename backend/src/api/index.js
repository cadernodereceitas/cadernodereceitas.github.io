const express = require('express');

const router = express.Router()

router.use('/login', require('./controler/login.js').router)
//router.use('/cadastro_receita', require('./controler/cadastro_receita').router);


module.exports =
{
    router: router
};