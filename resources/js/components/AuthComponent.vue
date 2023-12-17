<template>
    <v-container class="d-flex align-center justify-center" style="height: 100vh">
        <v-sheet width="400" class="mx-auto">

            <v-alert v-if="error" type="error">{{ error }}</v-alert>

            <v-form fast-fail @submit.prevent="auth">
                <v-text-field v-model="email"
                      label="Электронная почта"
                      type="email"
                      error-count=3
                      :error-messages="validation.email"
                      :error="!!validation.email.length"
                      required
                ></v-text-field>

                <v-text-field v-model="password"
                      label="Пароль"
                      type="password"
                      error-count=3
                      :error-messages="validation.password"
                      :error="!!validation.password.length"
                      required
                ></v-text-field>

                <v-btn type="submit" color="primary" block class="mt-2">Войти</v-btn>
            </v-form>
        </v-sheet>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            email: '',
            password: '',
            validation: {
                email: [],
                password: []
            },
            error: ''
        }
    },
    methods: {

        test() {
            console.log(this.errors)
        },

        auth() {
            this.error = '';
            this.validation = {
                email: [],
                password: [],
            }

            const data = {
                email: this.email,
                password: this.password
            }

            axios.post('/auth', data)
                .then(response => {
                    if (response.status === 200) {
                        window.location.href = response.data.url
                    } else {
                        this.error = response.data?.message
                    }
                })
                .catch(error => {
                    const response = error.response

                    if (response?.status === 422) {
                        for (let field in response.data.errors) {
                            this.validation[field] = []
                            this.validation[field].push(response.data.errors[field][0])
                        }
                    } else {
                        this.error = response.data?.message
                    }
                })
        },
    },
}

</script>

<style scoped>

</style>