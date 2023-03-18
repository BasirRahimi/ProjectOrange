import { ref } from 'vue';
import { defineStore } from 'pinia';
import { useRouter } from 'vue-router';

export const useCaseStore = defineStore('case', () => {
    // globals
    const router = useRouter();

    // store state
    const caseType = ref('probate');
    const activeCase = ref({id: null});
    
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

    return { caseType, activeCase, setCaseType, openCase, setActiveCase };
});
