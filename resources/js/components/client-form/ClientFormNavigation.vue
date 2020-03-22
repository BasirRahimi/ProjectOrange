<template>
  <nav aria-label="form navigation" class="client-form-navigation shadow" :class="{'collapsed':navCollapsed}">

    <button class="nav-toggle" @click="navCollapsed = !navCollapsed">
      <div class="text" v-if="!navCollapsed">NAVIGATION</div>
      <div class="icons" :class="{'m-auto': navCollapsed}">
        <i v-if="!navCollapsed" class="fas fa-chevron-left mr-1"></i>
        <i class="fas fa-bars"></i>
        <i v-if="navCollapsed" class="fas fa-chevron-right ml-1"></i>
      </div>
    </button>

    <div class="d-xl-none">
      <button class="section-toggle" :class="{'text-center': navCollapsed}" @click="toolsOpen = !toolsOpen">
        <span v-if="!navCollapsed">TOOLS</span><i class="fas fa-chevron-right" :class="[{'active': toolsOpen}, {'ml-2': !navCollapsed}]"></i>
      </button>
      <div class="section-collapse" :class="{'collapsed': !toolsOpen || navCollapsed}"  ref="sectionCollapse"> <!-- :style="{height: `${toolsOpenHeight}px`}" -->
        <a class="show-reminder-form py-2" href="#" @click.prevent="showReminderForm = !showReminderForm"><i class="fas mr-2" :class="[{'fa-plus':!showReminderForm},{'fa-minus':showReminderForm}]"></i>Set new reminder</a>
        <create-reminder v-show="showReminderForm" class="py-2" :small="true"></create-reminder>
      </div>
    </div>
    <div class="d-xl-none">
      <button class="section-toggle" :class="{'text-center': navCollapsed}" @click="documentsOpen = !documentsOpen">
        <span v-if="!navCollapsed">SECTION DOCUMENTS</span><i class="fas fa-chevron-right" :class="[{'active': documentsOpen}, {'ml-2': !navCollapsed}]"></i>
      </button>
      <div class="section-collapse" :class="{'collapsed': !documentsOpen}"  ref="sectionCollapse"> <!-- :style="{height: `${documentsOpenHeight}px`}" -->
        <required-docs :inSideNav="true"></required-docs>
      </div>
    </div>

    <button class="section-toggle" :class="{'text-center': navCollapsed}" @click="sectionsOpen = !sectionsOpen">
      <span v-if="!navCollapsed">SECTIONS</span><i class="fas fa-chevron-right" :class="[{'active': sectionsOpen}, {'ml-2': !navCollapsed}]"></i>
    </button>
    <div class="section-collapse" :class="{'collapsed': !sectionsOpen}"  ref="sectionCollapse"> <!-- :style="{height: `${sectionsOpenHeight}px`}" -->
      <ul class="fa-ul mb-0">
        <li class="py-2 section-link" :class="{'active': section.active}" v-for="(section,index) in sections" :key="index">
          <a :tabindex="sectionsOpen ? 0 : -1" href="#" @click="sectionClick(index)">
            <span class="fa-li">
              <i :class="section.icon" class="mr-2 icon"></i>
            </span>
            {{section.label}}
          </a>
        </li>
      </ul>
    </div>
    <button class="section-toggle" :class="{'text-center': navCollapsed}">
      <span v-if="!navCollapsed">REMINDERS</span><i class="fas fa-chevron-right" :class="{'ml-2':!navCollapsed}"></i>
    </button>
    <br>
    <button class="section-toggle" :class="{'text-center': navCollapsed}">
      <span v-if="!navCollapsed">NEED HELP?</span><i class="fas fa-chevron-right" :class="{'ml-2':!navCollapsed}"></i>
    </button>
  </nav>
</template>
<script>
import CreateReminder from './CreateReminder';
import RequiredDocs from './widgets/RequiredDocs';

export default {
  name: 'ClientFormNavigation',
  components: {
    CreateReminder,
    RequiredDocs
  },
  data() {
    return {
      sections: [
        {
          label:'About',
          icon: 'po-icon-person',
          active: true
        },
        {
          label:'Powers of Attorney',
          icon: 'fas fa-pen-nib',
          active: false
        },
        {
          label:'Will & Marital Status',
          icon: 'po-icon-ring',
          active: false
        },
        {
          label:'Lifetime gifts',
          icon: 'po-icon-present',
          active: false
        },
        {
          label:'Gifts',
          icon: 'fas fa-gifts',
          active: false
        },
        {
          label:'UK & British Isles',
          icon: 'po-icon-flag',
          active: false
        },
        {
          label:'Tax Havens',
          icon: 'po-icon-world',
          active: false
        },
        {
          label:'Nil-Rate band',
          icon: 'po-icon-pound',
          active: false
        },
        {
          label:'Business interests',
          icon: 'po-icon-briefcase',
          active: false
        },
        {
          label:'Received inheritance',
          icon: 'po-icon-debit-card',
          active: false
        },
        {
          label:'Trusts',
          icon: 'po-icon-handshake',
          active: false
        },
        {
          label:'Pensions',
          icon: 'po-icon-piggybank',
          active: false
        },
        {
          label:'Life Assurance',
          icon: 'po-icon-lifebuoy',
          active: false
        },
        {
          label:'Joint held assets',
          icon: 'po-icon-people',
          active: false
        },
        {
          label:'Stocks & Shares',
          icon: 'po-icon-graph',
          active: false
        },
        {
          label:'Bank and savings',
          icon: 'po-icon-dollar',
          active: false
        },
        {
          label:'Personal belongings',
          icon: 'po-icon-tv',
          active: false
        },
        {
          label:'Assets',
          icon: 'po-icon-house',
          active: false
        },
        {
          label:'Liabilities',
          icon: 'po-icon-car',
          active: false
        },
        {
          label:'Other information',
          icon: 'po-icon-information',
          active: false
        },
      ],
      sectionsOpen: true,
      // sectionsOpenHeight: '620',
      toolsOpen: true,
      // toolsOpenHeight: '60',
      documentsOpen: true,
      navCollapsed: false,
      showReminderForm: false
    }
  },
  methods: {
    sectionClick(index) {
      this.sections.find(x=>x.active == true).active = false;
      this.sections[index].active = true;
    }
  },
  watch: {
    navCollapsed(newVal) {
      this.$emit('navToggled', newVal);
    },
    // showReminderForm(newVal) {
    //   this.toolsOpenHeight = 
    // }
  },
}
</script>
<style lang="scss" scoped>
@import '~@/_variables.scss';

.client-form-navigation {
  position: fixed;
  top: 60px;
  left: 0;
  background-color: $white;
  padding: 20px;
  width: 210px;
  height: calc(100% - 60px);
  transition: .25s;
  overflow-y: scroll;
  white-space: nowrap;
  &::-webkit-scrollbar {
    width: 0;
  }
  &.collapsed {
    width: 35px;
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
</style>