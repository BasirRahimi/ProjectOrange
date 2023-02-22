<template>
    <nav
        aria-label="form navigation"
        class="client-form-navigation shadow"
        :class="[{ collapsed: navCollapsed }, { 'nav-hidden': navHidden }]">
        <button
            class="nav-toggle"
            @click="navCollapsed = !navCollapsed"
            v-if="false">
            <div class="text" v-if="!navCollapsed">NAVIGATION</div>
            <div class="icons" :class="{ 'm-auto': navCollapsed }">
                <i v-if="!navCollapsed" class="fas fa-chevron-left me-1"></i>
                <i class="fas fa-bars"></i>
                <i v-if="navCollapsed" class="fas fa-chevron-right ms-1"></i>
            </div>
        </button>

        <div class="d-xl-none" v-if="false">
            <button
                class="section-toggle"
                :class="{ 'text-center': navCollapsed }"
                @click="toolsOpen = !toolsOpen">
                <span v-if="!navCollapsed">TOOLS</span
                ><i
                    class="fas fa-chevron-right"
                    :class="[
                        { active: toolsOpen },
                        { 'ms-2': !navCollapsed }
                    ]"></i>
            </button>
            <div
                class="section-collapse"
                :class="{ collapsed: !toolsOpen || navCollapsed }"
                ref="sectionCollapse">
                <!-- :style="{height: `${toolsOpenHeight}px`}" -->
                <a
                    class="show-reminder-form py-2"
                    href="#"
                    @click.prevent="showReminderForm = !showReminderForm"
                    ><i
                        class="fas me-2"
                        :class="[
                            { 'fa-plus': !showReminderForm },
                            { 'fa-minus': showReminderForm }
                        ]"></i
                    >Set new reminder</a
                >
                <CreateReminder
                    v-show="showReminderForm"
                    class="py-2"
                    :small="true" />
            </div>
        </div>
        <div class="d-xl-none" v-if="false">
            <button
                class="section-toggle"
                :class="{ 'text-center': navCollapsed }"
                @click="documentsOpen = !documentsOpen">
                <span v-if="!navCollapsed">SECTION DOCUMENTS</span
                ><i
                    class="fas fa-chevron-right"
                    :class="[
                        { active: documentsOpen },
                        { 'ms-2': !navCollapsed }
                    ]"></i>
            </button>
            <div
                class="section-collapse"
                :class="{ collapsed: !documentsOpen }"
                ref="sectionCollapse">
                <!-- :style="{height: `${documentsOpenHeight}px`}" -->
                <required-docs :inSideNav="true"></required-docs>
            </div>
        </div>

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
        <div class="section-collapse" :class="{ collapsed: !caseDetailsOpen }">
            <!-- :style="{height: `${caseDetailsOpenHeight}px`}" -->
            <ul class="fa-ul mb-0">
                <li
                    class="py-2 section-link"
                    :class="{ active: 'AboutTheDeceased' == currentRouteName }">
                    <a
                        href="#"
                        @click.prevent="sectionClick('AboutTheDeceased')">
                        <span class="fa-li">
                            <i class="me-2 po-icon-person"></i>
                        </span>
                        About the deceased
                    </a>
                </li>
                <li
                    class="py-2 section-link"
                    :class="{ active: 'Executors' == currentRouteName }">
                    <a href="#" @click.prevent="sectionClick('Executors')">
                        <span class="fa-li">
                            <i class="fas fa-user-tie me-2"></i>
                        </span>
                        Executors
                    </a>
                </li>
            </ul>
        </div>

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
        <div
            class="section-collapse"
            :class="{ collapsed: !sectionsOpen }"
            ref="sectionCollapse">
            <!-- :style="{height: `${sectionsOpenHeight}px`}" -->
            <ul class="fa-ul mb-0">
                <li
                    class="py-2 section-link"
                    :class="{ active: section.routeName == currentRouteName }"
                    v-for="(section, index) in sections"
                    :key="index">
                    <a
                        :tabindex="sectionsOpen ? 0 : -1"
                        href="#"
                        @click.prevent="sectionClick(section.routeName)">
                        <span class="fa-li">
                            <i :class="section.icon" class="me-2"></i>
                        </span>
                        {{ section.label }}
                    </a>
                </li>
            </ul>
        </div>
        <button class="section-toggle" :class="{ 'text-center': navCollapsed }">
            <span v-if="!navCollapsed">REMINDERS</span
            ><i
                class="fas fa-chevron-right"
                :class="{ 'ms-2': !navCollapsed }"></i>
        </button>
        <br />
        <button class="section-toggle" :class="{ 'text-center': navCollapsed }">
            <span v-if="!navCollapsed">NEED HELP?</span
            ><i
                class="fas fa-chevron-right"
                :class="{ 'ms-2': !navCollapsed }"></i>
        </button>
    </nav>
</template>
<script setup>
import { computed, ref, onMounted, watch } from 'vue';
import CreateReminder from '@/components/forms/CreateReminder.vue';
import RequiredDocs from '@/components/forms/widgets/RequiredDocs.vue';
import { useRouter, useRoute } from 'vue-router';
const router = useRouter();
const route = useRoute();

const props = defineProps({ navHidden: { type: Boolean, default: false } });
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

const caseDetailsOpen = ref(true);
const sectionsOpen = ref(true);
// const sectionsOpenHeight = '620';
// const toolsOpenHeight = '60';
const toolsOpen = ref(true);
const documentsOpen = ref(true);
const navCollapsed = ref(false);
const showReminderForm = ref(false);
const currentRouteName = computed(() => {
    return route.name;
});

onMounted(() => {
    let nav = $('.client-form-navigation');
    if (window.innerWidth < 1500 && window.innerWidth > 991) {
        navCollapsed.value = true;
        $(nav).hover(
            (e) => {
                // hover in
                if (navCollapsed.value) {
                    navCollapsed.value = false;
                }
            },
            (e) => {
                // hover out
                if (!navCollapsed.value) {
                    navCollapsed.value = true;
                }
            }
        );
    }
});

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

.client-form-navigation {
    position: fixed;
    top: 60px;
    left: 0;
    background-color: $white;
    padding: 20px;
    max-width: 300px;
    height: calc(100% - 60px);
    transition: 0.25s;
    overflow-y: scroll;
    white-space: nowrap;
    z-index: 1;

    &::-webkit-scrollbar {
        width: 0;
    }

    &.collapsed {
        max-width: 40px;
        padding-left: 0;
        padding-right: 0;
    }
}

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

.section-collapse {
    transition: 0.25s;
    overflow: hidden;

    &.collapsed {
        height: 0 !important;
    }
}

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

@include media-breakpoint-down(lg) {
    .client-form-navigation {
        &.nav-hidden {
            top: 100%;
        }
    }
}
</style>
