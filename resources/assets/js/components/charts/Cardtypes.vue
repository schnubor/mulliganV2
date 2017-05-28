<template>
    <canvas id="cardtypes"></canvas>
</template>

<script>
    import Chart from 'chart.js';

    export default {
        props : [ 'chartdata' ],
        data() {
            return {
                options : {
                    legend : { display : false }
                }
            };
        },
        mounted() {
            const options = this.options;

            const ctx = document.getElementById( 'cardtypes' );
            new Chart( ctx, {
                type    : 'pie',
                data    : {
                    labels : [
                        'Creatures',
                        'Instants',
                        'Sorceries',
                        'Enchantments',
                        'Planeswalker',
                        'Artifacts',
                        'Lands',
                        'Basiclands'
                    ],
                    datasets : [
                        {
                            data                    : this.chartdata,
                            backgroundColor         : [
                                '#37a0e1',
                                '#37e1c0',
                                '#4cff95',
                                '#e1ba37',
                                '#ff824c',
                                '#b2b2b2',
                                '#7c6b64',
                                '#202020'
                            ],
                            hoverBackgroundColor    : [
                                '#2e86bd',
                                '#2ebba0',
                                '#49d984',
                                '#b2932c',
                                '#c9683e',
                                '#8a8a8a',
                                '#665953',
                                '#151515'
                            ]
                        }
                    ]
                },
                options : options
            } );
        }
    };
</script>
