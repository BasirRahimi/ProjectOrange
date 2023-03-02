<template>
    <div class="desk">
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
                @click="createNewClient"
                >New case <i class="fa-solid fa-plus"></i
            ></BaseButton>
        </div>
        <div class="card shadow p-4 mb-3">
            <table class="table text-gray-500 table-borderless">
                <thead class="border-bottom">
                    <tr>
                        <th scope="col" class="fw-normal">
                            <div class="d-flex align-items-center">
                                Case Name
                                <div class="sort ms-3">
                                    <i class="fa-solid fa-chevron-up"></i>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                            </div>
                        </th>
                        <th scope="col" class="fw-normal">
                            <div class="d-flex align-items-center">
                                Date created
                                <div class="sort ms-3">
                                    <i class="fa-solid fa-chevron-up"></i>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                            </div>
                        </th>
                        <th scope="col" class="fw-normal">
                            <div class="d-flex align-items-center">
                                Pre-submitted?
                                <div class="sort ms-3">
                                    <i class="fa-solid fa-chevron-up"></i>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                            </div>
                        </th>
                        <th scope="col" class="fw-normal">
                            <div class="d-flex align-items-center">
                                Status
                                <div class="sort ms-3">
                                    <i class="fa-solid fa-chevron-up"></i>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="singleCase in filteredCases"
                        @click="openCase(singleCase.id)">
                        <td>{{ singleCase.name }}</td>
                        <td>
                            {{
                                moment(singleCase.dateCreated).format(
                                    'DD/MM/YY'
                                )
                            }}
                        </td>
                        <td
                            :class="{
                                yes: singleCase.preSubmitted,
                                no: !singleCase.preSubmitted
                            }">
                            <i class="fa-solid fa-circle me-2"></i
                            >{{ singleCase.preSubmitted ? 'Yes' : 'No' }}
                        </td>
                        <td class="input-required">
                            <i class="fa-solid fa-circle me-2"></i
                            >{{ singleCase.status }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-between px-2">
            <div class="text-dark">
                Showing
                <b>{{
                    `${probateStore.cases.length} of ${probateStore.totalCases}`
                }}</b>
                cases
            </div>
            <div>
                <i class="fa-solid fa-arrow-left"></i> <b>1</b> 2 3 ... 4
                <i class="fa-solid fa-arrow-right"></i>
            </div>
        </div>
    </div>
</template>
<script setup>
// MUST STORE CLIENTS ON STORE AND RENAME CLIENTS TO PROBATE CASES or something
import { useProbateStore } from '@/stores/probate.js';
import { ref, onMounted, computed } from 'vue';
import moment from 'moment';
import BaseInput from '@/components/simple/BaseInput.vue';
import BaseButton from '@/components/simple/BaseButton.vue';

const probateStore = useProbateStore();

const searchText = ref('');

const filteredCases = computed(() => {
    return searchText.value
        ? probateStore.cases.filter((x) =>
              x.name.toLowerCase().includes(searchText.value.toLowerCase())
          )
        : probateStore.cases;
});

const openCase = (id) => {
    window.location = `${window.location.origin}/clients/${id}`;
};

const createNewClient = () => {
    axios
        .post('/clients')
        .then((response) => {
            console.log(response.data);
            openCase(response.data.id);
        })
        .catch((error) => {
            console.log(error);
        });
};

onMounted(() => {
    probateStore.fetchCases();
});
</script>

<style lang="scss" scoped>
@import '@sass/vue_sfc.scss';
.desk {
    padding: 6rem;
}
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
    cursor: pointer;
    transition: $transition-base;
    &:hover {
        background-color: $gray-200;
    }
}

td {
    i {
        font-size: 0.625rem;
    }
    &.no {
        display: flex;
        align-items: center;
        i {
            color: #ff6262; // TODO: Put this in a variable in scss
        }
    }
    &.yes {
        i {
            color: #b1e058; // TODO: Put this in a variable in scss
        }
    }

    &.input-required {
        i {
            color: #fb952c; // TODO: Put this in a variable in scss
        }
    }
}

.sort {
    display: flex;
    flex-direction: column;
    font-size: 0.5rem;
}
</style>
