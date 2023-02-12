<template>
    <div class="header bg-white shadow">
        <div class="brand">Project Orange</div>
        <div class="title">JOHN DOE DECEASED</div>
        <div class="toolbar">
            <a href="" class="mr-2">
                <i class="fas fa-comment-dots"></i>
            </a>
            <a href="" class="mr-2">
                <i class="fas fa-bell"></i>
            </a>
            <a href="" class="mr-2">
                <i class="fas fa-cog"></i>
            </a>
        </div>
    </div>
</template>

<script>
export default {
    name: 'AppHeader'
}
</script>
<style lang="scss" scoped>
.header {
    position: fixed;
    width: 100%;
    height: 60px;
    z-index: 2;
    display: flex;
    align-items: center;

    .brand {
        display: inline-block;
        font-size: 18px;
        font-weight: 600;
        width: 210px;
        height: 100%;
        padding: 20px 0;
        text-align: center;
        box-sizing: border-box;
        border-right: 1px solid #F0F0F0;
    }

    .title {
        display: inline-block;
        font-size: 18px;
        font-weight: 600;
        padding-left: 64px;
        flex-grow: 1;
    }

    .toolbar {
        display: inline-block;
        margin-left: auto;
        padding-right: 64px;

        a {
            color: #4c4c4c;
            transition: .25s;

            &:hover {
                color: #FB952C;
            }
        }
    }
}
</style>