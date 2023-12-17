<template>
    <v-container class="d-flex justify-start mt-5" style="height: 100vh">
        <side-panel-component></side-panel-component>
        <popup-component
            :dialog="dialog"
            @closeDialog="dialog.show = false"
        ></popup-component>

        <div>
            <h2 class="text-h2 mb-5">Платежи</h2>

            <v-data-table
                v-if="payments"
                :headers="headers"
                :items="payments"
                :items-per-page="perPage"
            >

                <template v-slot:item.status="item">
                    <select v-if="item.value === 0" class="pointer" @change="updatePayment(item.item)">
                        <option value=0 :selected="!! !item.value">Не оплачен</option>
                        <option value=1 :selected="!!item.value">Оплачен</option>
                    </select>
                    <span v-else>Оплачен</span>
                </template>

            </v-data-table>

        </div>
    </v-container>
</template>

<script>
import SidePanelComponent from "./SidePanelComponent"
import PopupComponent from "../ui/PopupComponent"

export default {
    components: {SidePanelComponent, PopupComponent},
    data() {
        return {
            headers: [
                {text: 'id', value: 'id'},
                {text: 'Внешний id платежа', value: 'outer_payment_id'},
                {text: 'Тип платежа', value: 'type'},
                {text: 'Логин', value: 'user_login'},
                {text: 'Реĸвизиты', value: 'requisites'},
                {text: 'Сумма', value: 'sum'},
                {text: 'Валюта', value: 'currency'},
                {text: 'Статус заявĸи', value: 'status'},

            ],
            perPage: 10,
            dialog: {
                show: false,
                title: '',
                text: ''
            }
        }
    },
    props: ['payments'],
    mounted() {
        this.formatPayments()
    },
    methods: {
        formatPayments() {
            if (this.payments) {
                for (let payment of this.payments) {
                    payment.type = payment.type === 'deposit' ? 'Пополнение' : 'Снятие'
                }
            }
        },

        updatePayment(item) {
            if (!item.id) {
                return
            }

            const select = event.target
            const newValue = Number (select.value)

            if (newValue !== 1) {
                this.dialog = {
                    show: true,
                    title: 'Ошибка',
                    text: 'Нельзя изменить статус оплаченного заказа'
                }
                return
            }

            const data = {
                id: item.id,
                field: 'status',
                value: newValue,
            }

            axios.put('/admin/payment', data)
                .then(response => {
                    this.dialog = {
                        show: true,
                        title: 'Успешно',
                        text: response.data.text,
                    }
                })
                .catch(error => {
                    const response = error.response

                    this.dialog = {
                        show: true,
                        title: 'Ошибка',
                        text: response.data.text,
                    }
                })

        }
    },

}
</script>

<style scoped>
    .pointer {
        cursor: pointer
    }

    .pointer:focus {
        outline: 0 !important;
    }
</style>