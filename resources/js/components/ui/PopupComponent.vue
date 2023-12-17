<template>
    <v-dialog v-model="dialog.show" max-width="600">
        <v-card>
            <v-card-title>{{ dialog.title }}</v-card-title>

            <v-card-text>{{ dialog.text }}</v-card-text>

            <v-card-actions>
                <v-btn @click="closeDialog">Закрыть</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    data() {
        return {
        }
    },
    props: ['dialog'],
    methods: {
        closeDialog() {
            this.$emit('closeDialog');
        },
    },
}
</script>

<style scoped>

</style>