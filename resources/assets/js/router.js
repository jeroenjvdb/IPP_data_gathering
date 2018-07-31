import Router from 'vue-router';
/*import {
    EventBus
} from './event-bus';
*/

const router = new Router({
    routes: [{
            path: '/',
            redirect: '/screvle',
        },
        {
            path: '/screvle',
            component: require('./components/ScrevleOverview.vue'),
            meta: {
                title: 'Screvle',
            },
        },
    ],
});

/*router.afterEach((to, from, next) => {
    EventBus.$emit('navbar-toggled', false);

    EventBus.$emit('title-changed', to.meta.title || '');
});*/

export default router;
