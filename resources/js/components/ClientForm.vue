<template>
  <div class="client-form" :class="{'nav-collaped':navCollapsed}">
    <client-form-navigation @navToggled="navToggled"></client-form-navigation>
    <client-form-widgets></client-form-widgets>
    <div class="form-content">
      <div class="section shadow rounded mb-3">
      </div>
      <div class="section shadow rounded mb-3">
      </div>
      <div class="section shadow rounded mb-3">
      </div>
      <div class="section shadow rounded mb-3">
      </div>
      <div class="section shadow rounded mb-3">
      </div>
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
@import '~@/_variables.scss';
@import '~@/_mixins.scss';

.client-form {
  position: relative;
  padding-top: 60px;
  padding-left: 210px;
  padding-right: 0px;
  transition: .25s;
  &.nav-collaped {
    padding-left: 35px;
  }
  @include for-desktop-up {
    padding-right: 444px;
  }
}
.form-content {
  width: 100%;
  padding-top: 64px;
  padding-left: 24px;
  padding-right: 24px;
}
.section {
  max-width: 900px;
  margin: auto;
  background-color: $white;
  height: 300px;
}
</style>