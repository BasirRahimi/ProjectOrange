import { ref } from 'vue';
import { defineStore } from 'pinia';

export const useClientStore = defineStore('client', () => {
    const client = ref(null);
    function updateClient(data) {
        client.value = data;
    }

    return { client, updateClient };
});
