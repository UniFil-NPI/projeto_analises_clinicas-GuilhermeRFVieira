<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

export default {
    components: {
        Head,
        AuthenticatedLayout,
        Link,
    },
    props: {
        user: Object,
        error: {
            type: String,
            default: null,
        },
    },
    data() {
        return {
            form: useForm({
                name: this.user.name,
                email: this.user.email,
                cpf: this.user.cpf,
                role: this.user.roles[0].name,
                status: this.user.status,
            }),
            showError: true,
        };
    },
    watch: {
        error(newValue) {
            if (newValue == null) {
                this.showError = false;

                setTimeout(() => {
                    this.showError = true;
                }, 2000);
            }
        },
    },
    methods: {
        save() {
            this.form.post("/user/update/" + this.user.id, this.form);
        },

        changeStatus() {
            this.form.status = !this.form.status;
        },
    },
};
</script>
<template>
    <Head title="Usuários" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Funcionários
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white flex flex-col gap-5 shadow-sm shadow-primary sm:rounded-lg p-5"
                >
                    <h2 class="text-2xl font-bold">
                        Editar cadastro do funcionário
                    </h2>
                    <form @submit.prevent="save">
                        <div class="grid grid-cols-4 gap-4">
                            <div class="col-span-2 flex flex-col gap-2">
                                <label for="name">Nome Completo</label>
                                <input
                                    type="text"
                                    v-model="form.name"
                                    placeholder="Seu Nome"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />
                                <span
                                    v-if="form.errors.name"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.name }}</span
                                >
                            </div>

                            <div class="col-span-2 flex flex-col gap-2">
                                <label for="email">Email</label>
                                <input
                                    type="email"
                                    v-model="form.email"
                                    placeholder="Email"
                                    class="col-span-1 bg-neutral-200 border-none rounded-lg"
                                />
                                <span
                                    v-if="form.errors.email"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.email }}</span
                                >
                            </div>

                            <div class="col-span-2 flex flex-col gap-2">
                                <label for="cpf">CPF</label>
                                <input
                                    type="text"
                                    v-model="form.cpf"
                                    placeholder="CPF"
                                    class="col-span-1 bg-neutral-200 border-none rounded-lg"
                                    v-mask-cpf
                                />
                                <span
                                    v-if="form.errors.cpf"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.cpf }}</span
                                >
                            </div>
                            <div class="col-span-1 flex flex-col gap-2">
                                <label for="name">Cargo</label>
                                <select
                                    v-model="form.role"
                                    class="col-span-1 bg-neutral-200 border-none rounded-lg"
                                >
                                    <option selected disabled value="0">
                                        Selecione
                                    </option>
                                    <option value="admin">admin</option>
                                    <option value="recepcionist">
                                        recepcionista
                                    </option>
                                    <option value="technician">técnico</option>
                                </select>
                                <span
                                    v-if="form.errors.role"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.role }}</span
                                >
                            </div>
                            <div class="col-span-1 flex flex-col gap-2">
                                <Label>Status</Label>
                                <label
                                    class="inline-flex items-center cursor-pointer"
                                >
                                    <input
                                        v-if="user.status === true"
                                        type="checkbox"
                                        value=""
                                        class="sr-only peer"
                                        @click="changeStatus()"
                                        checked
                                    />
                                    <input
                                        v-if="user.status === false"
                                        type="checkbox"
                                        value=""
                                        class="sr-only peer"
                                        @click="changeStatus()"
                                    />
                                    <div
                                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"
                                    ></div>
                                    <span
                                        v-if="user.status === true"
                                        class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300"
                                        >Ativo</span
                                    >
                                    <span
                                        v-if="user.status === false"
                                        class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300"
                                        >Inativo</span
                                    >
                                </label>
                            </div>
                            <button
                                type="submit"
                                class="px-4 py-2 rounded-lg bg-primary text-white col-span-4 text-xl uppercase text-center font-semibold"
                            >
                                Salvar alterações
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

    <div
        v-if="error && showError"
        class="w-full py-4 px-6 bg-red-500 text-white text-lg fixed bottom-0 left-0"
    >
        {{ error }}
    </div>
</template>
