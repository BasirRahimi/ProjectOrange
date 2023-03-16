<template>
    <div>

        <button class="section-toggle" :class="{ 'text-center': navCollapsed }" @click="caseDetailsCollapse.toggle()">
            <span v-if="!navCollapsed">CASE DETAILS</span><i class="fas fa-chevron-right" :class="[
                { active: caseDetailsOpen },
                { 'ms-2': !navCollapsed }
            ]"></i>
        </button>
        <BCollapse v-model="caseDetailsOpen" ref="caseDetailsCollapse">
            <!-- :style="{height: `${caseDetailsOpenHeight}px`}" -->
            <ul class="fa-ul mb-0">
                <li class="py-2 section-link" :class="{ active: 'AboutTheDeceased' == currentRouteName }">
                    <a href="#" @click.prevent="sectionClick('AboutTheDeceased')">
                        <span class="fa-li">
                            <i class="me-2 po-icon-person"></i>
                        </span>
                        About the deceased
                    </a>
                </li>
                <li class="py-2 section-link" :class="{ active: 'Executors' == currentRouteName }">
                    <a href="#" @click.prevent="sectionClick('Executors')">
                        <span class="fa-li">
                            <i class="fas fa-user-tie me-2"></i>
                        </span>
                        Executors
                    </a>
                </li>
            </ul>
        </BCollapse>
        <!-- <div class="section-collapse" :class="{ collapsed: !caseDetailsOpen }">
        </div> -->

        <button class="section-toggle" :class="{ 'text-center': navCollapsed }" @click="sectionsCollapse.toggle()">
            <span v-if="!navCollapsed">SECTIONS</span><i class="fas fa-chevron-right" :class="[
                { active: sectionsOpen },
                { 'ms-2': !navCollapsed }
            ]"></i>
        </button>
        <BCollapse ref="sectionsCollapse" v-model="sectionsOpen">
            <!-- :style="{height: `${sectionsOpenHeight}px`}" -->
            <ul class="fa-ul mb-0">
                <li class="py-2 section-link" :class="{ active: section.routeName == currentRouteName }"
                    v-for="(section, index) in sections" :key="index">
                    <a :tabindex="sectionsOpen ? 0 : -1" href="#" @click.prevent="sectionClick(section.routeName)">
                        <span class="fa-li">
                            <i :class="section.icon" class="me-2"></i>
                        </span>
                        {{ section.label }}
                    </a>
                </li>
            </ul>
        </BCollapse>
        <!-- <div class="section-collapse" :class="{ collapsed: !sectionsOpen }" ref="sectionCollapse"></div> -->
    </div>
</template>

<script setup>
import { computed, ref, onMounted, watch } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import BCollapse from '@/components/simple/BCollapse.vue';

const router = useRouter();
const route = useRoute();

const caseDetailsCollapse = ref();
const sectionsCollapse = ref();
const caseDetailsOpen = ref(true);
const sectionsOpen = ref(true);

