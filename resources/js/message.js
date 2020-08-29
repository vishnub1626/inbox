require('./bootstrap');

import Vue from 'vue';
import BaseModal from './components/ui/BaseModal.vue';
import ConfirmationModal from './components/ui/ConfirmationModal.vue';
import Axios from 'axios';

Vue.component('BaseModal', BaseModal);
Vue.component('ConfirmationModal', ConfirmationModal);

new Vue({
    el: '#message',

    components: {
        'confirmation-modal' : ConfirmationModal
    },

    data: {
        message: window.message,
        previous: window.previous,
        confirmDeletion: false
    },

    methods: {
        askConfirmation() {
            this.confirmDeletion = true;
        },

        deleteMessage() {
            axios.delete('/messages/' + this.message.id)
                .then(response => {
                    console.log(response);
                    this.confirmDeletion = false;
                    window.location.replace(this.previous);
                });
        },
    },
});