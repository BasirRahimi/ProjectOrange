<template>
    <div class="container">
        <div class="search mb-4 d-flex">
            <BaseInput
                wrapperClasses="shadow me-3"
                class="border-0 p-2"
                placeholder="Search for a case..."
                addonLeftIcon="fa-solid fa-magnifying-glass"
                :mb-4="false"
                v-model="searchText" />
            <BaseButton
                type="primary"
                outline
                class="text-nowrap shadow"
                @click="createNewCase"
                >New case <i class="fa-solid fa-plus"></i
            ></BaseButton>
        </div>
        <div class="card shadow p-4 mb-3">
            <table class="table text-gray-500 table-borderless">
                <thead class="border-bottom">
                    <tr>
                        <th scope="col" class="fw-normal">
                            <a
                                href="#"
                                class="text-gray-500"
                                @click.prevent="updateOrder('name')">
                                <div class="d-flex align-items-center">
                                    Case Name
                                    <div class="sort ms-3">
                                        <i class="fa-solid fa-chevron-up"></i>
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </div>
                                </div>
                            </a>
                        </th>
                        <th scope="col" class="fw-normal">
                            <a
                                href="#"
                                class="text-gray-500"
                                @click.prevent="updateOrder('created_at')">
                                <div class="d-flex align-items-center">
                                    Date created
                                    <div class="sort ms-3">
                                        <i class="fa-solid fa-chevron-up"></i>
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </div>
                                </div>
                            </a>
                        </th>
                        <th scope="col" class="fw-normal">
                            <a
                                href="#"
                                class="text-gray-500"
                                @click.prevent="updateOrder('pre_submitted')">
                                <div class="d-flex align-items-center">
                                    Pre-submitted?
                                    <div class="sort ms-3">
                                        <i class="fa-solid fa-chevron-up"></i>
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </div>
                                </div>
                            </a>
                        </th>
                        <th scope="col" class="fw-normal">
                            <a
                                href="#"
                                class="text-gray-500"
                                @click.prevent="updateOrder('status')">
                                <div class="d-flex align-items-center">
                                    Status
                                    <div class="sort ms-3">
                                        <i class="fa-solid fa-chevron-up"></i>
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </div>
                                </div>
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody class="position-relative">
                    <div
                        class="frosted-glass"
                        :class="{ active: isSearching }"></div>
                    <tr
                        v-for="singleCase in searchResult.data"
                        @click="openCase(singleCase.id)">
                        <td>{{ singleCase.name }}</td>
                        <td>
                            {{
                                moment(singleCase.created_at).format('DD/MM/YY')
                            }}
                        </td>
                        <!-- <td
                            :class="{
                                Yes: singleCase.preSubmitted,
                                No: !singleCase.preSubmitted
                            }">
                            <i class="fa-solid fa-circle me-2"></i
                            >{{ singleCase.preSubmitted ? 'Yes' : 'No' }}
                        </td> -->
                        <td class="No">
                            <i class="fa-solid fa-circle me-2"></i>No
                        </td>
                        <td :class="singleCase.status.replace(/ /g, '')">
                            <i class="fa-solid fa-circle me-2"></i
                            >{{ singleCase.status }}
                        </td>
                    </tr>
                    <tr class="no-cases" v-if="noCases">
                        <td colspan="4" class="pt-5">
                            <img
                                src="@images/step_1.png"
                                alt="no cases"
                                class="d-block m-auto mb-5" />
                            <div class="text-center">
                                <p class="mb-2">You have no cases yet</p>
                                <a href="#" @click.prevent="createNewCase"
                                    >Get started with your first succession case
                                    <i class="fa-solid fa-plus"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-between px-2 mb-5">
            <div class="text-gray-600">
                Showing
                <b>{{ searchResult.from }} to {{ searchResult.to }}</b> of
                <b>{{ searchResult.total }}</b> cases
            </div>
            <div id="pageNav">
                <a href="#" @click.prevent="updatePage(currentPage - 1)">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <a
                    v-if="navItems.hiddenPrev.length"
                    href="#"
                    @click.prevent="updatePage(1)">
                    1
                </a>
                <span v-if="navItems.hiddenPrev.length" class="px-1">...</span>
                <a
                    v-for="pageNumber in navItems.visiblePages"
                    href="#"
                    @click.prevent="updatePage(pageNumber)"
                    :class="{ 'fw-bold': pageNumber === currentPage }">
                    {{ pageNumber }}
                </a>
                <span v-if="navItems.hiddenNext.length" class="px-1">...</span>
                <a
                    v-if="navItems.hiddenNext.length"
                    href="#"
                    @click.prevent="updatePage(searchResult.last_page)">
                    {{ searchResult.last_page }}
                </a>
                <a href="#" @click.prevent="updatePage(currentPage + 1)">
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios';
import { ref, onMounted, computed, watch } from 'vue';
import { useDebouncedRef } from '@/composables/helper.js';
import moment from 'moment';

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
    if (newOrderBy === 'pre_submitted') return;
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

onMounted(() => {
    getCases();
    axios
        .get(`/api/cases?case-type=${props.caseType}&count-only=true`)
        .then((response) => {
            if (response.data == 0) {
                noCases.value = true;
            }
        });
});

const openCase = (id) => {
    //TODO: Enable When Case Web Routes Are Working or Case SPA is working.
    return;
    window.location = `${window.location.origin}/cases/${id}`;
};

const createNewCase = () => {
    //TODO: Enable When Case Web Routes Are Working or Case SPA is working.
    return;
    axios
        .post(`/case/${props.caseType}`)
        .then((response) => {
            openCase(response.data.id);
        })
        .catch((error) => {
            console.log(error);
        });
};
</script>
<style lang="scss" scoped id="caseFlowsStyle">
@import '@sass/vue_sfc.scss';

.search :deep(.input-group-text) {
    font-size: 1.1rem;
    color: $primary;
    background-color: $white;
    border: 0;

    i {
        transform: rotateY(180deg);
    }
}

tbody tr {
    &:not(.no-cases) {
        cursor: pointer;
        transition: $transition-base;
        &:hover {
            background-color: $gray-200;
        }
    }

    &.no-cases {
        img {
            max-width: 300px;
            width: 100%;
        }
    }
}

.sort {
    display: flex;
    flex-direction: column;
    font-size: 0.5rem;
}

#pageNav {
    display: flex;
    a {
        color: $gray-600;
        padding: 0 0.25rem;
    }
    .dots {
        padding: 0 0.5rem;
    }
}

td {
    i.fa-circle {
        font-size: 0.625rem;
        position: relative;
        top: -1px;
    }
}
.InputRequired {
    i {
        color: $primary;
    }
}
.Approved,
.Yes {
    i {
        color: $green;
    }
}
.No {
    i {
        color: $red;
    }
}

.frosted-glass {
    /* From https://css.glass */
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(2px);
    -webkit-backdrop-filter: blur(10px);

    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    display: none;

    &.active {
        display: block;
    }
    z-index: 10;
}
</style>
