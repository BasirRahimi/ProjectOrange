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
    <button class="section-toggle" :class="{'text-center': navCollapsed}" @click="sectionsOpen = !sectionsOpen">
      <span v-if="!navCollapsed">SECTIONS</span><i class="fas fa-chevron-right" :class="[{'active': sectionsOpen}, {'ml-2': !navCollapsed}]"></i>
    </button>
    <div class="section-collapse" :class="{'collapsed': !sectionsOpen}" :style="{height: `${sectionsOpenHeight}px`}" ref="sectionCollapse">
      <ul class="fa-ul mb-0">
        <li class="py-1 section-link" :class="{'active': section.active}" v-for="(section,index) in sections" :key="index">
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
export default {
  name: 'ClientFormNavigation',
  data() {
    return {
      sections: [
        {
          label:'About',
          icon: 'fas fa-user',
          active: true
        },
        {
          label:'Powers of Attorney',
          icon: 'fas fa-pen-nib',
          active: false
        },
        {
          label:'Will & Marital Status',
          icon: 'fas fa-ring',
          active: false
        },
        {
          label:'Lifetime gifts',
          icon: 'fas fa-gift',
          active: false
        },
        {
          label:'Gifts',
          icon: 'fas fa-gifts',
          active: false
        },
        {
          label:'UK & British Isles',
          icon: 'fas fa-flag',
          active: false
        },
        {
          label:'Tax Havens',
          icon: 'fas fa-globe-europe',
          active: false
        },
        {
          label:'Nil-Rate band',
          icon: 'fas fa-pound-sign',
          active: false
        },
        {
          label:'Business interests',
          icon: 'fas fa-briefcase',
          active: false
        },
        {
          label:'Received inheritance',
          icon: 'fas fa-credit-card',
          active: false
        },
        {
          label:'Trusts',
          icon: 'fas fa-handshake',
          active: false
        },
        {
          label:'Pensions',
          icon: 'fas fa-piggy-bank',
          active: false
        },
        {
          label:'Life Assurance',
          icon: 'fas fa-life-ring',
          active: false
        },
        {
          label:'Joint held assets',
          icon: 'fas fa-user-friends',
          active: false
        },
        {
          label:'Stocks & Shares',
          icon: 'fas fa-chart-area',
          active: false
        },
        {
          label:'Bank and savings',
          icon: 'fas fa-dollar-sign',
          active: false
        },
        {
          label:'Personal belongings',
          icon: 'fas fa-tv',
          active: false
        },
        {
          label:'Assets',
          icon: 'fas fa-home',
          active: false
        },
        {
          label:'Liabilities',
          icon: 'fas fa-car',
          active: false
        },
        {
          label:'Other information',
          icon: 'fas fa-info-circle',
          active: false
        },
      ],
      sectionsOpen: true,
      sectionsOpenHeight: '620',
      navCollapsed: false
    }
  },
  mounted() {
  },
  methods: {
    sectionClick(index) {
      this.sections.find(x=>x.active == true).active = false;
      this.sections[index].active = true;
    }
  }
}
</script>
<style lang="scss" scoped>
@import '~@/_variables.scss';

.client-form-navigation {
  position: fixed;
  background-color: $white;
  padding: 20px;
  width: 210px;
  transition: .25s;
  overflow: hidden;
  white-space: nowrap;
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
    transition: .25s ease-in-out;
    &:hover {
      color: $primary;
    }
  }
  &.active {
    a {
      color: $primary;
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
</style>