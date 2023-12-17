<template>
    <v-container class="d-flex" style="height: 100vh">
        <v-navigation-drawer :width="250">
            <v-list-item-title>Административный раздел</v-list-item-title>
            <v-list-item-subtitle>Категории</v-list-item-subtitle>
            <v-divider class="mb-2"></v-divider>
            <v-list-item link title="Платежи" class="v-list-item--active" @click="reloadPage()">Платежи</v-list-item>
        </v-navigation-drawer>

    </v-container>
</template>

<script>
export default {
    data() {
        return {
        }
    },
    methods: {
        reloadPage() {
            location.reload()
        },
    }
}
</script>

<style scoped>

</style>