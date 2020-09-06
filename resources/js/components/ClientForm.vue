<template>
  <div class="client-form" :class="{'nav-collaped':navCollapsed}">
    <client-form-navigation @navToggled="navToggled"></client-form-navigation>
    <client-form-widgets></client-form-widgets>
    <div class="router-view">
      <router-view></router-view>
    </div>

    <client-form-utility-bar></client-form-utility-bar>
  </div>
</template>

<script>
import ClientFormNavigation from './client-form/ClientFormNavigation';
import ClientFormWidgets from './client-form/ClientFormWidgets';
import ClientFormUtilityBar from './client-form/ClientFormUtilityBar';

export default {
  name: 'ClientForm',
  components: {
    ClientFormNavigation,
    ClientFormWidgets,
    ClientFormUtilityBar
  },
  props: {
    client: {}
  },
  data() {
    return {
      navCollapsed: false
    }
  },
  beforeMount() {
    this.$store.commit('updateClient', this.client)
  },
  methods: {
    navToggled(val) {
      this.navCollapsed = val;
    }
  }
}
</script>
<style lang="scss" scoped>
@import '~@/argon/vue_sfc.scss'; 

.client-form {
  position: relative;
  padding-top: 60px;
  transition: .25s;
}
.form-content {
  width: 100%;
  padding-top: 64px;
  padding-left: 24px;
  padding-right: 24px;
}
@include media-breakpoint-down(md) {
    .client-form {
        padding-bottom: 56px;
    }
}
</style>