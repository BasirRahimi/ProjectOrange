<template>
    <div class="required-docs shadow rounded" :class="{ 'inSideNav': inSideNav }">
        <div class="widget-title">SECTION ONE - REQUIRED DOCUMENTS</div>
        <p class="note">Below is a list of all required documents in this section, click on them to find them faster</p>
        <div class="doc-list">
            <a href="#" @click.prevent class="doc">
                <span class="status">1</span>
                <div href="#" class="doc-name">Document that has nothing uploaded</div>
            </a>
            <a href="#" @click.prevent class="doc done">
                <span class="status"><i class="fas fa-check"></i></span>
                <div href="#" class="doc-name">Document has been selected</div>
            </a>
            <a href="#" @click.prevent class="doc active">
                <span class="status">3</span>
                <div href="#" class="doc-name">Document has been clicked on and shown left</div>
            </a>
        </div>
    </div>
</template>

<script>
export default {
    name: 'RequiredDocs',
    props: ['inSideNav']
}
</script>

<style lang="scss" scoped>
@import '@sass/vue_sfc.scss';

.required-docs {
    padding: 24px;
    background-color: $white;
}

.widget-title {
    font-weight: 600;
    margin-bottom: 16px;
}

.note {
    color: $gray-500;
}

.doc-list {
    .doc {
        padding: 8px 0;
        display: flex;
        align-items: center;
        text-decoration: none;

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
            color: $body-color;

            .fas {
                font-size: 10px;
            }

        }

        &:not(:last-child) {
            .status::after {
                content: ' ';
                pointer-events: none;
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
            width: 100%;
            text-overflow: ellipsis;
            overflow: hidden;
        }
    }
}

.inSideNav {
    padding: 0;

    .widget-title {
        display: none;
    }

    .note {
        display: none;
    }

    .doc-list {
        margin-left: 2.5em;

        .doc {
            display: block;
            position: relative;

            .status {
                position: absolute;
                width: 16px;
                height: 16px;
                font-size: 12px;
                padding: 1px 0px;
                left: -2.1em;
                line-height: 12px;
            }

            .doc-name {
                display: inline-block;
                vertical-align: middle;
            }

            &:not(:last-child) {
                .status::after {
                    height: 30px;
                }
            }
        }
    }
}
</style>