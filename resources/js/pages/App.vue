<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-3">
            <div class="container">
                <a class="navbar-brand" href="#">Solicitudes</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul v-if="user && user.id" class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <router-link class="nav-link" to="/solicitudes">Solicitudes</router-link>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" @click.prevent="auth.logout">Salir</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>

<script setup>
    import {useAuthStore} from './../stores/auth.js'
    import {storeToRefs} from 'pinia'
    import { onMounted } from 'vue';
    const auth = useAuthStore()
    const {user} = storeToRefs(auth)

    onMounted(()=>auth.fetchUser())
</script>