const sections = [
    {
        label: 'Powers of Attorney',
        icon: 'fas fa-pen-nib',
        routeName: 'Section2'
    },
    {
        label: 'Will & Marital Status',
        icon: 'po-icon-ring',
        routeName: 'Section3'
    },
    {
        label: 'Lifetime gifts',
        icon: 'po-icon-present',
        routeName: 'Section4'
    },
    {
        label: 'Gifts',
        icon: 'fas fa-gifts',
        routeName: 'Section5'
    },
    {
        label: 'UK & British Isles',
        icon: 'po-icon-flag',
        routeName: 'Section6'
    },
    {
        label: 'Tax Havens',
        icon: 'po-icon-world',
        routeName: 'Section7'
    },
    {
        label: 'Nil-Rate band',
        icon: 'po-icon-pound',
        routeName: 'Section8'
    },
    {
        label: 'Business interests',
        icon: 'po-icon-briefcase',
        routeName: 'Section9'
    },
    {
        label: 'Received inheritance',
        icon: 'po-icon-debit-card',
        routeName: 'Section10'
    },
    {
        label: 'Trusts',
        icon: 'po-icon-handshake',
        routeName: 'Section11'
    },
    {
        label: 'Pensions',
        icon: 'po-icon-piggybank',
        routeName: 'Section12'
    },
    {
        label: 'Life Assurance',
        icon: 'po-icon-lifebuoy',
        routeName: 'Section13'
    },
    {
        label: 'Joint held assets',
        icon: 'po-icon-people',
        routeName: 'Section14'
    },
    {
        label: 'Stocks & Shares',
        icon: 'po-icon-graph',
        routeName: 'Section15'
    },
    {
        label: 'Bank and savings',
        icon: 'po-icon-dollar',
        routeName: 'Section16'
    },
    {
        label: 'Personal belongings',
        icon: 'po-icon-tv',
        routeName: 'Section17'
    },
    {
        label: 'Assets',
        icon: 'po-icon-house',
        routeName: 'Section18'
    },
    {
        label: 'Liabilities',
        icon: 'po-icon-car',
        routeName: 'Section19'
    },
    {
        label: 'Other information',
        icon: 'po-icon-information',
        routeName: 'Section20'
    }
];

// const sectionsOpenHeight = '620';
// const toolsOpenHeight = '60';
const toolsOpen = ref(true);
const documentsOpen = ref(true);
const navCollapsed = ref(false);
const showReminderForm = ref(false);
const currentRouteName = computed(() => {
    return route.name;
});

// onMounted(() => {
//     let nav = $('.client-form-navigation');
//     if (window.innerWidth < 1500 && window.innerWidth > 991) {
//         navCollapsed.value = true;
//         $(nav).hover(
//             (e) => {
//                 // hover in
//                 if (navCollapsed.value) {
//                     navCollapsed.value = false;
//                 }
//             },
//             (e) => {
//                 // hover out
//                 if (!navCollapsed.value) {
//                     navCollapsed.value = true;
//                 }
//             }
//         );
//     }
// });

const sectionClick = (routeName) => {
    router.push({ name: routeName });
};
const emit = defineEmits(['toggleNav']);
watch(navCollapsed, (newVal) => {
    emit('toggleNav', newVal);
});
</script>

<style lang="scss" scoped>
@import '@sass/vue_sfc.scss';

.section-toggle {
    font-size: 12px;
    font-weight: 600;
    border: none;
    background-color: $white;
    padding: 0;
    margin: 8px 0;
    color: #bec0be;
    text-align: left;
    width: 100%;
    outline: none;
}

.fa-chevron-right {
    transition: 0.25s;

    &.active {
        transform: rotateZ(90deg);
    }
}

.section-link {
    a {
        display: block;
        text-decoration: none;
        color: $body-color;
        transition: 0.25s;
        font-weight: 400;

        &:hover {
            color: $primary;

            //po icons
            .icon {
                &::before {
                    color: $primary;
                }
            }
        }

        //po icons
        .icon {
            &::before {
                transition: 0.25s;
                color: $body-color;
            }
        }
    }

    &.active {
        a {
            color: $primary;

            //po icons
            .icon {
                &::before {
                    color: $primary;
                }
            }
        }
    }
}

// .section-collapse {
//     transition: 0.25s;
//     overflow: hidden;

//     &.collapsed {
//         height: 0 !important;
//     }
// }

.nav-toggle {
    display: flex;
    align-items: center;
    padding: 8px 0;
    font-size: 14px;
    font-weight: 600;
    border: none;
    background-color: $white;
    color: #979a97;
    width: 100%;
    text-align: left;

    .text {
        flex-grow: 1;
    }

    .icons {
        font-size: 12px;
    }
}

.show-reminder-form {
    transition: 0.25s;
    color: $body-color;
    text-decoration: none;
    display: flex;
    align-items: center;

    &:hover {
        color: $primary;
    }

    .fas {
        font-size: 12px;
    }
}
</style>