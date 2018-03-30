<template>
    <div id="app">
        <div>
            <button @click="update('created')">Sort by Created Time</button>
            <button @click="update('start_date_time')">Sort by Start Time</button>
            <button @click="update('end_date_time')">Sort by End Time</button>
        </div>
        <svg id="chart"></svg>
    </div>
</template>

<script>
  import * as d3 from 'd3';

  export default {
    name: 'App',
    data() {
      return {
        events: [],
        width: 600,
        height: 400
      };
    },

    created() {
      /**
       * Get the data once the component is created
       */
      axios.get('/events/')
           .then(response => {
             this.events = response.data;
             this.init();
           })
           .catch(error => {
             console.log(error);
           });
    },

    mounted() {
      this.init();
    },
    methods: {
      init() {
        /**
         * I'm not too familiar with the D3 library, so I'm
         * sure there's a better way of doing this, but
         * this isn't really the time for optimizations
          */
        this.chart = d3.select('svg#chart')
                       .attr('width', this.width)
                       .attr('height', this.height);

        this.sort('created');

        this.chart.selectAll('circle.nodes')
            .data(this.events)
            .enter()
            .append('svg:circle')
            .attr('cx', function (event) { return event.x; })
            .attr('cy', function (event) { return event.y; })
            .attr('r', '2px')
            .attr('fill', 'black');
      },

      /**
       * Set the x and y values
       *
       * @param event
       * @param property
       */
      prepareCoordinates: function (event, property) {
        const dateTime = new Date(event[property]);
        event.x = this.width * dateTime.getHours() / 24 || 0;
        event.y = this.height * dateTime.getMinutes() / 60 || 0;
      },

      /**
       * Update the order on init and click
       *
       * @param property
       */
      sort(property) {
        let sortedEvents = [];
        this.events.forEach(event => {
          this.prepareCoordinates(event, property);
          sortedEvents.push(event);
        });
        this.events = sortedEvents;
        console.log('hit');
      },

      update(property) {
        this.events.forEach(event => {
          this.prepareCoordinates(event, property);
        });
        this.chart.selectAll('circle')
            .transition()
            .attr('delay', (d, i) => { return 1000 * i;})
            .attr('duration', (d, i) => { return 3000 * (i + 1);})
            .attr('cy', (d, i) => {return this.events[i].y;})
            .attr('cx', (d, i) => {return this.events[i].x;});
      },
    },
  };
</script>

<style>
    #app {
        font-family: 'Avenir', Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: center;
        color: #2c3e50;
        margin-top: 60px;
    }

    circle {
        color: #000;
        /* opacity for showing intensity of frequency */
        opacity: 0.1;
    }
</style>
