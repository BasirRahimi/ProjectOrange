<template>
    <label class="file btn btn-outline-secondary active-primary">
        <input type="file">
        Upload Copy +
    </label>
</template>

<script>
export default {
    name: 'BaseFileUpload'
}
</script>

<style lang="scss" scoped>
@import '~@/_variables.scss'; 

.file {
    position: relative;
    
    input {
        position: absolute;
        left: -99999px;
        width: 1;
        height: 1;
        margin: 0;
        filter: alpha(opacity=0);
        opacity: 0;
    }
}
</style>