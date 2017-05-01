<template>
    <canvas id="manacurve"></canvas>
</template>

<script>
    import Chart from 'chart.js';

    export default {
        data() {
            return {
                data : {
                    labels   : [ 'CMC 0', 'CMC 1', 'CMC 2', 'CMC 3', 'CMC 4', 'CMC 5+' ],
                    datasets : [
                        {
                            label                   : 'Creatures',
                            data                    : [ 1, 4, 4, 5, 2, 1 ],
                            backgroundColor         : '#37a0e1',
                            hoverBackgroundColor    : '#2e86bd',
                            hoverBorderWidth        : 0,
                            hoverBorderColor        : 'lightgrey',
                            stack                   : 1
                        },
                        {
                            label                   : 'Instants',
                            data                    : [ 0, 3, 2, 1, 0, 0 ],
                            backgroundColor         : '#37e1c0',
                            hoverBackgroundColor    : '#2ebba0',
                            hoverBorderWidth        : 0,
                            stack                   : 1
                        },
                        {
                            label                   : 'Sorceries',
                            data                    : [ 0, 0, 2, 1, 0, 0 ],
                            backgroundColor         : '#4cff95',
                            hoverBackgroundColor    : '#49d984',
                            hoverBorderWidth        : 0,
                            stack                   : 1
                        },
                        {
                            label                   : 'Enchantments',
                            data                    : [ 0, 0, 0, 1, 0, 0 ],
                            backgroundColor         : '#e1ba37',
                            hoverBackgroundColor    : '#b2932c',
                            hoverBorderWidth        : 0,
                            stack                   : 1
                        },
                        {
                            label                   : 'Planeswalker',
                            data                    : [ 0, 2, 1, 0, 0, 0 ],
                            backgroundColor         : '#ff824c',
                            hoverBackgroundColor    : '#c9683e',
                            hoverBorderWidth        : 0,
                            stack                   : 1
                        },
                        {
                            label                   : 'Artefacts',
                            data                    : [ 1, 2, 2, 1, 0, 1 ],
                            backgroundColor         : '#b2b2b2',
                            hoverBackgroundColor    : '#8a8a8a',
                            hoverBorderWidth        : 0,
                            stack                   : 1
                        }
                    ]
                },
                options : {
                    scales : {
                        xAxes : [ {
                            gridLines : { display : false }
                        } ],
                        yAxes : [ {
                            stacked : true
                        } ]
                    },
                    legend : {
                        display : false
                    }
                }
            };
        },
        mounted() {
            const data = this.data;
            const options = this.options;

            const ctx = document.getElementById( 'manacurve' );
            new Chart( ctx, {
                type    : 'bar',
                data    : data,
                options : options
            } );
        }
    };
</script>
