<template>
    <transition name="fade" @after-enter="viewContent = true">
        <div class="modal flex items-center justify-center" @click="closeModal">
            <span class="close__icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white fill-current" viewBox="0 0 24 24">
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                    <path d="M0 0h24v24H0z" fill="none"/>
                </svg>
            </span>
            <transition name="scale">
                <div :style="{ width: contentWidth }" @click.stop v-show="viewContent">
                    <slot></slot>
                </div>
            </transition>
        </div>
    </transition>
</template>

<script>
export default {
    props: {
        contentWidth: {
            required: false,
            type: String,
            default: '90vh'
        }
    },
    data() {
        return {
            viewContent: false
        }
    },
    mounted() {
        document.body.classList.add('overflow-hidden'); // prevent scrolling in the background
    },
    methods: {
        openModal() {
            this.viewModal = true;
        },
        closeModal() {
            this.viewContent = false;
            this.$emit('closeModal');
        },
    },
    beforeDestroy() {
        document.body.classList.remove('overflow-hidden');
    }
}
</script>

<style scoped>
    .modal {
        position: fixed;
        z-index: 10;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, .85);
        transition: all .4s ease-in-out;
    }
    .close__icon {
        position: absolute;
        top: 1rem;
        right: 1.5rem;
        opacity: .8;
        cursor: pointer;
    }
    .fade-enter-active, .fade-leave-active {
        transition: opacity .2s;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
    .scale-enter-active {
        animation: scaleIn .2s ease-in-out forwards;
    }
    .scale-leave-active {
        animation: scaleOut .2s ease-in-out forwards;
    }
    @keyframes scaleIn {
        0% {opacity: 0; transform: scale(.75);}
        100% {opacity: 1;transform: scale(1);}
    }
    @keyframes scaleOut {
        0% {opacity: 1;transform: scale(1);}
        100% {opacity: 0; transform: scale(.75);}
    }
</style>
