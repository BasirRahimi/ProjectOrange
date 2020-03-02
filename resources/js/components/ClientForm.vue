<template>
  <div class="client-form">
    <client-form-navigation></client-form-navigation>
  </div>
</template>

<script>
import ClientFormNavigation from './ClientFormNavigation';
export default {
  name: 'ClientForm',
  components: {
    ClientFormNavigation
  }
}
</script>
<style lang="scss" scoped>
.client-form {
  position: relative;
}
</style>