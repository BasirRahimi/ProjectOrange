<template>
    <div class="content-box shadow rounded mb-3">
        <p class="title h5 text-center"><b>{{title}}</b></p>
        <slot></slot>
    </div>
</template>

<script>
export default {
    name: 'ContentBox',
    props: ['title']
}
</script>

<style scoped>
.content-box {
  max-width: 900px;
  margin: auto;
  background-color: #fff;
  padding: 40px;
}
.title {
    margin-bottom: 40px;
}
</style>