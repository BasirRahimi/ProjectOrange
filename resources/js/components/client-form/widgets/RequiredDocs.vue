<template>
    <div class="required-docs shadow rounded">
        <div class="widget-title">SECTION ONE - REQUIRED DOCUMENTS</div>
        <p class="note">Below is a list of all required documents in this section, click on them to find them faster</p>
        <div class="doc-list">
            <a class="doc">
                <span class="status">1</span>
                <a href="#" class="doc-name">Document that has nothing uploaded</a>
            </a>
            <a class="doc done">
                <span class="status"><i class="fas fa-check"></i></span>
                <a href="#" class="doc-name">Document has been selected</a>
            </a>
            <a class="doc active">
                <span class="status">3</span>
                <a href="#" class="doc-name">Document has been clicked on and shown left</a>
            </a>
        </div>
    </div>
</template>

<script>
export default {
    name: 'RequiredDocs'
}
</script>

<style lang="scss" scoped>
@import '~@/_variables.scss';

.required-docs {
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
        &:not(:last-child) {
            .status::after {
                content: ' ';
                width: 1px;
                height: 100%;
                background-color: $body-color;
                position: absolute;
                top: 100%;
                left: 50%;
                transform: translateX(-50%);
            }
        }
        &.done {
            .doc-name {
                color: #A7AAA7;
            }
        }
        &.active {
            color: $primary;
            .status {
                background-color: $primary;
                border-color: $primary;
                color: $white;
            }
            .doc-name {
                color: $primary;
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