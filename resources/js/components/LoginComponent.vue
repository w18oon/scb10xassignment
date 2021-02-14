<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">เข้าสู่ระบบ</div>

                    <div class="card-body">
                        <ul v-if="errors.length">
                            <li v-for="error in errors">{{ error }}</li>
                        </ul>
                        <form @submit.prevent="submitForm">

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">อีเมล</label>
                                <div class="col-md-6">
                                    <input v-model="email" id="email" type="email" class="form-control" name="email">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">รหัสผ่าน</label>
                                <div class="col-md-6">
                                    <input v-model="password" id="password" type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
                                    <router-link class="btn btn-link" to="/register">สร้างบัญชีผู้ใช้</router-link>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                email: '',
                password: '',
                errors: [],
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            submitForm() {
                this.errors = [];
                if (!this.email) {
                    this.errors.push('รบกวนระบุอีเมล')
                }

                if (!this.password) {
                    this.errors.push('รบกวนระบุรหัสผ่าน')
                }

                if (!this.errors.length) {
                    axios.post('/api/login', {
                        email: this.email,
                        password: this.password,
                    }).then(response => {
                        localStorage.setItem('user_id', response.data.user_id)
                        localStorage.setItem('token', response.data.token)
                        this.$router.push('/party')
                    }).catch(error => {
                        console.log(error)
                    })
                }
            }
        },
    }
</script>
