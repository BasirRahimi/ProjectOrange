<template>
    <nav aria-label="form navigation" class="client-form-navigation shadow"
        :class="[{ 'collapsed': navCollapsed }, { 'nav-hidden': navHidden }]">

        <button class="nav-toggle" @click="navCollapsed = !navCollapsed" v-if="false">
            <div class="text" v-if="!navCollapsed">NAVIGATION</div>
            <div class="icons" :class="{ 'm-auto': navCollapsed }">
                <i v-if="!navCollapsed" class="fas fa-chevron-left mr-1"></i>
                <i class="fas fa-bars"></i>
                <i v-if="navCollapsed" class="fas fa-chevron-right ml-1"></i>
            </div>
        </button>

        <div class="d-xl-none" v-if="false">
            <button class="section-toggle" :class="{ 'text-center': navCollapsed }" @click="toolsOpen = !toolsOpen">
                <span v-if="!navCollapsed">TOOLS</span><i class="fas fa-chevron-right"
                    :class="[{ 'active': toolsOpen }, { 'ml-2': !navCollapsed }]"></i>
            </button>
            <div class="section-collapse" :class="{ 'collapsed': !toolsOpen || navCollapsed }" ref="sectionCollapse">
                <!-- :style="{height: `${toolsOpenHeight}px`}" -->
                <a class="show-reminder-form py-2" href="#" @click.prevent="showReminderForm = !showReminderForm"><i
                        class="fas mr-2"
                        :class="[{ 'fa-plus': !showReminderForm }, { 'fa-minus': showReminderForm }]"></i>Set
                    new reminder</a>
                <create-reminder v-show="showReminderForm" class="py-2" :small="true"></create-reminder>
            </div>
        </div>
        <div class="d-xl-none" v-if="false">
            <button class="section-toggle" :class="{ 'text-center': navCollapsed }"
                @click="documentsOpen = !documentsOpen">
                <span v-if="!navCollapsed">SECTION DOCUMENTS</span><i class="fas fa-chevron-right"
                    :class="[{ 'active': documentsOpen }, { 'ml-2': !navCollapsed }]"></i>
            </button>
            <div class="section-collapse" :class="{ 'collapsed': !documentsOpen }" ref="sectionCollapse">
                <!-- :style="{height: `${documentsOpenHeight}px`}" -->
                <required-docs :inSideNav="true"></required-docs>
            </div>
        </div>

        <button class="section-toggle" :class="{ 'text-center': navCollapsed }"
            @click="caseDetailsOpen = !caseDetailsOpen">
            <span v-if="!navCollapsed">CASE DETAILS</span><i class="fas fa-chevron-right"
                :class="[{ 'active': caseDetailsOpen }, { 'ml-2': !navCollapsed }]"></i>
        </button>
        <div class="section-collapse" :class="{ 'collapsed': !caseDetailsOpen }">
            <!-- :style="{height: `${caseDetailsOpenHeight}px`}" -->
            <ul class="fa-ul mb-0">
                <li class="py-2 section-link" :class="{ 'active': 'section1' == currentRouteName }">
                    <a href="#" @click.prevent="sectionClick('section1')">
                        <span class="fa-li">
                            <i class="mr-2 po-icon-person"></i>
                        </span>
                        About
                    </a>
                </li>
                <li class="py-2 section-link" :class="{ 'active': 'section2' == currentRouteName }">
                    <a href="#" @click.prevent="sectionClick('section2')">
                        <span class="fa-li">
                            <i class="fas fa-user-tie mr-2"></i>
                        </span>
                        Executors
                    </a>
                </li>
            </ul>
        </div>

        <button class="section-toggle" :class="{ 'text-center': navCollapsed }" @click="sectionsOpen = !sectionsOpen">
            <span v-if="!navCollapsed">SECTIONS</span><i class="fas fa-chevron-right"
                :class="[{ 'active': sectionsOpen }, { 'ml-2': !navCollapsed }]"></i>
        </button>
        <div class="section-collapse" :class="{ 'collapsed': !sectionsOpen }" ref="sectionCollapse">
            <!-- :style="{height: `${sectionsOpenHeight}px`}" -->
            <ul class="fa-ul mb-0">
                <li class="py-2 section-link" :class="{ 'active': section.routeName == currentRouteName }"
                    v-for="(section, index) in sections" :key="index">
                    <a :tabindex="sectionsOpen ? 0 : -1" href="#" @click.prevent="sectionClick(section.routeName)">
                        <span class="fa-li">
                            <i :class="section.icon" class="mr-2"></i>
                        </span>
                        {{ section.label }}
                    </a>
                </li>
            </ul>
        </div>
        <button class="section-toggle" :class="{ 'text-center': navCollapsed }">
            <span v-if="!navCollapsed">REMINDERS</span><i class="fas fa-chevron-right"
                :class="{ 'ml-2': !navCollapsed }"></i>
        </button>
        <br>
        <button class="section-toggle" :class="{ 'text-center': navCollapsed }">
            <span v-if="!navCollapsed">NEED HELP?</span><i class="fas fa-chevron-right"
                :class="{ 'ml-2': !navCollapsed }"></i>
        </button>
    </nav>
