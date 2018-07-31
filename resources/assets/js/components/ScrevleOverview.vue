<template>
    <div class="container">
        <div class="row">
            <h1>IPee cloud</h1>

            <div class="row">
                <h2>Devices</h2>
                <div class="col-md-4" v-for="device in devices" :key=device.id>
                    <ScrevleDevice 
                        :device="device"
                        :socket="socket"
                    />
                </div>
            </div>
            <!--<div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        I'm an example component!
                    </div>
                </div>
            </div>-->   
        </div>
    </div>
</template>

<script>
    import ScrevleDevice from './ScrevleDevice';

    export default {
        components: { 
            ScrevleDevice,

        },

        data() {
            return {
                devices : [],
                socket: {},
            };
        },

        mounted() {
            console.log('Component mounted.')
            this.fetchScrevle();
            this.connectSocket();
        },

        methods: {
            async fetchScrevle() {
                const response = await axios.get('/api/screvle');
                
                console.log(response); 

                this.devices = response.data.urinals;
            },

            connectSocket() {
                // Connect to Socket.io
                this.socket = window.io(`http://192.168.56.101:3000`);
            }
        }
    }
</script>
