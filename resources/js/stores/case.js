import { ref } from 'vue';
import { defineStore } from 'pinia';
import { useRouter, useRoute } from 'vue-router';
import { formSections as probateFormSections } from '@/components/forms/probate';

export const useCaseStore = defineStore('case', () => {
    // globals
    const router = useRouter();
    const route = useRoute();

    // store state
    const caseType = ref('probate');
    const activeCaseId = ref(null);

    function currentFormSection() {
        return probateFormSections.findIndex(
            (x) => x.routerSectionParam === route.params.section
        );
    }

    // actions
    function setCaseType(newVal) {
        caseType.value = newVal;
    }

    function openCase(id) {
        router.push({
            name: 'EditCase',
            params: {
                id: id,
                section: probateFormSections[0].routerSectionParam
            }
        });
    }

    function setActiveCaseId(id) {
        activeCaseId.value = id;
    }

    function navigateToSection(section) {
        router.push({
            name: 'EditCase',
            params: { id: activeCaseId.value, section }
        });

        window.scrollTo(0, 0);
    }

    function nextSection() {
        navigateToSection(
            probateFormSections[currentFormSection() + 1].routerSectionParam
        );
    }

    /** API functions */
    async function saveCaseData(data) {
        let response = await axios.post(
            `/api/case-data/${activeCaseId.value}`,
            {
                section:
                    probateFormSections[currentFormSection()]
                        .routerSectionParam,
                data
            }
        );
        console.log(response);
        return response;
    }
    async function fetchCaseData() {
        let response = await axios.get(`/api/case-data/${activeCaseId.value}`, {
            params: {
                section:
                    probateFormSections[currentFormSection()].routerSectionParam
            }
        });
        console.log(response);
        if (response.status === 200) {
            return response.data.the_data;
        }
    }

    return {
        caseType,
        activeCaseId,
        setCaseType,
        openCase,
        setActiveCaseId,
        saveCaseData,
        fetchCaseData,
        navigateToSection,
        nextSection
    };
});
