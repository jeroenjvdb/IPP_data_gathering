<template>
    <div>
        <h3>Device {{ device.id }}</h3> 
        <p>last congestion: {{ this.lastCongestion}}</p>
        <p>last clogged:  {{this.lastClogged}}</p>
        <p>packets received since startup {{ this.allFlushes.length }}  </p>
        <p>last packet received {{ this.lastFlush.created_at }}</p>
    </div>
</template>


<script>
export default {
    data() {
        return {
            lastFlush: {},
            allFlushes:[],
            lastCongestion: "",
            lastClogged: "",
        };
    },
    components: {},
    props: [
        'device',
        'socket',
    ],
    mounted() {
        console.log('single device');
        this.fetchFlushes();
    },
    methods: {
        async fetchFlushes() {
            const response = await axios.get(`/api/flush/${this.device.id}`);

            console.log('device flushes', response.data);

            this.updateFlushes(response.data);

            this.subscribe();
        },

        updateFlushes(data) {
            this.allFlushes = data;
            
            this.updateLastFlush(data);
        },

        updateLastFlush(data) {
            this.lastFlush = data[0];
            const lastCongestionObj = data.find(val => val.congestion == true)
            this.lastCongestion = lastCongestionObj ? lastCongestionObj.created_at : "";
            const lastCloggedObj = data.find(val => val.clogged == true)
            this.lastClogged = lastCloggedObj ? lastCloggedObj.created_at : "";
        },

        async subscribe() {
            

            // For each channel...
            //for (let channel of this.channels) {
                // ... listen for new events/messages

           
           this.socket.on(`flush.${this.device.id}.App\\Events\\FlushEvent`, (data) => {
                console.log(this);
                console.log(this.allFlushes);
                this.allFlushes = [ ...this.allFlushes, data];
                this.updateLastFlush(this.allFlushes);
                console.log(this.allFlushes);
                //this.allFlushes = [...this.all.]
               /*if (this.activeChannel == channel.id) {
                     this.messages.push(data.data);
                }*/
                return true;
            });

            this.socket.on(`test-channel:undefined`, data => {
                //console.log(data);
               /* if (this.activeChannel == channel.id) {
                    this.messages.push(data.data);
                }*/
                return true;
            });

            //}
            //var socket = io('/');
            /*socket.on(`flush:${this.device.id}`, function (data) {
                console.log(data);
                //socket.emit('my other event', { my: 'data' });
            });*/
        }
    }
    
}
</script>
