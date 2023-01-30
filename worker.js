import { Worker, Job } from 'bullmq';

const queueName = 'karty_order_process';
const hostAmqp= "127.0.0.1";
const portAmqp= 6379;

const worker = new Worker(queueName, async (job) => {
    await job.updateProgress(10);
    console.log("Processando product_order!");
    return;
},
{
    autorun: false,
    connection: {
        host: hostAmqp,
        port: portAmqp
    }
});

worker.run();