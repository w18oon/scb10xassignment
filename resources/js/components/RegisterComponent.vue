<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">สร้างบัญชีผู้ใช้</div>

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

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">ยืนยันรหัสผ่าน</label>
                                <div class="col-md-6">
                                    <input v-model="confirmPassword" id="confirm-password" type="password" class="form-control" name="confirm-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input v-model="termsAccepted" class="form-check-input" type="checkbox" name="terms-accepted" id="terms-accepted">
                                        <label class="form-check-label" for="terms-accepted">ฉันยอมรับเงื่อนไขและข้อตกลงเกี่ยวกับการใช้งาน</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">ยืนยัน</button>
                                    <router-link class="btn btn-link" to="/login">ยกเลิก</router-link>
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
                confirmPassword: '',
                termsAccepted: '',
                errors: [],
                reg: /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
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
                } else if (!this.reg.test(this.email)) {
                    this.errors.push('อีเมลไม่ถูกต้อง')
                }

                if (!this.password) {
                    this.errors.push('รบกวนระบุรหัสผ่าน')
                }

                if (!this.confirmPassword) {
                    this.errors.push('รบกวนระบุยืนยันรหัสผ่าน')
                }

                if (this.password !== this.confirmPassword) {
                    this.errors.push('ยืนยันรหัสผ่านไม่ตรงกับรหัสผ่าน')
                }

                if (!this.termsAccepted) {
                    this.errors.push('รบกวนยอมรับเงื่อนไขและข้อตกลงเกี่ยวกับการใช้งาน')
                }

                if (!this.errors.length) {
                    console.log(this.errors.length)
                    axios.post('/api/register', {
                        email: this.email,
                        password: this.password,
                    }).then(response => {
                        alert(response.data.message)
                        localStorage.setItem('user_id', response.data.user_id)
                        localStorage.setItem('token', response.data.token)
                        this.$router.push('/party')
                        console.log(response.data)
                    }).catch(error => {
                        console.log(error)
                    })
                }
            }
        },
    }
</script>
