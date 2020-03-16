<template>
  <div class="client-form">
    <client-form-navigation></client-form-navigation>
    <client-form-widgets></client-form-widgets>
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
  }
}
</script>
<style lang="scss" scoped>
.client-form {
  position: relative;
  padding-top: 60px;
}
</style>