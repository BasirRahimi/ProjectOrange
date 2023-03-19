import { ref } from 'vue';
import { defineStore } from 'pinia';
import { useRouter } from 'vue-router';

export const useCaseStore = defineStore('case', () => {
    // globals
    const router = useRouter();

    // store state
    const caseType = ref('probate');
    const activeCase = ref({ id: null });

    // actions
    function setCaseType(newVal) {
        caseType.value = newVal;
    }

    function openCase(id) {
        let section = '';
        switch (caseType.value) {
            case 'probate':
                section = 'about-the-deceased';
                break;
            default:
                break;
        }
        if (!section) return;
        router.push({
            name: 'EditCase',
            params: { id: id, section: section }
        });
    }

    function setActiveCase(id) {
        activeCase.value.id = id;
    }

    async function saveCaseData(id, section, data) {
        if (!id) {
            id = activeCase.value.id;
        }
        let response = await axios.post(`/api/case-data/${id}`, {
            section,
            data
        });
        console.log(response);
        return response;
    }
    async function fetchCaseData(id, section) {
        if (!id) {
            id = activeCase.value.id;
        }
        let response = await axios.get(`/api/case-data/${id}`, {
            params: { section }
        });
        if (response.status === 200) {
            return response.data.the_data;
        }
    }

    return {
        caseType,
        activeCase,
        setCaseType,
        openCase,
        setActiveCase,
        saveCaseData,
        fetchCaseData
    };
});
