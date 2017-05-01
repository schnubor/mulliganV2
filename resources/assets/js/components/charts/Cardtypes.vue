<template>
    <canvas id="cardtypes"></canvas>
</template>

<script>
    import Chart from 'chart.js';

    export default {
        data() {
            return {
                data : {
                    labels : [
                        'Creatures',
                        'Instants',
                        'Sorceries',
                        'Enchantments',
                        'Planeswalker',
                        'Artefacts'
                    ],
                    datasets : [
                        {
                            data                    : [ 12, 5, 6, 2, 2, 10 ],
                            backgroundColor         : [
                                '#37a0e1',
                                '#37e1c0',
                                '#4cff95',
                                '#e1ba37',
                                '#ff824c',
                                '#b2b2b2'
                            ],
                            hoverBackgroundColor    : [
                                '#2e86bd',
                                '#2ebba0',
                                '#49d984',
                                '#b2932c',
                                '#c9683e',
                                '#8a8a8a'
                            ]
                        }
                    ]
                },
                options : {
                    legend : { display : false }
                }
            };
        },
        mounted() {
            const data = this.data;
            const options = this.options;

            const ctx = document.getElementById( 'cardtypes' );
            new Chart( ctx, {
                type    : 'pie',
                data    : data,
                options : options
            } );
        }
    };
</script>
