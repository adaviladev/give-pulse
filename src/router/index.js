import Vue from 'vue'
import Router from 'vue-router'
import EventsChart from '@/components/EventsChart'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'EventsChart',
      component: EventsChart
    }
  ]
})
