import { ref } from 'vue';
import { defineStore } from 'pinia';
import axios from 'axios';

export const useUserStore = defineStore('user', () => {
    const user = ref(null);

    const fetchUser = async (forceUpdate) => {
        if (forceUpdate || !user.value) {
            const response = await axios.get('/api/user');
            if (response.status == 200) {
                user.value = response.data;
                return response.data;
            }
        } else {
            return user;
        }
    };

    const setUser = (val) => {
        user.value = val;
    };

    return { user, fetchUser, setUser };
});
