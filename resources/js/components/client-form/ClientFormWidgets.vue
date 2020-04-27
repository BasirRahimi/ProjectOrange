<template>
  <div class="widgets-container">
    <required-docs class="mb-4"></required-docs>
    <tools></tools>
  </div>
</template>

<script>
import RequiredDocs from './widgets/RequiredDocs';
import Tools from './widgets/Tools'
export default {
    name: 'ClientFormWidgets',
    components: {
      RequiredDocs,
      Tools
    }
}
</script>

<style lang="scss" scoped>
@import '~@/_mixins.scss'; 

.widgets-container {
  position: fixed;
  top: 60px;
  right: 64px;
  padding-top: 64px;
  padding-bottom: 50px;
  width: 380px;
  height: calc(100% - 60px);
  overflow-y: scroll;
  z-index: 1;
  &::-webkit-scrollbar {
    width: 0;
  }

  display: none;
  @include for-desktop-up {
    display: block;
  }
}
</style>