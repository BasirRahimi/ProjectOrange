import { ref } from 'vue';
import { defineStore } from 'pinia';

export const useUserStore = defineStore('user', () => {
    const user = ref(null);

    const setUser = (data) => {
        user.value = data;
    };

    return { user, setUser };
});
