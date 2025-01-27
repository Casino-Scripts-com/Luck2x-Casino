require('dotenv').config({path: __dirname+'/./../../.env'});

module.exports = {
    domain: process.env.APP_DOMAIN || 'localhost',
    TELEGRAM_BOT_TOKEN: process.env.TELEGRAM_BOT_TOKEN || '',
    port: process.env.APP_PORT || 8443,
    https: (process.env.APP_HTTPS == 'true') || false,
    ssl: {
        key: process.env.SSL_KEY_PATH || null,
        cert: process.env.SSL_CERT_PATH || ''
    },
    bd: {
        user: process.env.DB_USERNAME || '',
        database: process.env.DB_DATABASE || '',
        password: process.env.DB_PASSWORD || ''
    }
};