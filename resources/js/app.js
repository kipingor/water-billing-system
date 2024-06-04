import './bootstrap';



import Alpine from 'alpinejs';
import mask from '@alpinejs/mask'
import focus from '@alpinejs/focus';
import persist from '@alpinejs/persist';
import collapse from '@alpinejs/collapse';

import Precognition from 'laravel-precognition-alpine';


window.Alpine = Alpine;

Alpine.plugin(Precognition);
Alpine.plugin(focus);
Alpine.plugin(persist);
Alpine.plugin(collapse);
Alpine.plugin(mask);


Alpine.store('darkMode', {
    on: Alpine.$persist(false).as('darkModeSetting'),
})


Alpine.data('toasts', () => ({
    list: [],
    show(message, type = 'success') {
        const toast = { id: Date.now(), message, type };
        this.list.push(toast);
        setTimeout(() => this.remove(toast.id), 5000);
    },
    remove(id) {
        this.list = this.list.filter(t => t.id !== id);
    }
}));

window.showSuccessToast = message => window.dispatchEvent(new CustomEvent('toast', { detail: { message, type: 'success' } }));
window.showErrorToast = message => window.dispatchEvent(new CustomEvent('toast', { detail: { message, type: 'error' } }));


Alpine.start();