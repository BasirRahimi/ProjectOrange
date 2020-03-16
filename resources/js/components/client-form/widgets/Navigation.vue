<template>
    <div class="navigation shadow rounded">
        <div class="widget-title">NAVIGATION</div>
        <p class="note">Below are some useful tools for you to use to help you complete each section.</p>
        <div class="doc-list mb-3">
            <a class="doc">
                <span class="status"><i class="fas fa-chevron-up"></i></span>
                <a href="#" class="doc-name">Jump to top</a>
            </a>
            <a class="doc">
                <span class="status"><i class="fas fa-bookmark"></i></span>
                <a href="#" class="doc-name">Set reminder</a>
            </a>
        </div>
        <a href="#" class="btn btn-primary w-100">Next Section</a>
    </div>
</template>

<script>
export default {
    name: 'Navigation'
}
</script>

<style lang="scss" scoped>
@import '~@/_variables.scss';

.navigation {
    padding: 24px;
    background-color: $white;
}
.widget-title {
    font-weight: 600;
    margin-bottom: 16px;
}
.note {
    color: rgba($color: #979A97, $alpha: .5);
}
.doc-list {
    .doc {
        padding: 8px 0;
        display: flex;
        align-items: center;
        
        .status {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
            border-radius: 50%;
            border: 1px solid;
            text-align: center;
            width: 24px;
            height: 24px;
            background-color: $white;
            transition: .25s;
            .fas {
                font-size: 10px;
            }

        }
        
        &:hover {
            .doc-name {
                color: $primary;
                text-decoration: none;
            }
            .status {
                background-color: $primary;
                border-color: $primary;
                color: $white;
            }
        }
        .doc-name {
            transition: .25s;
            flex: 1 1 0%;
            color: $body-color;
        }
    }
}
</style>