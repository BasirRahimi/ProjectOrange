<template>
    <div class="container">
        <ContentBox>
            What type of case is this?
            <BaseButton icon="po-icon-person"> Succession Case </BaseButton>
        </ContentBox>
    </div>
</template>

<script setup>
import axios from 'axios';
import { ref, onMounted, computed, watch } from 'vue';
import { useDebouncedRef } from '@/composables/helper.js';
import moment from 'moment';
import ContentBox from '@/components/simple/ContentBox.vue';
import BaseButton from '@/components/simple/BaseButton.vue';

const props = defineProps({
    caseType: String
});

const noCases = ref(false);

/**
 * Search
 * - api call updating listing array
 */
const searchText = useDebouncedRef('', 500);
const order = ref('desc');
const orderBy = ref('created_at');
const currentPage = ref(1);
const perPage = ref(10);
const searchResult = ref({ data: [] });
const isSearching = ref(false);
const getCases = async () => {
    if (isSearching.value) return;
    isSearching.value = true;
    const data = await axios({
        method: 'get',
        url: '/api/cases',
        params: {
            search: searchText.value.trim(),
            'case-type': props.caseType,
            order: order.value,
            'order-by': orderBy.value,
            'per-page': perPage.value,
            page: currentPage.value
        }
    });
    searchResult.value = data.data;
    isSearching.value = false;
};

watch(searchText, () => {
    if (isSearching.value) return;
    currentPage.value = 1;
    getCases();
});

/**
 * Pagination
 */
const navItems = computed(() => {
    const scale = 2;
    let start = currentPage.value - scale;
    let end = currentPage.value + scale;
    const prevItems = [];
    const nextItems = [];
    const items = [];

    if (start <= scale) {
        start = 1;
    } else if (start > scale) {
        for (let i = 2; i < start; i++) {
            prevItems.push(i);
        }
    }

    if (end >= searchResult.value.last_page - 1) {
        end = searchResult.value.last_page;
    } else if (end < searchResult.value.last_page) {
        for (let i = end + 1; i < searchResult.value.last_page; i++) {
            nextItems.push(i);
        }
    }

    for (let i = start; i <= end; i++) {
        items.push(i);
    }

    return {
        visiblePages: items,
        hiddenPrev: prevItems,
        hiddenNext: nextItems,
        scale
    };
});
const updatePage = (pageNumber) => {
    if (currentPage.value === pageNumber || isSearching.value) return;
    currentPage.value = pageNumber;
    getCases();
};

/**
 * Ordering
 */
const updateOrder = (newOrderBy) => {
    if (isSearching.value) return;
    if (orderBy.value === newOrderBy) {
        order.value = order.value === 'asc' ? 'desc' : 'asc';
    } else {
        orderBy.value = newOrderBy;
        switch (newOrderBy) {
            case 'created_at':
                order.value = 'desc';
                break;
            default:
                order.value = 'asc';
                break;
        }
    }
    getCases();
};

onMounted(async () => {
    await getCases();
});

const openCase = (id) => {
    //TODO: Enable When Case Web Routes Are Working or Case SPA is working.
    return;
    window.location = `${window.location.origin}/cases/${id}`;
};

const createNewCase = async (caseName) => {
    let response = await axios.post(`/api/cases/${props.caseType}`, {
        'case-name': caseName
    });
    openCase(response.data.id);
};
</script>
<style lang="scss" scoped>
@import '@sass/vue_sfc.scss';
</style>
