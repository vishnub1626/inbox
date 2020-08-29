<template>
    <transition name="modal">
        <div
            class="fixed top-0 left-0 z-50 flex items-center justify-center w-full h-full p-2 shadow-lg mask"
            @click="close"
            v-show="show"
        >
            <div
                :class="width"
                class="mt-4 overflow-y-auto bg-white rounded-lg model-container"
                @click.stop
            >
                <slot></slot>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    props: {
        show: [Boolean],
        width: {
            default: "w-full md:w-1/2"
        }
    },

    mounted() {
        document.addEventListener("keydown", e => {
            if (this.show && e.keyCode == 27) {
                this.close();
            }
        });
    },

    methods: {
        close() {
            this.$emit("close");
        }
    }
};
</script>

<style scoped>
.mask {
    background-color: rgba(0, 0, 0, 0.5);
    transition: opacity 0.3s ease;
}

.model-container {
    max-height: 90%;
    transition: all 0.3s ease;
}

.modal-enter {
    opacity: 0;
}

.modal-leave-active {
    opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}
</style>
