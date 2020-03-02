<template>
  <nav aria-label="form navigation" class="client-form-navigation shadow">
    <ul class="fa-ul">
      <li class="py-1 section-link" v-for="(section,index) in sections" :key="index">
        <a href="">
          <span class="fa-li">
            <i :class="section.icon" class="mr-2 icon"></i>
          </span>
          {{section.label}}
        </a>
      </li>
    </ul>
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
          icon: 'fas fa-user'
        },
        {
          label:'Powers of Attorney',
          icon: 'fas fa-pen-nib'
        },
        {
          label:'Will & Marital Status',
          icon: 'fas fa-ring'
        },
        {
          label:'Lifetime gifts',
          icon: 'fas fa-gift'
        },
        {
          label:'Gifts',
          icon: 'fas fa-gifts'
        },
        {
          label:'UK & British Isles',
          icon: 'fas fa-flag'
        },
        {
          label:'Tax Havens',
          icon: 'fas fa-globe-europe'
        },
        {
          label:'Nil-Rate band',
          icon: 'fas fa-pound-sign'
        },
        {
          label:'Business interests',
          icon: 'fas fa-briefcase'
        },
        {
          label:'Received inheritance',
          icon: 'fas fa-credit-card'
        },
        {
          label:'Trusts',
          icon: 'fas fa-handshake'
        },
        {
          label:'Pensions',
          icon: 'fas fa-piggy-bank'
        },
        {
          label:'Life Assurance',
          icon: 'fas fa-life-ring'
        },
        {
          label:'Joint held assets',
          icon: 'fas fa-user-friends'
        },
        {
          label:'Stocks & Shares',
          icon: 'fas fa-chart-area'
        },
        {
          label:'Bank and savings',
          icon: 'fas fa-dollar-sign'
        },
        {
          label:'Personal belongings',
          icon: 'fas fa-tv'
        },
        {
          label:'Assets',
          icon: 'fas fa-home'
        },
        {
          label:'Liabilities',
          icon: 'fas fa-car'
        },
        {
          label:'Other information',
          icon: 'fas fa-info-circle'
        },
      ]
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

}
</style>