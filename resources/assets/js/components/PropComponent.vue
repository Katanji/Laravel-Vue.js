<template>
    <div class="container">
        <p>experience is updated every 5 seconds</p>
        <p v-html="computedExperience"></p>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                experience: 0,
                user_id: parseInt(document.URL.replace(/\D+/g,""))
            }
        },
        mounted() {
            this.firstExperience();
            setInterval(this.repeatedExperience.bind(this), 5000);
        },
        computed: {
            computedExperience() {
                return this.experience;
            },
        },
        methods: {
            firstExperience: function () {
                axios.get(document.URL + '/api', {
                    params: {
                        user_id: this.user_id,
                        repeatRequest: false
                    }
                }).then((response) => {
                    this.experience = response.data.experience;
                });
            },
            repeatedExperience: function () {
                axios.get(document.URL + '/api', {
                    params: {
                        user_id: this.user_id,
                        repeatRequest: true
                    }
                }).then((response) => {
                    this.experience = response.data.experience;
                });
            }
        },
    }
</script>
