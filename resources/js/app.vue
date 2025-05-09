<template>
    <div>
        <navbar-component v-if="!$route.meta.hideNavbar" />
        <router-view />
    </div>
</template>

<script>
export default {
    name: "App",
};
</script>
