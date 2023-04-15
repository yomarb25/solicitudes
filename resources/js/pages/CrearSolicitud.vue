<template>
    <div class="card">
        <div class="card-header">
            Registrar solicitud
        </div>
        <div class="card-body">
            <form @submit.prevent="storeSolicitude" method="POST">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 mb-3">
                            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                            <input type="date" class="form-control" :class="{'is-invalid': errors.name}" id="fecha_nacimiento" v-model="solicitude.fecha_nacimiento"  required/>
                            <div v-if="errors.fecha_nacimiento" class="invalid-feedback">{{ errors.fecha_nacimiento[0] }}</div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="sexo" class="form-label">Sexo</label>
                            <select id="sexo" class="form-select" v-model="solicitude.sexo" required>
                                <option value="" selected>Seleccione una opción</option>
                                <option value="M">M</option>
                                <option value="F">F</option>
                            </select>
                            <div v-if="errors.sexo" class="invalid-feedback">{{ errors.sexo[0] }}</div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="estado_civil" class="form-label">Estado civil</label>
                            <select id="estado_civil" class="form-select" v-model="solicitude.estado_civil" required>
                                <option value="" selected>Seleccione una opción</option>
                                <option value="soltero">Soltero</option>
                                <option value="casado">Casado</option>
                                <option value="divorciado">Divorciado</option>
                                <option value="viudo">Viudo</option>
                            </select>
                            <div v-if="errors.estado_civil" class="invalid-feedback">{{ errors.estado_civil[0] }}</div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="primer_nombre" class="form-label">Primer nombre</label>
                            <input type="text" class="form-control" :class="{'is-invalid': errors.primer_nombre}" id="primer_nombre" v-model="solicitude.primer_nombre" required>
                            <div v-if="errors.primer_nombre" class="invalid-feedback">{{ errors.primer_nombre[0] }}</div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="segundo_nombre" class="form-label">Segundo nombre</label>
                            <input type="text" class="form-control" :class="{'is-invalid': errors.segundo_nombre}" id="segundo_nombre" v-model="solicitude.segundo_nombre">
                            <div v-if="errors.segundo_nombre" class="invalid-feedback">{{ errors.segundo_nombre[0] }}</div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="primer_apellido" class="form-label">Primer apellido</label>
                            <input type="text" class="form-control" :class="{'is-invalid': errors.primer_apellido}" id="primer_apellido"
                                v-model="solicitude.primer_apellido" required>
                                <div v-if="errors.primer_apellido" class="invalid-feedback">{{ errors.primer_apellido[0] }}</div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="segundo_apellido" class="form-label">Segundo apellido</label>
                            <input type="text" class="form-control" :class="{'is-invalid': errors.segundo_apellido}" id="segundo_apellido"
                                v-model="solicitude.segundo_apellido">
                                <div v-if="errors.segundo_apellido" class="invalid-feedback">{{ errors.segundo_apellido[0] }}</div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="telefono" class="form-label">Número telefónico trabajador</label>
                            <input type="tel" class="form-control" :class="{'is-invalid': errors.telefono}" id="telefono" v-model="solicitude.telefono" required>
                            <div v-if="errors.telefono" class="invalid-feedback">{{ errors.telefono[0] }}</div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="email" class="form-label">Correo electrónico trabajador</label>
                            <input type="email" class="form-control" :class="{'is-invalid': errors.email}" id="email" v-model="solicitude.email" required>
                            <div v-if="errors.email" class="invalid-feedback">{{ errors.email[0] }}</div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="email_confirmation" class="form-label">Confirmar correo trabajador</label>
                            <input type="email" class="form-control" :class="{'is-invalid': errors.email_confirmation}" id="email_confirmation"
                                v-model="solicitude.email_confirmation" required>
                                <div v-if="errors.email_confirmation" class="invalid-feedback">{{ errors.email_confirmation[0] }}</div>
                        </div>
                        <div class="d-none d-lg-block col-lg-8"></div>
                        <div class="col-lg-4 mb-3">
                            <label for="tipo_documento" class="form-label">Tipo documento</label>
                            <select id="tipo_documento" class="form-select" v-model="solicitude.tipo_documento" required>
                                <option value="" selected>Seleccione una opción</option>
                                <option value="nacional">Nacional</option>
                                <option value="extranjero">Extranjero</option>
                            </select>
                            <div v-if="errors.tipo_documento" class="invalid-feedback">{{ errors.tipo_documento[0] }}</div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="cui" class="form-label">CUI</label>
                            <input type="text" v-model="solicitude.cui" required class="form-control" :class="{'is-invalid': errors.cui}">
                            <div v-if="errors.cui" class="invalid-feedback">{{ errors.cui[0] }}</div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="cui" class="form-label">DPI</label>
                            <input type="file" ref="attachmentInput" class="form-control" :class="{'is-invalid': errors.attachment}">
                            <div class="invalid-feedback" v-if="errors.attachment">{{ errors.attachment[0] }}</div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" :class="{'is-invalid': errors.name}" id="direccion" v-model="solicitude.direccion" required>
                            <div class="invalid-feedback" v-if="errors.direccion">{{ errors.direccion[0] }}</div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="departamento" class="form-label">Departamento</label>
                            <select id="departamento" class="form-select" required>
                                <option value="" selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="municipio" class="form-label">Municipio</label>
                            <select id="municipio" class="form-select" required>
                                <option value="" selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 d-flex ms-auto">
                            <button class="btn btn-primary ms-auto" type="submit">
                                Enviar
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { toast } from 'vue3-toastify';
import { useRouter } from 'vue-router';

const router = useRouter()
const attachmentInput = ref(null)
const solicitude = ref(
    {
        primer_nombre: '',
        segundo_nombre: '',
        primer_apellido: '',
        segundo_apellido: '',
        apellido_casada: '',
        tipo_documento: '',
        pasaporte: '',
        cui: '',
        fecha_nacimiento: '',
        telefono: '',
        email: '',
        sexo: '',
        estado_civil: '',
        direccion: '',
    }
)

const errors = ref({})

function storeSolicitude() {
    const data = new FormData()
    const values = { ...solicitude.value }
    Object.keys(solicitude.value)
    .forEach(key => {
        data.append(key, values[key])
    })

    if (attachmentInput.value.files.length) {
        data.append('attachment', attachmentInput.value.files[0])
    }

    axios.post('solicitudes', data)
        .then(response => {
            router.push('/solicitudes')
            toast.success('Solicitud creada con éxito');
        })
        .catch(error => {
            if( error.response && error.response.data.errors ){
                errors.value = error.response.data.errors
            }
        })
}
</script>
