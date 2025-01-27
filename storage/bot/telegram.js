const TelegramBot = require('node-telegram-bot-api');
const config = require('./config.js');
const TOKEN = config.TELEGRAM_BOT_TOKEN;
const mysql = require('mysql');

const bot = new TelegramBot(TOKEN, {
    polling: {
        interval: 300,
        autoStart: true,
        params: {
            timeout: 10
        }
    }
})
const client = mysql.createPool({
    connectionLimit: 50,
    host: "localhost",
    user: config.bd.user,
    database: config.bd.database,
    password: config.bd.password
});

bot.on('message', async msg => {

    let chat_id = msg.chat.id,
        text = msg.text ?? '',
        settings = await db('SELECT * FROM settings ORDER BY id DESC'),
        user = await db(`SELECT * FROM users WHERE tg_id = ${chat_id}`);

    if(!text) return bot.sendMessage(chat_id, 'The message must not contain pictures / emoticons / stickers');
    if(text.toLowerCase().startsWith('/start') || text.toLowerCase() == 'назад') {
        unique_id = msg.text.split("/start ")[1] ?? '';
        if(unique_id.length > 1 && unique_id.length < 20) {
            unique_id = unique_id.replace(/[^a-z0-9\s]/gi, '');
            account = await db(`SELECT * FROM users WHERE unique_id = '${unique_id}'`)
            check = await db(`SELECT * FROM users WHERE tg_id = ${chat_id}`);

            if(account.length < 1) return bot.sendMessage(chat_id, 'The reference is invalid ❌');
            console.log(check)
            if(check.length >= 1) return bot.sendMessage(chat_id, 'This Telegram account is already linked');
            if(Number(account[0].tg_id)) return bot.sendMessage(chat_id, 'Another Telegram account is already linked to this account')
            if(account[0].tg_bonus == 1) return bot.sendMessage(chat_id, 'The user has already been credited with a reward');

            await db(`UPDATE users SET tg_id = ${chat_id} WHERE unique_id = '${unique_id}'`);
            return bot.sendMessage(chat_id, `😌 ${account[0].username}, you have successfully linked your Telegram!\n\n To receive the bonus you need to subscribe to <a href="https://t.me/${settings[0].tg_channel ?? 'undefined'}">canal</a>`, {
                reply_markup: {
                    inline_keyboard: [
                        [
                            { text: 'Get a bonus 🎁', callback_data: "getBonus" }
                        ]
                    ]
                },
                parse_mode: "HTML",
                disable_web_page_preview: true
            });
        }
        if(user[0]?.tg_id) {
            return bot.sendMessage(chat_id, `You are now in the main menu:\n\n To receive the bonus you need to subscribe to <a href="https://t.me/${settings[0].tg_channel ?? 'undefined'}">canal</a>`, {
                reply_markup: {
                    inline_keyboard: [
                        [
                            { text: 'Get a bonus 🎁', callback_data: "getBonus" }
                        ]
                    ]
                },
                parse_mode: "HTML",
                disable_web_page_preview: true
            });
        }
        return bot.sendMessage(chat_id, `Follow the invitation link to link your account!`);
    }

    return bot.sendMessage(chat_id, 'Command not recognised', {
        reply_markup: {
            keyboard: [
                ['Back']
            ],
            resize_keyboard: true,
            one_time_keyboard: true
        },
        parse_mode: "HTML",
        reply_to_message_id: msg.message_id
    });
});

bot.on('callback_query', async (query) => {
    let user = await db(`SELECT * FROM users WHERE tg_id = ${query.message.chat.id}`),
        settings = await db('SELECT * FROM settings ORDER BY id DESC');
    if(query.data.startsWith('getBonus')) {
        subs = await bot.getChatMember('@'+settings[0].tg_channel ?? '', query.message.chat.id).catch((err) => {});
        if (!subs || subs.status == 'left' || subs.status == undefined) {
            return bot.answerCallbackQuery(query.id, {
                text: 'You are not subscribed to the channel ❌',
                show_alert: true
            });
        }
        if(user.length < 1) {
            //bot.deleteMessage(query.message.message_id, id).catch(e => {});
            return bot.answerCallbackQuery(query.id, {
                text: 'User not found',
                show_alert: true
            }); 
        }
        if(user[0].tg_bonus == 1) {
            //bot.deleteMessage(query.message.message_id, id).catch(e => {})
            return bot.answerCallbackQuery(query.id, {
                text: 'The user has already been credited with a reward',
                show_alert: true
            });
        }

        await db(`UPDATE users SET tg_bonus = 1, balance = balance + ${settings[0].tg_bonus ?? '0'} WHERE tg_id = ${query.message.chat.id}`);
        return bot.answerCallbackQuery(query.id, {
            text: `😎 Thank you for subscribing, ${user[0].username}!\n\nYour account has been credited ${settings[0].tg_bonus ?? '0'} coins`,
            show_alert: true
        });
    }
});
function db(databaseQuery) {
    return new Promise(data => {
        client.query(databaseQuery, function (error, result) {
            if (error) {
                console.log(error);
                throw error;
            }
            try {
                data(result);

            } catch (error) {
                data({});
                throw error;
            }

        });
        
    });
    client.end()
}