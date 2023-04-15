<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        Ingrese con sus datos
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="auth.login(email, password)">
                            <div class="mb-3">
                                <label for="email" class="form-label">Dirección de correo electrónico</label>
                                <input type="email" class="form-control" id="email" v-model="email" :class="{'is-invalid': auth.errors.email}">
                                <div v-if="auth.errors.email" class="invalid-feedback">
                                    {{ auth.errors.email[0] }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" v-model="password">
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit">
                                    Enviar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import {useAuthStore} from './../stores/auth.js'

const auth     = useAuthStore()
const email    = ref('')
const password = ref('')

onMounted(()=>{
    axios.get('sanctum-csrf-cookie')
    .then(response=>console.log(response))
})
</script>
