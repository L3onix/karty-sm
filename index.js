const Redis = require('./src/services/Redis');
const redis = new Redis();
const queue = redis.getQueue('teste');

addInQueue(queue);

async function addInQueue(queue) {
    await queue.add(
        'karty',
        {
            user: 123,
            product: 'code1234'
        },
        {
            delay: 5000 // 5 segundos
        }
    );
}