</template>
<script>
import CreateReminder from './CreateReminder.vue';
import RequiredDocs from './widgets/RequiredDocs.vue';

export default {
    name: 'ClientFormNavigation',
    components: {
        CreateReminder,
        RequiredDocs
    },
    props: {
        navHidden: { type: Boolean, default: false }
    },
    data() {
        return {
            sections: [
                {
                    label: 'Powers of Attorney',
                    icon: 'fas fa-pen-nib',
                    routeName: 'section3'
                },
                {
                    label: 'Will & Marital Status',
                    icon: 'po-icon-ring',
                    routeName: 'section4'
                },
                {
                    label: 'Lifetime gifts',
                    icon: 'po-icon-present',
                    routeName: 'section5'
                },
                {
                    label: 'Gifts',
                    icon: 'fas fa-gifts',
                    routeName: 'section6'
                },
                {
                    label: 'UK & British Isles',
                    icon: 'po-icon-flag',
                    routeName: 'section7'
                },
                {
                    label: 'Tax Havens',
                    icon: 'po-icon-world',
                    routeName: 'section8'
                },
                {
                    label: 'Nil-Rate band',
                    icon: 'po-icon-pound',
                    routeName: 'section9'
                },
                {
                    label: 'Business interests',
                    icon: 'po-icon-briefcase',
                    routeName: 'section10'
                },
                {
                    label: 'Received inheritance',
                    icon: 'po-icon-debit-card',
                    routeName: 'section11'
                },
                {
                    label: 'Trusts',
                    icon: 'po-icon-handshake',
                    routeName: 'section12'
                },
                {
                    label: 'Pensions',
                    icon: 'po-icon-piggybank',
                    routeName: 'section13'
                },
                {
                    label: 'Life Assurance',
                    icon: 'po-icon-lifebuoy',
                    routeName: 'section14'
                },
                {
                    label: 'Joint held assets',
                    icon: 'po-icon-people',
                    routeName: 'section15'
                },
                {
                    label: 'Stocks & Shares',
                    icon: 'po-icon-graph',
                    routeName: 'section16'
                },
                {
                    label: 'Bank and savings',
                    icon: 'po-icon-dollar',
                    routeName: 'section17'
                },
                {
                    label: 'Personal belongings',
                    icon: 'po-icon-tv',
                    routeName: 'section18'
                },
                {
                    label: 'Assets',
                    icon: 'po-icon-house',
                    routeName: 'section19'
                },
                {
                    label: 'Liabilities',
                    icon: 'po-icon-car',
                    routeName: 'section20'
                },
                {
                    label: 'Other information',
                    icon: 'po-icon-information',
                    routeName: 'section21'
                },
            ],
            caseDetailsOpen: true,
            sectionsOpen: true,
            // sectionsOpenHeight: '620',
            toolsOpen: true,
            // toolsOpenHeight: '60',
            documentsOpen: true,
            navCollapsed: false,
            showReminderForm: false,
        }
    },
    computed: {
        currentRouteName() {
            return this.$route.name;
        }
    },
    mounted() {
        let _self = this;
        let nav = $('.client-form-navigation');
        if (window.innerWidth < 1500 && window.innerWidth > 991) {
            _self.navCollapsed = true;
            $(nav).hover(e => {
                // hover in
                if (_self.navCollapsed) {
                    _self.navCollapsed = false;
                }
            }, e => {
                // hover out
                if (!_self.navCollapsed) {
                    _self.navCollapsed = true;
                }
            })
        }
    },
    methods: {
        sectionClick(routeName) {
            this.$router.push({ name: routeName });
            this.navHidden = true;
        }
    },
    watch: {
        navCollapsed(newVal) {
            this.$emit('toggleNav', newVal);
        },
    },
}
</script>
<style lang="scss" scoped>
@import '@sass/vue_sfc.scss';

.client-form-navigation {
    position: fixed;
    top: 68px;
    left: 0;
    background-color: $white;
    padding: 20px;
    max-width: 300px;
    height: calc(100% - 68px);
    transition: .25s;
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
    color: #BEC0BE;
    text-align: left;
    width: 100%;
    outline: none;
}

.fa-chevron-right {
    transition: .25s;

    &.active {
        transform: rotateZ(90deg);
    }
}

.section-link {
    a {
        display: block;
        text-decoration: none;
        color: $body-color;
        transition: .25s;

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
                transition: .25s;
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
    transition: .25s;
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
    color: #979A97;
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
    transition: .25s;
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

@include media-breakpoint-down(md) {
    .client-form-navigation {
        top: 42px;
        height: calc(100% - 96px);

        &.nav-hidden {
            top: 100%;
        }
    }
}
</style>