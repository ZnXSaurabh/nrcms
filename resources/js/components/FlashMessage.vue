<template>
    <div v-show="show" :class="'alert alert-' + message.type + ' alert-dismissible fade show'" role="alert">
        {{ message.text }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</template>

<script>
    export default {
        props: [
            'type', 'text'
        ],
        data() {
            return {
                show: false,
                message: {
                    text: this.text,
                    type: this.type,
                },
                hideTimeout: false
            }
        },
        created () {
            if (this.message.text) {
                this.showAlert();
            }

            window.alertEvent.$on('showAlert', (message, type) => {
                this.message.text = message;
                this.message.type = type;
                this.showAlert();
            });
        },
        methods: {
            showAlert() {
                this.show = true;
                this.hideAlert();
            },
            hideAlert() {
                this.hideTimeout = setTimeout(() => {
                    this.show = false;
                }, 10000);
            },
        }
    }
</script>
