<template>
    <div class="row">  
        <form class="col-12" action="/management/housetypes/store'" method="POST" autocomplete="off" @submit.prevent="addHousetype()">
        
            <div class="form-group col-md-7">
                <label for="location_id">Location</label>
                <select name="location_id" id="location_id" v-model="housetype.location_id" v-on:change="changeLocation($event)">
                    <option value="">Select Location...</option>
                    <option v-for="location in locations" :key="location.id" :value="location.id">{{ location.name }}</option>
                </select>
                <div class="invalid-feedback" v-if="errors.location_id">{{ errors.location_id[0] }}</div>
            </div>

            <div class="form-group col-md-7">
                <label for="area_id">Area</label>
                <select name="area_id" id="area_id" v-model="housetype.area_id" :disabled="area_disable == false">
                    <option value="">Select Location...</option>
                    <option v-for="area in areas" :key="area.id" :value="area.id">{{ area.name }}</option>
                </select>
                <div class="invalid-feedback" v-if="errors.area_id">{{ errors.area_id[0] }}</div>
            </div>

            <div class="form-group col-md-7">
                <label for="name">Housetype</label>
                <input type="text" name="name" id="name" v-model="housetype.name">
                <div class="invalid-feedback" v-if="errors.name">{{ errors.name[0] }}</div>
            </div>

            <div class="form-group col-md-7">
                <label for="desc">Description <span class="indicator">(optional)</span></label>
                <textarea name="desc" id="desc" rows="3" v-model="housetype.desc"></textarea>
            </div>

            <div class="col-12">
                <button class="btn green-btn" type="submit">
                    <i data-feather="save"></i> Save Area
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: [
            'action', 'editid'
        ],
        data() {
            return {
                housetype: {
                    location_id: '',
                    area_id: '',
                    name: '',
                    desc: '',
                },
                locations: [],
                areas: [],
                errors: [],
                area_disable: true,
            }
        },
        mounted() {
            axios.get("/management/get-all-locations")
                .then(response => {
                    this.locations = response.data;
                }
            );
            if (this.action == 'edit') {
                
            }
        },
        methods: {
            changeLocation: function(event) {
                this.areas = [];
                this.area_disable = false;
                axios.get("/management/areas-of-a-location/" + event.target.value)
                    .then(response => {
                        this.areas = response.data;
                        this.area_disable = true;
                    }
                );
            },
            addHousetype() {
                this.errors = [];
                axios.post('/management/housetypes', this.housetype)
                .then( response => {
                    showAlert(response.data.success);
                    this.housetype.location_id = '';
                    this.housetype.area_id = '';
                    this.housetype.name = '';
                    this.housetype.desc = '';
                })
                .catch( error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    } else {
                        showAlert(error, 'danger');
                    }
                });
            },
        }
    }
</script>
