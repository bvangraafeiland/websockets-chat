window.collection = require('lodash/collection');

window.Vue = require('vue');

import axios from 'axios';

window.axios = axios;
axios.defaults.headers.common = {
    'X-CSRF-TOKEN': Laravel.csrfToken
};

window.moment = require('moment');

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from "laravel-echo";

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.PUSHER_KEY,
    cluster: 'eu'
});
