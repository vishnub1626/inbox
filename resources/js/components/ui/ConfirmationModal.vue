<template>
    <BaseModal :show="show" @close="close" width="w-full md:w-1/3 lg:w-1/4">
        <main class="flex p-4">
            <div class="mr-4">
                <svg
                    class="w-6 h-6 text-red-700"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                    ></path>
                </svg>
            </div>
            <div class="flex flex-col flex-1">
                <p>You sure you want to delete?</p>
                <div class="flex justify-end mt-5">
                    <button
                        class="px-2 py-1 mr-2 text-sm leading-relaxed text-gray-700 bg-gray-400 rounded-md"
                        type="button"
                        @click="$emit('cancel')"
                    >
                        No, cancel
                    </button>
                    <button
                        class="px-2 py-1 mr-2 text-sm leading-relaxed text-red-100 bg-red-700 rounded-md"
                        type="button"
                        @click.once="$emit('confirm')"
                    >
                        Yes, delete
                    </button>
                </div>
            </div>
        </main>
    </BaseModal>
</template>

<script>
export default {
    props: {
        show: [Boolean]
    },

    methods: {
        close() {
            this.$emit("close");
        }
    }
};
</script>
