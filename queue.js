import { Queue } from "bullmq";

const queueName = 'karty_order_process';
const hostAmqp= "127.0.0.1";
const portAmqp= 6379;

const queue = new Queue(queueName,
    {
        connection: {
            host: hostAmqp,
            port: portAmqp
        }
    }
);
console.log("queue configurado");
await queue.add(
    'sku_000',
    {
        userId: 123,
        kartyId: 1
    },
    { delay: 5000 } // delay de 5 segundos
);
console.log("enviado");
