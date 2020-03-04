<template>
    <router-view></router-view>
</template>

<script>
import M from "materialize-css";

export default {
    mounted() {
        M.AutoInit();
        const elems = document.querySelectorAll('.tooltipped');
        M.Tooltip.init(elems, {});
    }
};
</script>

<style>
    .actions {
        white-space: nowrap;
    }

    .cursors {
        cursor: pointer;
    }
</style>