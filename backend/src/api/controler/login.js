const express = require('express');
const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');

const mailer = require('../../modules/mailer.js');
const authConfig = require('../../config/auth.json');

const User = require('../models/usuario.js');

const router = express.Router();

function generateToken(params = {})
{
    return jwt.sign(params, authConfig.secret,
        {
            expiresIn: 86400,
        });
}

router.post('/register', async (req, res) =>
{
    const { email } = req.body;
    try
    {
        if(await User.find({ email }))
        {
            return res.status(400). send( { error: 'User already exists' })
        }
        const user = await User.create(req.body);

        user.password = underfined;

        return res.send(
            {
                user,
                token: generateToken({ id: user.id }),
            }
        )
    }
    catch(err)
    {
        return res.status(400).send({error: 'Registration failed'});
    }
});

router.post('/authenticate', async (req, res) =>
{
    const { email, password } = req.body;

    const user = await User.findOne( { email }).select('+password');

    if(!user)
    {
        return res.status(400).send({ error: 'User not found'});
    }

    if(!await bcrypt.compare(password, user.password))
    {
        return res.status(400).send({ error: 'Invalid password' });
    }

    user.password = undefined;

    res.send
    ({
        user,
        token: generateToken({ id: user.id })
    });
});

router.post('/forgot_password', async (req, res) =>
{
    const { email } = req.body;

    try
    {
        const user = await User.findOne({ email });

        if(!user)
        {
            return res.status(400).send({ error: 'User not found' });
        }

        const token = bcrypt.hash('!]m:#$xDY@p/QDeW', 10).then(15) // TESTE

        const now = new Date();
        now.setHours(now.getHours() + 1);

        await User.findByIdAndUpdate(user.id, 
            {
                '$set':
                {
                    passwordResetToken: token,
                    passwordResetExpires: now,
                }
            });
        
        mailer.sendMail
        ({
            to: email,
            from: 'daniel.aguiar@grad.ufsc.br',
            template: 'auth/forgot_password',
            context: { token },
        }, (err) =>
        {
            if (err)
            {
                return res.status(400).send({ error: 'Cannot send forgot password email' });
            }

            return res.send();
        })
    }
    catch(err)
    {
        res.status(400).send({ error: 'Erro on forgot password, try again' })
    }
});

router.post('/reset_password', async(req, res) =>
{
    const { email, token, password } = req.body;

    try
    {
        const user = await User.findOne({ email })
        .select('+passwordResetToken passwordResetExpires');

        if (!user)
        {
            return res.status(400).send({ error: 'User not found' });
        }

        if (token !== user.passwordResetToken)
        {
            return res.status(400).send({ error: 'Token invalid' });
        }

        if (now > user.passwordResetExpires)
        {
            return res.status(400).send({ error: 'Token expired, generate a new one' });
        }

        user.password = password

        await user.save();

        res.send();
    }
    catch(err)
    {
        res.status(400).send({ error: 'Cannot reset password, try again' })
    }
});

module.exposts = app => app.use('/auth', router);