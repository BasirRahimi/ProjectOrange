import { ref } from 'vue';
import { defineStore } from 'pinia';
import { useRouter } from 'vue-router';

export const useCaseStore = defineStore('case', () => {
    const caseType = ref('succession');
    function setCaseType(newVal) {
        caseType.value = newVal;
    }

    const router = useRouter();
    function openCase(id) {
        let section = '';
        switch (caseType.value) {
            case 'probate':
                section = 'about-the-deceased';
                break;
            case 'succession':
                section = 'about-the-successor';
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

    return { caseType, setCaseType, openCase };
});
