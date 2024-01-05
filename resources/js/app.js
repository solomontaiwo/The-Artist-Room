import './bootstrap';

// Import del componente Vue
import { createApp } from 'vue';
import ExhibitionComponent from '/resources/js/ExhibitionComponent.vue';

const app = createApp({});

// Registra la componente ExhibitionComponent globalmente
app.component('exhibition-component', ExhibitionComponent);

// Collega definita sopra all'elemento #app
app.mount('#app');