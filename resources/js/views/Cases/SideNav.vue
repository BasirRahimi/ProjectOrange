<template>
    <div class="mb-3">
        <button
            class="section-toggle"
            :class="{ 'text-center': navCollapsed }"
            @click="caseDetailsOpen = !caseDetailsOpen">
            <span v-if="!navCollapsed">CASE DETAILS</span
            ><i
                class="fas fa-chevron-right"
                :class="[
                    { active: caseDetailsOpen },
                    { 'ms-2': !navCollapsed }
                ]"></i>
        </button>
        <BCollapse :visible="caseDetailsOpen">
            <ul class="fa-ul mb-0">
                <li class="py-2 section-link">
                    <RouterLink :to="getRouterLink('about-the-deceased')">
                        <span class="fa-li">
                            <i class="me-2 po-icon-person"></i>
                        </span>
                        About the deceased
                    </RouterLink>
                </li>
                <li class="py-2 section-link">
                    <RouterLink :to="getRouterLink('executors')">
                        <span class="fa-li">
                            <i class="fas fa-user-tie me-2"></i>
                        </span>
                        Executors
                    </RouterLink>
                </li>
            </ul>
        </BCollapse>

        <button
            class="section-toggle"
            :class="{ 'text-center': navCollapsed }"
            @click="sectionsOpen = !sectionsOpen">
            <span v-if="!navCollapsed">SECTIONS</span
            ><i
                class="fas fa-chevron-right"
                :class="[
                    { active: sectionsOpen },
                    { 'ms-2': !navCollapsed }
                ]"></i>
        </button>
        <BCollapse :visible="sectionsOpen">
            <ul class="fa-ul mb-0">
                <li
                    class="py-2 section-link"
                    v-for="(section, index) in sections"
                    :key="index">
                    <RouterLink :to="getRouterLink(section.routerSectionParam)">
                        <span class="fa-li">
                            <i :class="section.navIcon" class="me-2"></i>
                        </span>
                        {{ section.navLabel }}
                    </RouterLink>
                </li>
            </ul>
        </BCollapse>
    </div>
</template>

<script setup>
import { computed, ref, onMounted, watch } from 'vue';
import { useRoute } from 'vue-router';
import BCollapse from '@/components/simple/BCollapse.vue';
import * as probateSections from '@/components/forms/probate.js';
const route = useRoute();

const caseDetailsOpen = ref(true);
const sectionsOpen = ref(true);

const sections = computed(() => {
    let sections = Object.keys(probateSections).filter(
        (x) => x != 'AboutTheDeceased' && x != 'Executors' && x != 'Overview'
    );
    let x = [];
    for (let i = 0; i < sections.length; i++) {
        x.push(probateSections[sections[i]]);
    }
    x.sort((a, b) => {
        if (a.order < b.order) {
            return -1;
        } else {
            return 1;
        }
    });
    return x;
});

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

const getRouterLink = (url) => {
    return {
        name: 'EditCase',
        params: { id: route.params.id, section: url }
    };
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
        &.router-link-exact-active {
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
