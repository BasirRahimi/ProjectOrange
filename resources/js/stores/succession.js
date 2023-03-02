/**
 * SUCCESSION CASES STORE
 */
import { ref } from 'vue';
import { defineStore } from 'pinia';
import axios from 'axios';

export const useSuccessionStore = defineStore('succession', () => {
    const cases = ref([]);

    const totalCases = ref(0);

    const fetchCases = async () => {
        let response = await axios.get(`/cases/succession?page=1&per-page=10`);
        cases.value = response.data.map((x) => {
            let name = '';
            if (x.forename && x.surname) {
                name = `${x.forename} ${x.surname}`;
            } // NOTE: These won't be allowed to be null after clients refactor
            return {
                id: x.id,
                name: name,
                dateCreated: new Date(x.created_at),
                preSubmitted: 0, // TODO: replace with correct property after clients refactor
                status: 'Input Required' // TODO: replace with correct property after clients refactor
            };
        });

        // TODO: Replace with actual totalCases which will be in the paginated response
        totalCases.value = cases.value.length;
    };

    return { cases, totalCases, fetchCases };
});
