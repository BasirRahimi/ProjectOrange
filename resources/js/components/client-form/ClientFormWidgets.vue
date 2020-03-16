<template>
  <div class="widgets-container">
    <required-docs class="mb-4"></required-docs>
    <navigation></navigation>
  </div>
</template>

<script>
import RequiredDocs from './widgets/RequiredDocs';
import Navigation from './widgets/Navigation'
export default {
    name: 'ClientFormWidgets',
    components: {
      RequiredDocs,
      Navigation
    }
}
</script>

<style lang="scss" scoped>
@import '~@/_variables.scss';

.widgets-container {
    position: fixed;
    top: 124px;
    right: 64px;
    width: 380px;
}
</style>