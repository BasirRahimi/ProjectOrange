<template>
    <div class="mb-3" v-if="route.params.id">
        <template v-for="section in sections">
            <button
                class="section-toggle"
                :class="{ 'text-center': navCollapsed }"
                @click="section.collapsed = !section.collapsed">
                <span v-if="!navCollapsed">{{ section.title }}</span>
                <i
                    class="fas fa-chevron-right"
                    :class="[
                        { active: !section.collapsed },
                        { 'ms-2': !navCollapsed }
                    ]"></i>
            </button>
            <BCollapse :visible="!section.collapsed">
                <ul class="fa-ul mb-0">
                    <li
                        class="py-2 section-link"
                        v-for="(sectionComponent, index) in section.sections"
                        :key="index">
                        <RouterLink
                            :to="
                                getRouterLink(
                                    sectionComponent.routerSectionParam
                                )
                            "
                            @click="scrollToTop">
                            <span class="fa-li">
                                <i
                                    :class="sectionComponent.navIcon"
                                    class="me-2"></i>
                            </span>
                            {{ sectionComponent.navLabel }}
                        </RouterLink>
                    </li>
                </ul>
            </BCollapse>
        </template>
    </div>
</template>

<script setup>
import { computed, ref, watch } from 'vue';
import { useRoute } from 'vue-router';
import { scrollToTop } from '@/composables/helper';
import BCollapse from '@/components/simple/BCollapse.vue';
import { formSections as probateSections } from '@/components/forms/probate.js';

const route = useRoute();

const sections = ref([
    {
        title: 'CASE DETAILS',
        sections: probateSections.slice(0, 2),
        collapsed: false
    },
    {
        title: 'SECTIONS',
        sections: probateSections.slice(2),
        collapsed: false
    }
]);

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
