import Vue from 'vue'
import Router from 'vue-router'

import registry from './components/registry.vue'
import report from './components/report.vue'
import redirect from './components/redirect'

Vue.use(Router);




export default new Router({

    mode: 'history',
    routes: [

        {
            path: "/app/registry",
            name: "registry",
            component: registry

        },

        {

            path: "/app/report",
            name: "report",
            component: report
        },

        {
            path: '*',
            name: "NotFound",
            component: redirect
          }



    ]

});
