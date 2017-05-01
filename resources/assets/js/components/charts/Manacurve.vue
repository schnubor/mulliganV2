<template>
    <canvas id="manacurve"></canvas>
</template>

<script>
    import Chart from 'chart.js';

    export default {
        data() {
            return {
                data : {
                    labels   : [ "CMC 0", "CMC 1", "CMC 2", "CMC 3", "CMC 4", "CMC 5+" ],
                    datasets : [
                        {
                            label                   : 'Creatures',
                            data                    : [ 1, 4, 4, 5, 2, 1 ],
                            backgroundColor         : 'rgba(55, 160, 225, 0.7)',
                            hoverBackgroundColor    : 'rgba(46, 134, 189, 0.7)',
                            hoverBorderWidth        : 0,
                            hoverBorderColor        : 'lightgrey',
                            stack                   : 1
                        },
                        {
                            label                   : 'Instants',
                            data                    : [ 0, 3, 2, 1, 0, 0 ],
                            backgroundColor         : 'rgba(55, 225, 192, 0.7)',
                            hoverBackgroundColor    : 'rgba(46, 187, 160, 0.7)',
                            hoverBorderWidth        : 0,
                            stack                   : 1
                        },
                        {
                            label                   : 'Sorceries',
                            data                    : [ 0, 0, 2, 1, 0, 0 ],
                            backgroundColor         : 'rgba(76, 255, 149, 0.7)',
                            hoverBackgroundColor    : 'rgba(73, 217, 132, 0.7)',
                            hoverBorderWidth        : 0,
                            stack                   : 1
                        },
                        {
                            label                   : 'Planeswalker',
                            data                    : [ 0, 0, 0, 1, 0, 0 ],
                            backgroundColor         : 'rgba(225, 186, 55, 0.7)',
                            hoverBackgroundColor    : 'rgba(178, 147, 44, 0.7)',
                            hoverBorderWidth        : 0,
                            stack                   : 1
                        },
                        {
                            label                   : 'Enchantments',
                            data                    : [ 0, 2, 1, 0, 0, 0 ],
                            backgroundColor         : 'rgba(255, 130, 76, 0.7)',
                            hoverBackgroundColor    : 'rgba(201, 104, 62, 0.7)',
                            hoverBorderWidth        : 0,
                            stack                   : 1
                        },
                        {
                            label                   : 'Artefacts',
                            data                    : [ 1, 2, 2, 1, 0, 1 ],
                            backgroundColor         : 'rgba(178, 178, 178, 0.7)',
                            hoverBackgroundColor    : 'rgba(138, 138, 138, 0.7)',
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
