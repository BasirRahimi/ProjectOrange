<template>
  <div class="client-form" :class="{'nav-collaped':navCollapsed}">
    <client-form-navigation @navToggled="navToggled"></client-form-navigation>
    <!-- <client-form-widgets></client-form-widgets> -->
    <div class="router-view">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import ClientFormNavigation from './client-form/ClientFormNavigation';
import ClientFormWidgets from './client-form/ClientFormWidgets';
export default {
  name: 'ClientForm',
  components: {
    ClientFormNavigation,
    ClientFormWidgets
  },
  data() {
    return {
      navCollapsed: false
    }
  },
  methods: {
    navToggled(val) {
      this.navCollapsed = val;
    }
  }
}
</script>
<style lang="scss" scoped>
@import '~@/_mixins.scss';

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
</style>