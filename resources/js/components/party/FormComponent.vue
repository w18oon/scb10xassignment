<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">สร้างปาร์ตี้</div>

                    <div class="card-body">
                        <ul v-if="errors.length">
                            <li v-for="error in errors">{{ error }}</li>
                        </ul>
                        <form @submit.prevent="submitForm">

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">ชื่อปาร์ตี้</label>
                                <div class="col-md-6">
                                    <input v-model="name" id="name" type="text" class="form-control" name="name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="no_of_members" class="col-md-4 col-form-label text-md-right">จำนวนคนที่ขาด</label>
                                <div class="col-md-6">
                                    <input v-model="no_of_members" id="no_of_members" type="number" class="form-control" name="no_of_members" min="1">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">ยืนยัน</button>
                                    <router-link class="btn btn-link" to="/party">ยกเลิก</router-link>
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
                name: '',
                no_of_members: 1,
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
                    this.errors.push('รบกวนชื่อปาร์ตี้')
                }

                if (!this.errors.length) {
                    axios.post('/api/parties', {
                        name: this.name,
                        no_of_members: this.no_of_members,
                        user_id: localStorage.getItem('user_id'),
                    }).then(response => {
                        alert(response.data.message)
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
