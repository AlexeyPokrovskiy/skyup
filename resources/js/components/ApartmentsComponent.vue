<template>
    <div>
        <div class="row">
            <div class="apartments-filter_form col-12">
                <form class="d-flex justify-content-between">
                    <div class="filter">
                        <input type="text" class="form-control" v-model="name"  placeholder="Name">
                    </div>
                    <div class="filter">
                        <input type="text" class="form-control" v-model="bedrooms" placeholder="Bedrooms">
                    </div>
                    <div class="filter">
                        <input type="text" class="form-control" v-model="bathrooms" placeholder="Bathrooms">
                    </div>
                    <div class="filter">
                        <input type="text" class="form-control" v-model="storeys" placeholder="Storeys">
                    </div>
                    <div class="filter">
                        <input type="text" class="form-control" v-model="garages"  placeholder="Garages">
                    </div>
                    <div class="filter">
                        <input type="text" class="form-control" v-model="minPrice" placeholder="min-price">
                    </div>
                    <div class="filter">
                        <input type="text" class="form-control" v-model="maxPrice"  placeholder="max-price">
                    </div>



                    <div class="filter">
                        <button type="submit" @click.prevent="fetch" class="btn btn-success d-flex"><i v-if="busy" class="fa fa-spin fa-spinner"></i><span class="filter-fetch-button">Filter</span></button>
                    </div>
                    <div class="filter">
                        <button type="submit" @click.prevent="reset" class="btn btn-danger">Reset</button>
                    </div>
                </form>
            </div>
            <div class="apartments-filter_table col-12">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Bedrooms</th>
                        <th scope="col">Bathrooms</th>
                        <th scope="col">Storeys</th>
                        <th scope="col">Garages</th>
                        <th scope="col">Price</th>
                    </tr>
                    </thead>
                    <tbody v-if="apartments.length" >
                        <tr v-for="apartment in apartments">
                            <th scope="row">{{apartment.id}}</th>
                            <td>{{apartment.name}}</td>
                            <td>{{apartment.bedrooms}}</td>
                            <td>{{apartment.bathrooms}}</td>
                            <td>{{apartment.storeys}}</td>
                            <td>{{apartment.garages}}</td>
                            <td>{{apartment.price}}</td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr>
                            <td colspan="7" class="text-center">Не было найдено никаких результатов</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: null,
                bedrooms: null,
                bathrooms: null,
                storeys: null,
                garages: null,
                minPrice: null,
                maxPrice: null,
                price: null,
                apartments: [],
                busy: false,
            }
        },
        methods: {
            reset() {
                this.name = null;
                this.bedrooms = null,
                this.bathrooms = null,
                this.storeys = null,
                this.garages = null,
                this.minPrice = null,
                this.maxPrice = null,
                this.fetch();
            },
            fetch() {
                this.busy = true;
                axios.get('/api/apartments', {
                    params: {
                        name: this.name,
                        bedrooms: this.bedrooms,
                        bathrooms: this.bathrooms,
                        storeys: this.storeys,
                        garages: this.garages,
                        min_price: this.minPrice,
                        max_price: this.maxPrice,
                    }
                })
                    .then(response => {
                        this.apartments = response.data;
                        this.busy = false;
                    })
            }
        },
        mounted() {
            this.fetch();
        }
    }
</script>