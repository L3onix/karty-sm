const Queue = require('bullmq').Queue;
const Worker = require('bullmq').Worker;
require('dotenv').config();

module.exports = class Redis {
    constructor() {
        this.host = process.env.REDIS_HOST;
        this.port = process.env.REDIS_PORT;
        this.user = process.env.REDIS_USER;
        this.pass = process.env.REDIS_PASS;
    }

    getQueue(queue) {
        return new Queue(queue, { connection: {
            host: this.host,
            port: this.port
        }});
    }

    getWorker(worker) {
        return new Worker(worker, async (job) => {}, {connection: {
            host: this.host,
            port: this.port
        }})
    }
}
